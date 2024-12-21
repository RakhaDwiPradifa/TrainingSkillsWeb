<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan semua pengguna
    public function index()
    {
        $users = User::all(); // Ambil semua data pengguna
        return response()->json($users); // Kembalikan sebagai JSON
    }

    // Menampilkan pengguna berdasarkan ID
    public function show($id)
    {
        $user = User::find($id); // Cari pengguna berdasarkan ID

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404); // Jika tidak ditemukan, kembalikan pesan error
        }

        return response()->json($user); // Kembalikan data pengguna
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email',
            'Password' => 'required|string|min:6',
            'JenisKelamin' => 'required|string|in:Laki-laki,Perempuan',
            'TanggalLahir' => 'required|date',
            'Alamat' => 'nullable|string',
            'NomorTelepon' => 'nullable|string|max:15',
            // Role tidak perlu divalidasi karena kita tetapkan default "Siswa"
        ]);

        // Membuat pengguna baru dengan data yang sudah divalidasi
        $user = User::create([
            'Nama' => $validated['Nama'],
            'Email' => $validated['Email'],
            'Password' => bcrypt($validated['Password']), // Pastikan password di-hash
            'JenisKelamin' => $validated['JenisKelamin'],
            'TanggalLahir' => $validated['TanggalLahir'],
            'Alamat' => $validated['Alamat'],
            'NomorTelepon' => $validated['NomorTelepon'],
            'TanggalDaftar' => now(),
            'Role' => 'Siswa', // Set role default menjadi 'Siswa'
        ]);

        return response()->json($user, 201); // Kembalikan data pengguna yang baru dibuat
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email,' . $id,
            'Password' => 'nullable|string|min:6',
            'JenisKelamin' => 'required|string|in:Laki-laki,Perempuan',
            'TanggalLahir' => 'required|date',
            'Alamat' => 'nullable|string',
            'NomorTelepon' => 'nullable|string|max:15',
            'Role' => 'required|string|in:Admin,Tutor,Siswa',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update([
            'Nama' => $validated['Nama'],
            'Email' => $validated['Email'],
            'Password' => $validated['Password'] ? bcrypt($validated['Password']) : $user->Password,
            'JenisKelamin' => $validated['JenisKelamin'],
            'TanggalLahir' => $validated['TanggalLahir'],
            'Alamat' => $validated['Alamat'],
            'NomorTelepon' => $validated['NomorTelepon'],
            'Role' => $validated['Role'],
        ]);

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}