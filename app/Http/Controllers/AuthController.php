<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('app');  // Pastikan menggunakan 'login' bukan 'auth.login'
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validasi form login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cek kredensial login
        if (Auth::attempt($credentials)) {
            // Redirect ke dashboard setelah login berhasil
            return redirect()->intended('/dashboard')->with('status', 'Login successful!');
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
}