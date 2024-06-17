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
            'name' => 'required',
            'username' => 'required|unique:users|min:5',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->role = 'pelamar';
        $user->password = Hash::make($request->password);

        // Redirect atau response sesuai kebutuhan
        if ($user->save()) {
            return redirect('/')->with('success', 'Registrasi berhasil! Silakan login.');
        } else {
            return redirect()->back()->with('error', 'Registrasi Gagal.');
        }
    }

    public function login(Request $request)
    {
        // Validasi input form
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Proses autentikasi menggunakan Auth
        $credentials = $request->only('username', 'password');
        $remember = $request->filled('remember'); // Check if "remember" checkbox is checked

        if (Auth::attempt($credentials, $remember)) {
            // Jika autentikasi berhasil, cek role user
            if (Auth::user()->role == 'admin') {
                return redirect('/admin/dashboard')->with('success', 'Login berhasil!');
            } elseif (Auth::user()->role == 'pelamar') {
                return redirect('/pelamar/dashboard')->with('success', 'Login berhasil!');
            }
        }

        // Jika autentikasi gagal atau user tidak memiliki role yang sesuai
        return redirect()->back()->with('error', 'Username atau password salah.');
    }
}
