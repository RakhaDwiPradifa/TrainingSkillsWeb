<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    // Menampilkan semua kursus
    public function index()
    {
        $courses = Course::all(); // Mengambil semua data kursus
        return response()->json($courses); // Mengembalikan data kursus dalam bentuk JSON
    }

    // Menampilkan kursus berdasarkan ID
    public function show($id)
    {
        // Mencari kursus berdasarkan ID dengan handle jika tidak ditemukan
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], Response::HTTP_NOT_FOUND); // Jika kursus tidak ditemukan
        }

        return response()->json($course); // Mengembalikan data kursus yang ditemukan
    }

    // Membuat kursus baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'JudulKursus' => 'required|string|max:255',
            'Deskripsi' => 'required|string',
            'Kategori' => 'required|string',
            'Level' => 'required|string|in:Pemula,Menengah,Lanjutan',
            'TanggalDibuat' => 'required|date',
            'Status' => 'required|string|in:Aktif,Nonaktif',
            'Harga' => 'required|numeric',
        ]);

        // Membuat kursus baru
        $course = Course::create($validated);

        // Mengembalikan data kursus yang baru dibuat
        return response()->json($course, Response::HTTP_CREATED);
    }

    // Mengupdate data kursus
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'JudulKursus' => 'required|string|max:255',
            'Deskripsi' => 'required|string',
            'Kategori' => 'required|string',
            'Level' => 'required|string|in:Pemula,Menengah,Lanjutan',
            'TanggalDibuat' => 'required|date',
            'Status' => 'required|string|in:Aktif,Nonaktif',
            'Harga' => 'required|numeric',
        ]);

        // Mencari kursus berdasarkan ID
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], Response::HTTP_NOT_FOUND); // Jika kursus tidak ditemukan
        }

        // Mengupdate data kursus
        $course->update($validated);

        return response()->json($course); // Mengembalikan data kursus yang sudah diperbarui
    }

    // Menghapus kursus
    public function destroy($id)
    {
        // Mencari kursus berdasarkan ID
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], Response::HTTP_NOT_FOUND); // Jika kursus tidak ditemukan
        }

        // Menghapus kursus
        $course->delete();

        return response()->json(['message' => 'Course deleted successfully']); // Mengembalikan pesan sukses
    }
}
