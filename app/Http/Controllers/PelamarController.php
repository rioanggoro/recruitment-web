<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Devisi;
use App\Models\Lamaran;
use App\Models\Loker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Notifications\LamaranMasukNotification;
use App\Models\UserTest;

class PelamarController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalJobs = Loker::count();
        $totalDivisions = Devisi::count();
        $totalApplications = Lamaran::count();

        $jobs = Loker::latest()->take(5)->get(); // mengambil 5 data lowongan terbaru
        $users = User::latest()->take(5)->get(); // mengambil 5 data user terbaru

        return view('pelamar.dashboard', compact('totalUsers', 'totalJobs', 'totalDivisions', 'totalApplications', 'jobs', 'users'));
    }

    public function update_profile_picture(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $biodata = Biodata::where('user_id', Auth::id())->first();

        if (!$biodata) {
            $biodata = new Biodata();
            $file = $request->file('avatar');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/profile', $filename, 'public');

            // Simpan nama file ke database
            $biodata->foto = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
        } else {
            if ($biodata->foto != null) {
                Storage::disk('public')->delete('images/profile/' . $biodata->foto);
            }

            $file = $request->file('avatar');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/profile', $filename, 'public');

            // Simpan nama file ke database
            $biodata->foto = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
        }
    }

    public function update_biodata(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'agama' => 'nullable|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu,lainnya',
            'alamat' => 'nullable|string',
            'status' => 'nullable|in:Menikah,Belum Menikah',
            'pendidikan_terakhir' => 'nullable|in:SD (Sekolah Dasar),SMP (Sekolah Menengah Pertama),SMA (Sekolah Menengah Atas) / SMK (Sekolah Menengah Kejuruan),D1 (Diploma 1),D2 (Diploma 2),D3 (Diploma 3),D4 (Diploma 4),Sarjana (S1),Magister (S2),Doktor (S3)',
            'email' => 'nullable|email|max:255',
            'nomor_hp' => 'nullable|string|max:20',
        ]);

        $user = User::find(Auth::id());

        $biodata = Biodata::where('user_id', $user->id)->first();

        if ($biodata) {
            // Update existing biodata
            $biodata->update([
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'agama' => $request->input('agama'),
                'alamat' => $request->input('alamat'),
                'status' => $request->input('status'),
                'pendidikan_terakhir' => $request->input('pendidikan_terakhir'),
                'email' => $request->input('email'),
                'nomor_hp' => $request->input('nomor_hp'),
                'nik' => $request->input('nik'),
            ]);
        } else {
            // Create new biodata
            Biodata::create([
                'user_id' => $user->id,
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'agama' => $request->input('agama'),
                'alamat' => $request->input('alamat'),
                'status' => $request->input('status'),
                'pendidikan_terakhir' => $request->input('pendidikan_terakhir'),
                'email' => $request->input('email'),
                'nomor_hp' => $request->input('nomor_hp'),
                'nik' => $request->input('nik'),
            ]);
        }

        // Update user's name
        $user->update(['name' => $request->input('name')]);

        return redirect()->back()->with('success', 'Biodata berhasil diperbarui.');
    }

    public function upload_cv(Request $request)
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        if (!$biodata) {
            $biodata = new Biodata();
            $file = $request->file('cv');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->cv = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'CV berhasil diperbarui.');
        } else {
            if ($biodata->cv != null) {
                Storage::disk('public')->delete('images/berkas/' . $biodata->cv);
            }

            $file = $request->file('cv');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->cv = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'CV berhasil diperbarui.');
        }
    }

    public function delete_cv()
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        Storage::disk('public')->delete('images/berkas/' . $biodata->cv);

        $biodata->cv = null;

        $biodata->save();

        return redirect()->back()->with('success', 'CV Berhasil Dihapus.');
    }

    public function upload_ijazah(Request $request)
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        if (!$biodata) {
            $biodata = new Biodata();
            $file = $request->file('ijazah');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->ijazah = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'Ijazah berhasil diperbarui.');
        } else {
            if ($biodata->ijazah != null) {
                Storage::disk('public')->delete('images/berkas/' . $biodata->ijazah);
            }

            $file = $request->file('ijazah');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->ijazah = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'Ijazah berhasil diperbarui.');
        }
    }

    public function delete_ijazah()
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        Storage::disk('public')->delete('images/berkas/' . $biodata->ijazah);

        $biodata->ijazah = null;

        $biodata->save();

        return redirect()->back()->with('success', 'Ijazah Berhasil Dihapus.');
    }

    public function upload_ktp(Request $request)
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        if (!$biodata) {
            $biodata = new Biodata();
            $file = $request->file('ktp');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->ktp = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'KTP berhasil diperbarui.');
        } else {
            if ($biodata->ktp != null) {
                Storage::disk('public')->delete('images/berkas/' . $biodata->ktp);
            }

            $file = $request->file('ktp');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->ktp = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'KTP berhasil diperbarui.');
        }
    }

    public function delete_ktp()
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        Storage::disk('public')->delete('images/berkas/' . $biodata->ktp);

        $biodata->ktp = null;

        $biodata->save();

        return redirect()->back()->with('success', 'KTP Berhasil Dihapus.');
    }

    public function upload_surat_pengalaman_kerja(Request $request)
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        if (!$biodata) {
            $biodata = new Biodata();
            $file = $request->file('surat_pengalaman_kerja');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->surat_pengalaman_kerja = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'Surat Pengalaman Kerja berhasil diperbarui.');
        } else {
            if ($biodata->surat_pengalaman_kerja != null) {
                Storage::disk('public')->delete('images/berkas/' . $biodata->surat_pengalaman_kerja);
            }

            $file = $request->file('surat_pengalaman_kerja');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->surat_pengalaman_kerja = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'Surat Pengalaman Kerja berhasil diperbarui.');
        }
    }

    public function delete_surat_pengalaman_kerja()
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        Storage::disk('public')->delete('images/berkas/' . $biodata->surat_pengalaman_kerja);

        $biodata->surat_pengalaman_kerja = null;

        $biodata->save();

        return redirect()->back()->with('success', 'Surat Pengalaman Kerja Berhasil Dihapus.');
    }

    public function upload_surat_keterangan_sehat(Request $request)
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        if (!$biodata) {
            $biodata = new Biodata();
            $file = $request->file('surat_keterangan_sehat');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->surat_keterangan_sehat = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'Surat Keterangan Sehat berhasil diperbarui.');
        } else {
            if ($biodata->surat_keterangan_sehat != null) {
                Storage::disk('public')->delete('images/berkas/' . $biodata->surat_keterangan_sehat);
            }

            $file = $request->file('surat_keterangan_sehat');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->surat_keterangan_sehat = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'Surat Keterangan Sehat berhasil diperbarui.');
        }
    }

    public function delete_surat_keterangan_sehat()
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        Storage::disk('public')->delete('images/berkas/' . $biodata->surat_keterangan_sehat);

        $biodata->surat_keterangan_sehat = null;

        $biodata->save();

        return redirect()->back()->with('success', 'Surat Keterangan Sehat Berhasil Dihapus.');
    }

    public function upload_skck(Request $request)
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        if (!$biodata) {
            $biodata = new Biodata();
            $file = $request->file('skck');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->skck = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'SKCK berhasil diperbarui.');
        } else {
            if ($biodata->skck != null) {
                Storage::disk('public')->delete('images/berkas/' . $biodata->skck);
            }

            $file = $request->file('skck');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->skck = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'SKCK berhasil diperbarui.');
        }
    }

    public function delete_skck()
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        Storage::disk('public')->delete('images/berkas/' . $biodata->skck);

        $biodata->skck = null;

        $biodata->save();

        return redirect()->back()->with('success', 'SKCK Berhasil Dihapus.');
    }

    public function upload_transkrip_nilai(Request $request)
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        if (!$biodata) {
            $biodata = new Biodata();
            $file = $request->file('transkrip_nilai');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->transkrip_nilai = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'Transkrip Nilai berhasil diperbarui.');
        } else {
            if ($biodata->transkrip_nilai != null) {
                Storage::disk('public')->delete('images/berkas/' . $biodata->transkrip_nilai);
            }

            $file = $request->file('transkrip_nilai');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images/berkas', $filename, 'public');

            // Simpan nama file ke database
            $biodata->transkrip_nilai = $filename;
            $biodata->user_id = Auth::id();
            $biodata->save();

            return redirect()->back()->with('success', 'Transkrip Nilai berhasil diperbarui.');
        }
    }

    public function delete_transkrip_nilai()
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        Storage::disk('public')->delete('images/berkas/' . $biodata->transkrip_nilai);

        $biodata->transkrip_nilai = null;

        $biodata->save();

        return redirect()->back()->with('success', 'Transkrip Nilai Berhasil Dihapus.');
    }

    public function loker()
    {
        $user = auth()->user();

        // 💡 Cek apakah user sudah menyelesaikan tes
        $hasCompletedTest = UserTest::where('user_id', $user->id)
                                    ->whereNotNull('completed_at')
                                    ->exists();

        // Jika user belum menyelesaikan tes, redirect ke halaman pemilihan tes
        if (!$hasCompletedTest) {
            return redirect()->route('pelamar.test.selection')->with('info', 'Anda harus menyelesaikan tes terlebih dahulu sebelum melihat lowongan pekerjaan.');
        }

        // ✅ TAMBAHKAN BARIS INI: Ambil data loker hanya jika user sudah menyelesaikan tes
        $loker = Loker::all(); // Sesuaikan query jika kamu punya filter atau relasi lain yang ingin di-load

        return view('pelamar.loker', compact('loker'));
    }

    public function detail_loker($id)
    {
        $loker = Loker::find($id);

        return view('pelamar.detail-loker', ['loker' => $loker]);
    }

    public function lamar($id)
    {
        $lamaran = new Lamaran();
        $lamaran->status_lamaran = 'seleksi';
        $lamaran->user_id = Auth::id();
        $lamaran->loker_id = $id;
        $lamaran->save();

        // Kirim notifikasi ke semua admin
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new LamaranMasukNotification(Auth::user()));
        }

        return redirect()->back()->with('success', 'Anda Berhasil Melamar Pekerjaan Ini');
    }


    public function lamaran()
    {
        $lamaran = Lamaran::where('user_id', Auth::id())->get();

        return view('pelamar.lamaran', ['lamaran' => $lamaran]);
    }
}
