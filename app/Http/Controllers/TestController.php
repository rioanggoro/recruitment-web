<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Question;
use App\Models\Option;
use App\Models\UserTest;
use App\Models\UserAnswer;
use App\Models\Devisi; // 💡 Pastikan kamu punya model Devisi

class TestController extends Controller
{
    // ======================================
    // ADMIN FUNCTIONS (CRUD Tests & Questions)
    // ======================================

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
        // Validasi dan proses jawaban tes dari pelamar
        $user = auth()->user();
        $userTest = UserTest::where('user_id', $user->id)
                            ->where('test_id', $test->id)
                            ->whereNull('completed_at')
                            ->firstOrFail(); // Pastikan ada sesi tes yang aktif

        $score = 0;
        foreach ($request->questions as $questionId => $answer) {
            $question = Question::find($questionId);

            if (!$question) {
                continue;
            }

            $isCorrect = null;
            $optionId = null;
            $answerText = null;

            if ($question->question_type === 'multiple_choice') {
                $optionId = $answer;
                $selectedOption = Option::find($optionId);
                if ($selectedOption && $selectedOption->is_correct) {
                    $isCorrect = true;
                    $score++; // Tambah skor jika benar
                } else {
                    $isCorrect = false;
                }
            } elseif ($question->question_type === 'essay') {
                $answerText = $answer;
                // Untuk esai, is_correct akan null atau perlu dinilai manual oleh admin
                $isCorrect = null;
            }

            UserAnswer::create([
                'user_test_id' => $userTest->id,
                'question_id' => $question->id,
                'option_id' => $optionId,
                'answer_text' => $answerText,
                'is_correct' => $isCorrect,
            ]);
        }

        // Update skor dan status tes
        $userTest->update([
            'score' => $score,
            'completed_at' => now(),
            'passed' => ($score >= $test->min_score_to_pass) ? true : false, // 💡 Tambahkan kolom min_score_to_pass di tabel tests
        ]);

        // 💡 Redirect atau berikan notifikasi hasil tes
        // Misalnya, langsung tentukan divisi atau arahkan ke halaman hasil
        return redirect()->route('pelamar.dashboard')->with('success', 'Tes berhasil diselesaikan! Skor Anda: ' . $score);
    }
}
