<?php

namespace App\Http\Controllers;

use App\Models\Devisi;
use App\Models\Lamaran;
use App\Models\Loker;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\LamaranDitolakNotification;
use App\Notifications\LamaranDiterimaNotification;
use App\Notifications\LamaranWawancaraNotification;



class AdminController extends Controller
{
    public function adminDashboard()
    {
        $totalUsers = User::count();
        $totalJobs = Loker::count();
        $totalDivisions = Devisi::count();
        $totalApplications = Lamaran::count();

        $jobs = Loker::latest()->take(5)->get(); // mengambil 5 data lowongan terbaru
        $users = User::latest()->take(5)->get(); // mengambil 5 data user terbaru

        return view('admin.dashboard', compact('totalUsers', 'totalJobs', 'totalDivisions', 'totalApplications', 'jobs', 'users'));
    }


    public function index_manage_devisi()
    {
        $devisi = Devisi::all();

        return view('admin.manage-devisi', ['devisi' => $devisi]);
    }

    public function add_devisi(Request $request)
    {
        $devisi = new Devisi();
        $devisi->nama_devisi = $request->nama_devisi;

        if ($devisi->save()) {
            return redirect()->back()->with('success', 'Data Devisi Baru Berhasil Disimpan');
        } else {
            return redirect()->back()->with('error', 'Data Devisi Gagal Disimpan');
        }
    }

    public function update_devisi(Request $request, $id)
    {
        $devisi = Devisi::find($id);

        $devisi->nama_devisi = $request->nama_devisi;

        if ($devisi->save()) {
            return redirect()->back()->with('success', 'Data Devisi Berhasil Diperbarui');
        } else {
            return redirect()->back()->with('error', 'Data Devisi Gagal Diperbarui');
        }
    }

    public function destroy_devisi($id)
    {
        // Cari devisi berdasarkan ID
        $devisi = Devisi::find($id);

        if (!$devisi) {
            return redirect()->back()->with('error', 'Devisi tidak ditemukan.');
        }

        // Cek apakah devisi digunakan dalam tabel "loker"
        $lokerCount = Loker::where('devisi_id', $id)->count();

        if ($lokerCount > 0) {
            return redirect()->back()->with('error', 'Devisi tidak dapat dihapus karena sedang digunakan pada loker.');
        }

        if ($devisi->delete()) {
            return redirect()->back()->with('success', 'Devisi berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Data Devisi Gagal Dihapus');
        }
    }

    public function index_manage_loker()
    {
        $loker = Loker::all();
        $devisi = Devisi::all();

        return view('admin.manage-loker', ['loker' => $loker, 'devisi' => $devisi]);
    }

    public function add_loker(Request $request)
    {
        $loker = new Loker();

        $loker->title = $request->title;
        $loker->deskripsi = $request->description;
        $loker->devisi_id = $request->devisi_id;
        $loker->status = 'Open';

        if ($loker->save()) {
            return redirect()->back()->with('success', 'Loker Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Loker Gagal Ditambahkan');
        }
    }

    public function update_loker(Request $request, $id)
    {
        $loker = Loker::find($id);

        $loker->title = $request->title;
        $loker->deskripsi = $request->description;
        $loker->devisi_id = $request->devisi_id;
        $loker->status = $request->status;

        if ($loker->save()) {
            return redirect()->back()->with('success', 'Loker Berhasil Diperbarui');
        } else {
            return redirect()->back()->with('error', 'Loker Gagal Diperbarui');
        }
    }

    public function destroy_loker($id)
    {
        // Cari loker berdasarkan ID
        $loker = Loker::find($id);

        if (!$loker) {
            return redirect()->back()->with('error', 'Loker tidak ditemukan.');
        }

        // (hapus pengecekan pelamar)

        // Hapus data lamaran yang berelasi terlebih dahulu (opsional, kalau ingin bersih)
        Lamaran::where('loker_id', $id)->delete();

        // Hapus loker
        if ($loker->delete()) {
            return redirect()->back()->with('success', 'Loker berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Loker gagal dihapus.');
        }
    }


    public function detail_loker($id)
    {
        $loker = Loker::find($id);

        $lamaran_seleksi = Lamaran::where('status_lamaran', 'seleksi')->get();
        $lamaran_wawancara = Lamaran::where('status_lamaran', 'wawancara')->get();
        $lamaran_diterima = Lamaran::where('status_lamaran', 'diterima')->get();
        $lamaran_ditolak = Lamaran::where('status_lamaran', 'ditolak')->get();

        return view('admin.detail-loker', ['loker' => $loker, 'lamaran_seleksi' => $lamaran_seleksi, 'lamaran_wawancara' => $lamaran_wawancara, 'lamaran_diterima' => $lamaran_diterima, 'lamaran_ditolak' => $lamaran_ditolak]);
    }

    public function update_status_lamaran(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'status_lamaran' => 'required|in:ditolak,diterima,wawancara,seleksi',
            'link_wawancara' => 'nullable|url',
        ]);

        $lamaran = Lamaran::find($id);

        if (!$lamaran) {
            return redirect()->back()->with('error', 'Data lamaran tidak ditemukan.');
        }

        $lamaran->status_lamaran = $request->status_lamaran;

        // Simpan link wawancara jika statusnya "wawancara"
        if ($request->status_lamaran === 'wawancara') {
            $lamaran->link_wawancara = $request->link_wawancara;
        } else {
            $lamaran->link_wawancara = null; // Kosongkan jika bukan wawancara
        }

        $lamaran->save();

        // Ambil pelamar dan judul pekerjaan
        $pelamar = $lamaran->user;
        $jobTitle = $lamaran->loker->title;

        // Kirim notifikasi sesuai status
        switch ($request->status_lamaran) {
            case 'ditolak':
                $pelamar->notify(new LamaranDitolakNotification($jobTitle));
                break;

            case 'diterima':
                $pelamar->notify(new LamaranDiterimaNotification($jobTitle));
                break;

            case 'wawancara':
                $pelamar->notify(new LamaranWawancaraNotification($jobTitle));
                break;
        }

        return redirect()->back()->with('success', 'Status lamaran berhasil diperbarui.');
    }



    public function detail_user($id)
    {
        $user = User::find($id);

        return view('admin.detail-profile', ['user' => $user]);
    }
}
