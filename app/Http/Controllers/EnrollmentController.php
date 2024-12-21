<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['user', 'course'])->get();
        return response()->json($enrollments);
    }

    public function show($id)
    {
        $enrollment = Enrollment::with(['user', 'course'])->findOrFail($id);
        return response()->json($enrollment);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'courses_id' => 'required|exists:courses,id',
            'TanggalEnrol' => 'required|date',
            'Status' => 'required|in:Sedang Berlangsung,Selesai,Dibatalkan',
            'NilaiAkhir' => 'nullable|numeric',
        ]);

        $enrollment = Enrollment::create($validated);
        return response()->json($enrollment, 201);
    }

    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'courses_id' => 'required|exists:courses,id',
            'TanggalEnrol' => 'required|date',
            'Status' => 'required|in:Sedang Berlangsung,Selesai,Dibatalkan',
            'NilaiAkhir' => 'nullable|numeric',
        ]);

        $enrollment->update($validated);
        return response()->json($enrollment);
    }

    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();
        return response()->json(['message' => 'Enrollment deleted successfully']);
    }
}