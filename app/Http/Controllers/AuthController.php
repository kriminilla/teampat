<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $response = Http::post("http://127.0.0.1:8000/api/login", [
            'name' => $request->name,
            'password' => $request->password,
        ]);

        if ($response->ok()) {
            $data = $response->json();

            $token = $data['token'] ?? null;

            if ($token) {
                return view('auth.save_token', ['token' => $token]);
            }

            return back()->withErrors(['Token missing from response.']);
            //return redirect()->route('dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors(['Invalid credentials']);
    }

    public function register(Request $request)
    {
        $response = Http::post("http://127.0.0.1:8000/api/register", [
            'name' => $request->name,
            'password' => $request->password,
            'isAdmin' => false,
        ]);

        if ($response->ok()) {
            return redirect()->route('login.form')->with('success', 'Registration successful! Please log in.');
        }

        return back()->withErrors(['Registration failed.']);
    }
}