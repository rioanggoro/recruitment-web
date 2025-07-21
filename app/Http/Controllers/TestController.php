<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Question;
use App\Models\Option;
use App\Models\UserTest; 
use App\Models\UserAnswer; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Devisi;

class TestController extends Controller
{

    public function index()
    {
        // Menampilkan daftar tes untuk admin
        $tests = Test::with('devisi')->get();
        return view('admin.tests.index', compact('tests'));
    }

    public function create()
    {
        // Form untuk membuat tes baru
        $devisis = Devisi::all(); // Ambil semua divisi untuk dropdown
        return view('admin.tests.create', compact('devisis'));
    }

    public function store(Request $request)
    {
        // Validasi dan simpan tes baru
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'devisi_id' => 'nullable|exists:devisi,id',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        Test::create($request->all());
        return redirect()->route('admin.tests.index')->with('success', 'Tes berhasil ditambahkan!');
    }

    public function edit(Test $test)
    {
        // Form untuk mengedit tes
        $devisis = Devisi::all();
        return view('admin.tests.edit', compact('test', 'devisis'));
    }

    public function update(Request $request, Test $test)
    {
        // Validasi dan update tes
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'devisi_id' => 'nullable|exists:devisi,id',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        $test->update($request->all());
        return redirect()->route('admin.tests.index')->with('success', 'Tes berhasil diperbarui!');
    }

    public function destroy(Test $test)
    {
        // Hapus tes
        $test->delete();
        return redirect()->route('admin.tests.index')->with('success', 'Tes berhasil dihapus!');
    }

    // --- Untuk mengelola pertanyaan dalam sebuah tes ---

    public function showQuestions(Test $test)
    {
        // Menampilkan daftar pertanyaan untuk tes tertentu
        $questions = $test->questions()->with('options')->get();
        return view('admin.tests.questions.index', compact('test', 'questions'));
    }

    public function editQuestion(Question $question)
    {
        // Load question dengan options-nya
        $question->load('options');
        return view('admin.tests.questions.edit', compact('question'));
    }

    public function updateQuestion(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,essay',
            'options' => 'array',
            'options.*.text' => 'required_with:options|string',
            'options.*.is_correct' => 'boolean',
        ]);

        $question->update([
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
        ]);

        // Hapus opsi lama dan tambahkan yang baru jika multiple_choice
        if ($question->question_type === 'multiple_choice') {
            $question->options()->delete(); // Hapus semua opsi lama
            if ($request->has('options')) {
                foreach ($request->options as $optionData) {
                    $question->options()->create([
                        'option_text' => $optionData['text'],
                        'is_correct' => $optionData['is_correct'] ?? false,
                    ]);
                }
            }
        } else {
            // Jika berubah jadi essay, pastikan opsi dihapus
            $question->options()->delete();
        }

        return redirect()->route('admin.tests.questions.index', $question->test_id)->with('success', 'Pertanyaan berhasil diperbarui!');
    }


    public function destroyQuestion(Question $question)
    {
        $testId = $question->test_id; // Simpan test_id sebelum dihapus
        $question->delete();
        return redirect()->route('admin.tests.questions.index', $testId)->with('success', 'Pertanyaan berhasil dihapus!');
    }

    public function storeQuestion(Request $request, Test $test)
    {
        // Menambahkan pertanyaan baru ke tes
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,essay',
            'options' => 'array', // Array pilihan untuk multiple choice
            'options.*.text' => 'required_with:options|string',
            'options.*.is_correct' => 'boolean',
        ]);

        $question = $test->questions()->create([
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
        ]);

        if ($request->question_type === 'multiple_choice' && $request->has('options')) {
            foreach ($request->options as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['text'],
                    'is_correct' => $optionData['is_correct'] ?? false,
                ]);
            }
        }

        return back()->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    // Metode untuk edit, update, delete pertanyaan juga perlu diimplementasikan
    // ...

    // ======================================
    // PELAMAR FUNCTIONS (Take Tests)
    // ======================================

    public function showTestSelection()
    {
        // Menampilkan daftar tes yang tersedia untuk pelamar
        $tests = Test::with('devisi')->get(); // Ambil semua tes, bisa difilter di sini jika perlu
        $user = auth()->user();
        // Cek apakah user sudah pernah mengambil tes
        $userTakenTests = $user->userTests->pluck('test_id')->toArray();

        return view('pelamar.tests.selection', compact('tests', 'userTakenTests'));
    }

    public function startTest(Test $test)
    {
        // Memulai sesi tes untuk pelamar
        $user = auth()->user();
        
        // Cek apakah user sudah pernah menyelesaikan tes ini
        $existingUserTest = UserTest::where('user_id', $user->id)
                                    ->where('test_id', $test->id)
                                    ->whereNotNull('completed_at')
                                    ->first();

        if ($existingUserTest) {
            return redirect()->route('pelamar.dashboard')->with('error', 'Anda sudah menyelesaikan tes ini.');
        }

        // Buat atau ambil sesi user_test yang sedang berjalan
        $userTest = UserTest::firstOrCreate(
            ['user_id' => $user->id, 'test_id' => $test->id],
            ['started_at' => now()]
        );

        $questions = $test->questions()->with('options')->get();

        return view('pelamar.tests.take', compact('test', 'questions', 'userTest'));
    }

    public function submitTest(Request $request, Test $test)
    {
        // Mendapatkan user yang sedang login
        $user = auth()->user();

        // Mencari sesi tes user yang aktif dan belum selesai untuk tes ini
        // Jika tidak ditemukan, akan otomatis mengembalikan 404
        $userTest = UserTest::where('user_id', $user->id)
                            ->where('test_id', $test->id)
                            ->whereNull('completed_at') // Memastikan tes belum selesai sebelumnya
                            ->firstOrFail();

        // Inisialisasi skor mentah (jumlah jawaban benar)
        $rawScore = 0;
        // Inisialisasi penghitung total soal pilihan ganda
        $totalMultipleChoiceQuestions = 0; 

        // Validasi input jawaban dari form
        $validatedData = $request->validate([
            'questions' => 'required|array', // Pastikan ada array 'questions'
            'questions.*' => 'required',     // Setiap jawaban pertanyaan harus ada
        ]);

        // Proses setiap jawaban yang dikirimkan user
        foreach ($validatedData['questions'] as $questionId => $answer) {
            $question = Question::find($questionId);

            // Lewati jika pertanyaan tidak ditemukan (misal: manipulasi data)
            if (!$question) {
                continue;
            }

            $isCorrect = null;    // Status benar/salah jawaban
            $optionId = null;     // ID opsi terpilih (untuk pilihan ganda)
            $answerText = null;   // Teks jawaban (untuk esai)

            // Logika penilaian berdasarkan tipe pertanyaan
            if ($question->question_type === 'multiple_choice') {
                $totalMultipleChoiceQuestions++; // Tambahkan ini: Hitung soal pilihan ganda
                $optionId = $answer; // Jawaban adalah ID opsi terpilih
                $selectedOption = Option::find($optionId);

                // Memastikan opsi yang dipilih valid dan benar-benar milik pertanyaan ini
                if ($selectedOption && $selectedOption->question_id === $question->id) {
                    if ($selectedOption->is_correct) {
                        $isCorrect = true;
                        $rawScore++; // Tambah skor mentah jika jawaban benar
                    } else {
                        $isCorrect = false;
                    }
                } else {
                    // Jika opsi tidak valid atau tidak cocok dengan pertanyaan, anggap salah
                    $isCorrect = false;
                }
            } elseif ($question->question_type === 'essay') {
                $answerText = $answer; // Jawaban adalah teks yang diinput user
                // Untuk esai, is_correct akan null karena perlu dinilai manual oleh admin
                $isCorrect = null;
            }

            // Simpan jawaban user ke tabel user_answers
            UserAnswer::create([
                'user_test_id' => $userTest->id,
                'question_id' => $question->id,
                'option_id' => $optionId,
                'answer_text' => $answerText,
                'is_correct' => $isCorrect,
            ]);
        }

        // 🚀 HITUNG SKOR AKHIR SEBAGAI PERSENTASE
        $finalScorePercentage = 0;
        if ($totalMultipleChoiceQuestions > 0) {
            // Asumsi setiap soal pilihan ganda bernilai sama (misal: 1 poin per soal).
            // Skor akhir adalah persentase dari jawaban benar pilihan ganda.
            $finalScorePercentage = round(($rawScore / $totalMultipleChoiceQuestions) * 100);
        }
        // Catatan: Soal esai tidak dihitung dalam skor otomatis ini. Penilaian esai bisa ditambahkan manual nanti.

        // Update skor (sekarang menjadi persentase) dan status tes di entri UserTest
        $userTest->update([
            'score' => $finalScorePercentage, // ✅ Gunakan skor persentase
            'completed_at' => now(),
            // Status passed ditentukan berdasarkan skor persentase yang mencapai min_score_to_pass
            'passed' => ($finalScorePercentage >= $test->min_score_to_pass) ? true : false, 
        ]);

        // 🚀 LOGIKA REKOMENDASI DIVISI BERDASARKAN SKOR PERSENTASE
        $recommendedDevisi = null; // Inisialisasi variabel untuk rekomendasi divisi

        // Ambil semua divisi yang relevan dari database
        // ✅ PENTING: Pastikan nama-nama divisi di sini SAMA PERSIS dengan kolom `nama_devisi` di tabel `devisi` kamu
        $devisiKosmetik = Devisi::where('nama_devisi', 'Dept kosmetik')->first();
        $devisiPkrt = Devisi::where('nama_devisi', 'Dept Pkrt')->first();
        $devisiAutocare = Devisi::where('nama_devisi', 'Dept. Autocare')->first();
        $devisiEcommerce = Devisi::where('nama_devisi', 'e-commers')->first();
        $devisiAccountingFinance = Devisi::where('nama_devisi', 'accounting & finance')->first();
        $devisiHrdGa = Devisi::where('nama_devisi', 'hrd & ga')->first();
        $devisiMarketingSales = Devisi::where('nama_devisi', 'marketing & sales')->first();

        // Tentukan rekomendasi berdasarkan finalScorePercentage (sekarang sudah persentase)
        // Urutan penting: dari skor tertinggi ke terendah, karena satu skor bisa memenuhi banyak kondisi
        if ($finalScorePercentage >= 80 && $devisiKosmetik) {
            $recommendedDevisi = $devisiKosmetik;
        } elseif ($finalScorePercentage >= 75 && $devisiAccountingFinance) {
            $recommendedDevisi = $devisiAccountingFinance;
        } elseif ($finalScorePercentage >= 70 && $devisiMarketingSales) {
            $recommendedDevisi = $devisiMarketingSales;
        } elseif ($finalScorePercentage >= 65 && $devisiPkrt) {
            $recommendedDevisi = $devisiPkrt;
        } elseif ($finalScorePercentage >= 60 && $devisiEcommerce) {
            $recommendedDevisi = $devisiEcommerce;
        } elseif ($finalScorePercentage >= 55 && $devisiAutocare) {
            $recommendedDevisi = $devisiAutocare;
        } elseif ($finalScorePercentage >= 50 && $devisiHrdGa) {
            $recommendedDevisi = $devisiHrdGa;
        }
    

        // Simpan ID divisi yang direkomendasikan ke profil user
        if ($recommendedDevisi) {
            $user->update([
                'recommended_devisi_id' => $recommendedDevisi->id
            ]);
            $message = 'Tes berhasil diselesaikan! Skor Anda: ' . $finalScorePercentage . '%. Anda direkomendasikan untuk divisi ' . $recommendedDevisi->nama_devisi . '.';
        } else {
            // Jika tidak ada rekomendasi yang cocok dengan ambang batas yang ditentukan
            $user->update([
                'recommended_devisi_id' => null // Set ke null jika tidak ada rekomendasi
            ]);
            $message = 'Tes berhasil diselesaikan! Skor Anda: ' . $finalScorePercentage . '%. Belum ada rekomendasi divisi yang cocok berdasarkan skor Anda. Anda dapat melihat lowongan pekerjaan yang tersedia.';
        }

        // Redirect user ke dashboard pelamar dengan pesan hasil
        return redirect()->route('pelamar.dashboard')->with('success', $message);
    }

    public function listUserTests(){
        $userTests = UserTest::with(['user', 'test'])
                             ->orderBy('created_at', 'desc')
                             ->get();

        return view('admin.user_tests.index', compact('userTests'));
    }
    public function showUserTestResult(UserTest $userTest)
    {

        $userTest->load([
            'user',
            'test',
            'userAnswers.question.options', // Load userAnswers, lalu question, lalu options dari question
        ]);

        return view('admin.user_tests.show', compact('userTest'));
    }
}
