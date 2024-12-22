<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    // Menampilkan semua keterampilan
    public function index()
    {
        $skills = Skill::all(); // Ambil semua data skill
        return response()->json($skills);
    }

    // Menampilkan keterampilan berdasarkan ID
    public function show($id)
    {
        $skill = Skill::find($id); // Cari skill berdasarkan ID

        if (!$skill) {
            return response()->json(['message' => 'Skill not found'], 404);
        }

        return response()->json($skill);
    }

    // Menambahkan keterampilan baru
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'nama_skill' => 'required|string|max:255',
            'deskripsi_skill' => 'nullable|string',
            'kategori' => 'required|string|max:255',
        ]);

        // Membuat skill baru
        $skill = Skill::create($validated);

        return response()->json($skill, 201); // Mengembalikan data skill yang baru dibuat dengan status 201
    }

    // Mengupdate keterampilan berdasarkan ID
    public function update(Request $request, $id)
    {
        $skill = Skill::find($id);

        if (!$skill) {
            return response()->json(['message' => 'Skill not found'], 404);
        }

        // Validasi data yang diterima
        $validated = $request->validate([
            'nama_skill' => 'required|string|max:255',
            'deskripsi_skill' => 'nullable|string',
            'kategori' => 'required|string|max:255',
        ]);

        // Update data skill
        $skill->update($validated);

        return response()->json($skill);
    }

    // Menghapus keterampilan berdasarkan ID
    public function destroy($id)
    {
        $skill = Skill::find($id);

        if (!$skill) {
            return response()->json(['message' => 'Skill not found'], 404);
        }

        // Hapus skill
        $skill->delete();

        return response()->json(['message' => 'Skill deleted successfully']);
    }
}