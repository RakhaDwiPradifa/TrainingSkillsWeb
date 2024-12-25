<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register pengguna baru
    public function register(Request $request)
    {
        $validated = $request->validate([
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email',
            'Password' => 'required|string|min:8|confirmed',
            'JenisKelamin' => 'required|string|in:Laki-laki,Perempuan',
            'TanggalLahir' => 'required|date',
            'Alamat' => 'nullable|string',
            'NomorTelepon' => 'nullable|string|max:15',
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'Nama' => $validated['Nama'],
            'Email' => $validated['Email'],
            'Password' => Hash::make($validated['Password']),
            'JenisKelamin' => $validated['JenisKelamin'],
            'TanggalLahir' => $validated['TanggalLahir'],
            'Alamat' => $validated['Alamat'],
            'NomorTelepon' => $validated['NomorTelepon'],
            'TanggalDaftar' => now(),
            'Role' => 'Siswa', // Default role
        ]);

        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
        ], 201);
    }

// Login pengguna
public function login(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'Email' => 'required|email',
        'Password' => 'required|string|min:8',
    ]);

    // Cek kredensial
    $user = User::where('Email', $validated['Email'])->first();

    if ($user && Hash::check($validated['Password'], $user->getAuthPassword())) {
        // Kredensial valid, buat token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    // Kredensial tidak valid
    return response()->json(['message' => 'Invalid credentials'], 401);
}
}