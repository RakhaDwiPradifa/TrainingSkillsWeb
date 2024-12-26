<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan semua pengguna (Admin-only)
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Menampilkan pengguna berdasarkan ID
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    // Menyimpan pengguna baru (Admin-only)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email',
            'Password' => 'required|string|min:6',
            'JenisKelamin' => 'required|string|in:Laki-laki,Perempuan',
            'TanggalLahir' => 'required|date',
            'Alamat' => 'nullable|string',
            'NomorTelepon' => 'nullable|string|max:15',
            'Role' => 'required|string|in:Admin,Tutor,Siswa',
        ]);

        $user = User::create([
            'Nama' => $validated['Nama'],
            'Email' => $validated['Email'],
            'Password' => Hash::make($validated['Password']),
            'JenisKelamin' => $validated['JenisKelamin'],
            'TanggalLahir' => $validated['TanggalLahir'],
            'Alamat' => $validated['Alamat'],
            'NomorTelepon' => $validated['NomorTelepon'],
            'Role' => $validated['Role'],
            'TanggalDaftar' => now(),
        ]);

        return response()->json($user, 201);
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'Nama' => 'nullable|string|max:255',
            'Email' => 'nullable|email|unique:users,Email,' . $id,
            'Password' => 'nullable|string|min:6',
            'JenisKelamin' => 'nullable|string|in:Laki-laki,Perempuan',
            'TanggalLahir' => 'nullable|date',
            'Alamat' => 'nullable|string',
            'NomorTelepon' => 'nullable|string|max:15',
            'Role' => 'nullable|string|in:Admin,Tutor,Siswa',
        ]);

        $user->update([
            'Nama' => $validated['Nama'] ?? $user->Nama,
            'Email' => $validated['Email'] ?? $user->Email,
            'Password' => isset($validated['Password']) ? Hash::make($validated['Password']) : $user->Password,
            'JenisKelamin' => $validated['JenisKelamin'] ?? $user->JenisKelamin,
            'TanggalLahir' => $validated['TanggalLahir'] ?? $user->TanggalLahir,
            'Alamat' => $validated['Alamat'] ?? $user->Alamat,
            'NomorTelepon' => $validated['NomorTelepon'] ?? $user->NomorTelepon,
            'Role' => $validated['Role'] ?? $user->Role,
        ]);

        return response()->json($user);
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    // Register pengguna baru
    // Register pengguna baru
public function register(Request $request)
{
    try {
        // Validasi input
        $validated = $request->validate([
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email',
            'Password' => 'required|string|min:8|confirmed',
            'JenisKelamin' => 'required|string|in:Laki-laki,Perempuan',
            'TanggalLahir' => 'required|date',
            'Alamat' => 'nullable|string',
            'NomorTelepon' => 'nullable|string|max:15',
        ]);

        // Buat pengguna baru
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

        // Kembalikan respons sukses
        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
        ], 201);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Jika validasi gagal
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        // Penanganan error lainnya
        return response()->json([
            'message' => 'Registration failed',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    // Login pengguna
    public function login(Request $request)
    {
        $validated = $request->validate([
            'Email' => 'required|email',
            'Password' => 'required|string',
        ]);

        if (Auth::attempt(['Email' => $validated['Email'], 'password' => $validated['Password']])) {
            $user = Auth::user();
            $token = $user->createToken('appToken')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}

