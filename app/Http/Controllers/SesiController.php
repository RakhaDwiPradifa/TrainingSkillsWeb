<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    // Menampilkan daftar sesi
    public function index()
    {
        $sesi = Sesi::with(['course', 'user'])->get(); // Mengambil semua sesi beserta relasi dengan course dan user
        return response()->json($sesi);
    }

    // Menampilkan sesi berdasarkan ID
    public function show($id)
    {
        $sesi = Sesi::with(['course', 'user'])->find($id); // Mencari sesi berdasarkan ID
        if ($sesi) {
            return response()->json($sesi);
        }
        return response()->json(['message' => 'Sesi tidak ditemukan'], 404);
    }

    // Menambahkan sesi baru
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id',
            'judul_sesi' => 'required|string|max:255',
            'deskripsi_sesi' => 'required|string',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'tipe' => 'required|in:Live,Rekaman',
        ]);

        $sesi = Sesi::create($request->all()); // Membuat sesi baru
        return response()->json($sesi, 201);
    }

    // Mengupdate sesi yang ada
    public function update(Request $request, $id)
    {
        $sesi = Sesi::find($id); // Mencari sesi berdasarkan ID
        if (!$sesi) {
            return response()->json(['message' => 'Sesi tidak ditemukan'], 404);
        }

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id',
            'judul_sesi' => 'required|string|max:255',
            'deskripsi_sesi' => 'required|string',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'tipe' => 'required|in:Live,Rekaman',
        ]);

        $sesi->update($request->all()); // Mengupdate data sesi
        return response()->json($sesi);
    }

    // Menghapus sesi berdasarkan ID
    public function destroy($id)
    {
        $sesi = Sesi::find($id); // Mencari sesi berdasarkan ID
        if (!$sesi) {
            return response()->json(['message' => 'Sesi tidak ditemukan'], 404);
        }

        $sesi->delete(); // Menghapus sesi
        return response()->json(['message' => 'Sesi berhasil dihapus']);
    }
}