<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Import model User

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); 
    }

    public function showRegisterForm()
    {
        return view('auth.register'); // Pastikan view ini ada
    }

    public function loggedin_user(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Buat key unik untuk pembatasan login
        $key = Str::lower($request->input('email')) . '|' . $request->ip();

        // Cek apakah ada terlalu banyak percobaan login
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $remainingTime = RateLimiter::availableIn($key);
            return redirect()->back()->with('gagal', 'Terlalu banyak percobaan login. Coba lagi dalam ' . $remainingTime . ' detik.');
        }

        // Ambil pengguna dari tabel users menggunakan model User berdasarkan email
        $user = User::where('email', $request->input('email'))->first();

        // Periksa apakah pengguna ada dan password cocok
        // Menggunakan Auth::attempt adalah cara terbaik di Laravel
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            // Jika login berhasil
            RateLimiter::clear($key); // Reset percobaan login

            // Regenerasi sesi
            $request->session()->regenerate();

            // Jika kamu ingin menyimpan nama user ke sesi, bisa seperti ini (sesuai kolom 'name' di model User)
            $request->session()->put([
                'userid' => Auth::id(), // ID user yang sedang login
                'name' => Auth::user()->name, // Nama user
                'email' => Auth::user()->email, // Email user
            ]);

            // Redirect ke halaman setelah login berhasil (misal: dashboard)
            return redirect()->route('dashboard'); 

        } else {
            // Jika login gagal, tambahkan hit ke RateLimiter
            RateLimiter::hit($key, 60); // Tambah percobaan, reset setelah 60 detik

            // Redirect kembali dengan pesan error
            return redirect()->back()->withInput($request->only('email'))
                                     ->with('gagal', 'Email atau password anda salah.');
        }
    }

    // Logout method
    public function logout(Request $request) // Mengganti nama method jika ini memang untuk logout umum atau biarkan logout sesuai dengan konteks sebelumnya
    {
        Auth::logout(); // Logout user yang sedang login

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent session fixation
        $request->session()->regenerateToken();

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}