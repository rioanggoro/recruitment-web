<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserTest;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255', // ✅ Tambahkan validasi string dan max
            'username' => 'required|string|unique:users|min:5|max:255', // ✅ Tambahkan validasi string dan max
            'password' => 'required|string|confirmed|min:8', // ✅ Tambahkan validasi string
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->role = 'pelamar';
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            // ✅ Langsung login user setelah registrasi berhasil
            Auth::login($user); 

            // 💡 Arahkan user ke halaman pemilihan tes setelah registrasi
            return redirect()->route('pelamar.test.selection')->with('success', 'Registrasi berhasil! Silakan mulai tes Anda.');
        } else {
            return redirect()->back()->with('error', 'Registrasi Gagal. Silakan coba lagi.');
        }
    }

    public function login(Request $request)
    {
        // Validasi input form
        $request->validate([
            'username' => 'required|string', // ✅ Tambahkan validasi string
            'password' => 'required|string', // ✅ Tambahkan validasi string
        ]);

        // Proses autentikasi menggunakan Auth
        $credentials = $request->only('username', 'password');
        $remember = $request->filled('remember'); // Check if "remember" checkbox is checked

        if (Auth::attempt($credentials, $remember)) {
            // Regenerasi sesi untuk keamanan
            $request->session()->regenerate();

            $user = Auth::user();

            // 💡 Cek role user
            if ($user->role == 'admin') {
                return redirect('/admin/dashboard')->with('success', 'Selamat datang kembali, Admin!');
            } elseif (Auth::user()->role == 'pelamar') {
                // ✅ Cek apakah pelamar sudah mengambil tes
                $hasTakenAnyTest = UserTest::where('user_id', $user->id)
                                          ->whereNotNull('completed_at') // 💡 Pastikan tes sudah diselesaikan
                                          ->exists();

                if (!$hasTakenAnyTest) {
                    // Jika belum mengambil tes, arahkan ke halaman pemilihan tes
                    return redirect()->route('pelamar.test.selection')->with('info', 'Anda perlu menyelesaikan tes terlebih dahulu.');
                }
                // Jika sudah mengambil tes, arahkan ke dashboard pelamar
                return redirect('/pelamar/dashboard')->with('success', 'Login berhasil!');
            }
        }

        // Jika autentikasi gagal atau user tidak memiliki role yang sesuai
        return redirect()->back()->withInput($request->only('username'))->with('error', 'Username atau password salah.'); // ✅ Lebih baik simpan input username
    


        // Jika autentikasi gagal atau user tidak memiliki role yang sesuai
        return redirect()->back()->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        Auth::logout();

        return view('welcome');
    }
}
