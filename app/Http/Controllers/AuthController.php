<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users|min:5|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->role = 'pelamar';
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            // ✅ Langsung login user setelah registrasi berhasil
            Auth::login($user);

            // 💡 REDIRECT KE DASHBOARD PELAMAR SETELAH REGISTRASI
            // Pengecekan tes akan dilakukan saat user mencoba mengakses halaman loker
            return redirect('/pelamar/dashboard')->with('success', 'Registrasi berhasil! Silakan lengkapi profil Anda.');
        } else {
            return redirect()->back()->with('error', 'Registrasi Gagal. Silakan coba lagi.');
        }
    }

    public function login(Request $request)
    {
        // Validasi input form
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Proses autentikasi menggunakan Auth
        $credentials = $request->only('username', 'password');
        $remember = $request->filled('remember'); // Check if "remember" checkbox is checked

        if (Auth::attempt($credentials, $remember)) {
            // Regenerasi sesi untuk keamanan
            $request->session()->regenerate();

            $user = Auth::user();

            // ✅ Cek role user dan arahkan ke dashboard masing-masing
            if ($user->role == 'admin') {
                return redirect('/admin/dashboard')->with('success', 'Selamat datang kembali, Admin!');
            } elseif ($user->role == 'pelamar') {
                // 💡 REDIRECT KE DASHBOARD PELAMAR SETELAH LOGIN
                // Pengecekan tes dipindahkan ke PelamarController@loker
                return redirect('/pelamar/dashboard')->with('success', 'Login berhasil!');
            }
        }

        // 🚫 Hapus baris return redirect() yang duplikat ini
        // Jika autentikasi gagal atau user tidak memiliki role yang sesuai
        return redirect()->back()->withInput($request->only('username'))->with('error', 'Username atau password salah.');
    }

    public function logout(Request $request) // ✅ Tambahkan parameter Request
    {
        Auth::logout();

        // ✅ Invalidate sesi dan regenerate token untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ✅ Redirect ke halaman login atau halaman utama
        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}