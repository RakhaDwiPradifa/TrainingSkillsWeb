<?php

namespace App\Http\Controllers;

use App\Models\UserSkill;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;

class UserSkillController extends Controller
{
    /**
     * Tampilkan daftar UserSkills.
     */
    public function index()
    {
        $userSkills = UserSkill::with('user', 'skill')->get();

        return response()->json($userSkills, 200);
    }

    /**
     * Simpan data UserSkill baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'skill_id' => 'required|exists:skills,id',
            'level' => 'required|in:Pemula,Menengah,Lanjutan',
            'tanggal_dicapai' => 'required|date',
        ]);

        $userSkill = UserSkill::create($validatedData);

        return response()->json([
            'message' => 'UserSkill berhasil ditambahkan.',
            'data' => $userSkill,
        ], 201);
    }

    /**
     * Tampilkan detail UserSkill.
     */
    public function show($id)
    {
        $userSkill = UserSkill::with('user', 'skill')->findOrFail($id);

        return response()->json($userSkill, 200);
    }

    /**
     * Update data UserSkill.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'level' => 'required|in:Pemula,Menengah,Lanjutan',
            'tanggal_dicapai' => 'required|date',
        ]);

        $userSkill = UserSkill::findOrFail($id);
        $userSkill->update($validatedData);

        return response()->json([
            'message' => 'UserSkill berhasil diperbarui.',
            'data' => $userSkill,
        ], 200);
    }

    /**
     * Hapus data UserSkill.
     */
    public function destroy($id)
    {
        $userSkill = UserSkill::findOrFail($id);
        $userSkill->delete();

        return response()->json([
            'message' => 'UserSkill berhasil dihapus.',
        ], 200);
    }
}