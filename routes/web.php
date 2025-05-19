<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelamarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Notification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('login');
Route::get('/registrasi', function () {
    return view('registrasi');
});
Route::post('/registrasi', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard']);

    Route::get('/admin/manage-devisi', [AdminController::class, 'index_manage_devisi']);
    Route::post('/add-devisi', [AdminController::class, 'add_devisi']);
    Route::put('/edit-devisi/{id}', [AdminController::class, 'update_devisi']);
    Route::delete('/delete-devisi/{id}', [AdminController::class, 'destroy_devisi']);

    Route::get('/admin/manage-loker', [AdminController::class, 'index_manage_loker']);
    Route::post('/add-loker', [AdminController::class, 'add_loker']);
    Route::put('/edit-loker/{id}', [AdminController::class, 'update_loker']);
    Route::delete('/delete-loker/{id}', [AdminController::class, 'destroy_loker']);

    Route::get('/admin/detail-loker/{id}', [AdminController::class, 'detail_loker']);
    Route::post('/update-status-lamaran/{id}', [AdminController::class, 'update_status_lamaran']);
    Route::get('/admin/detail-pelamar/{id}', [AdminController::class, 'detail_user']);

    Route::get('/admin/notifikasi', function () {
        return view('admin.notifikasi');
    })->middleware(['auth'])->name('admin.notifikasi');

    Route::post('/notifications/mark-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.markRead');

    Route::delete('/notifications/{id}', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();

        return back()->with('success', 'Notifikasi berhasil dihapus.');
    })->name('notifications.destroy');
    Route::get('/admin/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => 'role:pelamar'], function () {
    Route::get('/pelamar/dashboard', [PelamarController::class, 'dashboard']);

    Route::get('/pelamar/profile', function () {
        return view('pelamar.profile');
    });
    Route::post('/update-avatar', [PelamarController::class, 'update_profile_picture']);
    Route::post('/update-biodata', [PelamarController::class, 'update_biodata']);
    Route::post('/upload-cv', [PelamarController::class, 'upload_cv']);
    Route::delete('/delete-cv', [PelamarController::class, 'delete_cv']);
    Route::post('/upload-ijazah', [PelamarController::class, 'upload_ijazah']);
    Route::delete('/delete-ijazah', [PelamarController::class, 'delete_ijazah']);
    Route::post('/upload-ktp', [PelamarController::class, 'upload_ktp']);
    Route::delete('/delete-ktp', [PelamarController::class, 'delete_ktp']);
    Route::post('/upload-surat-pengalaman-kerja', [PelamarController::class, 'upload_surat_pengalaman_kerja']);
    Route::delete('/delete-surat-pengalaman-kerja', [PelamarController::class, 'delete_surat_pengalaman_kerja']);
    Route::post('/upload-surat-keterangan-sehat', [PelamarController::class, 'upload_surat_keterangan_sehat']);
    Route::delete('/delete-surat-keterangan-sehat', [PelamarController::class, 'delete_surat_keterangan_sehat']);
    Route::post('/upload-skck', [PelamarController::class, 'upload_skck']);
    Route::delete('/delete-skck', [PelamarController::class, 'delete_skck']);
    Route::post('/upload-transkrip-nilai', [PelamarController::class, 'upload_transkrip_nilai']);
    Route::delete('/delete-transkrip-nilai', [PelamarController::class, 'delete_transkrip_nilai']);

    Route::get('/pelamar/loker', [PelamarController::class, 'loker']);
    Route::get('/pelamar/detail-loker/{id}', [PelamarController::class, 'detail_loker']);
    Route::post('/lamar-pekerjaan/{id}', [PelamarController::class, 'lamar']);

    Route::get('/pelamar/lamaran', [PelamarController::class, 'lamaran']);

    Route::get('/pelamar/logout', [AuthController::class, 'logout']);
});
