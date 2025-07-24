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

    public function indexAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403); // Akses ditolak
        }
        return view('indexAdmin');
    }

    public function indexUser()
    {
        if (!Auth::check() || Auth::user()->role !== 'user') {
            abort(403); // Akses ditolak
        }
        return view('indexUser');
    }


    public function showRegisterForm()
    {
        return view('register'); // Pastikan view ini ada
    }

    public function loggedin_user(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Buat key unik untuk pembatasan login
        $key = Str::lower($request->input('name')) . '|' . $request->ip();

        // Cek apakah ada terlalu banyak percobaan login
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $remainingTime = RateLimiter::availableIn($key);
            return redirect()->back()->with('gagal', 'Terlalu banyak percobaan login. Coba lagi dalam ' . $remainingTime . ' detik.');
        }

        // Ambil pengguna dari tabel users menggunakan model User berdasarkan name
        $user = User::where('name', $request->input('name'))->first();

        // Periksa apakah pengguna ada dan password cocok
        // Menggunakan Auth::attempt adalah cara terbaik di Laravel
        if (Auth::attempt(['name' => $request->input('name'), 'password' => $request->input('password')])) {
            RateLimiter::clear($key);
            $request->session()->regenerate();

            // Simpan session data
            $request->session()->put([
                'id' => Auth::id(),
                'name' => Auth::user()->name,
                'role' => Auth::user()->role,
            ]);

            // Arahkan berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('indexAdmin'); // Buat route ini
            } else {
                return redirect()->route('indexUser'); // Untuk user biasa
            }
        } else {
            // Jika login gagal, tambahkan hit ke RateLimiter
            RateLimiter::hit($key, 60); // Tambah percobaan, reset setelah 60 detik

            // Redirect kembali dengan pesan error
            return redirect()->back()->withInput($request->only('name'))
                                     ->with('gagal', 'name atau password anda salah.');
        }
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // password_confirmation juga harus ada
        ]);

        // Simpan user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password di sini!
            'role' => 'user',
        ]);

        return redirect()->route('login.form')->with('success', 'Pendaftaran berhasil! Silakan login.');
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
        return redirect()->route('login.form')->with('success', 'Anda telah berhasil keluar.');
    }
}