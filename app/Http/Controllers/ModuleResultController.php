<?php

namespace App\Http\Controllers;

use App\Models\ModuleResult;
use Illuminate\Http\Request;

class ModuleResultController extends Controller
{
    public function index()
    {
        $moduleResults = ModuleResult::all();
        return response()->json($moduleResults);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'EnrollmentID' => 'required|exists:enrollments,id',
            'ModuleID' => 'required|exists:modules,id',
            'Nilai' => 'required|numeric|min:0|max:100',
        ]);

        $moduleResult = ModuleResult::create($validatedData);
        return response()->json(['message' => 'Module result created successfully', 'data' => $moduleResult], 201);
    }

    public function show($id)
    {
        $moduleResult = ModuleResult::findOrFail($id);
        return response()->json($moduleResult);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'EnrollmentID' => 'sometimes|exists:enrollments,id',
            'ModuleID' => 'sometimes|exists:modules,id',
            'Nilai' => 'sometimes|numeric|min:0|max:100',
        ]);

        $moduleResult = ModuleResult::findOrFail($id);
        $moduleResult->update($validatedData);
        return response()->json(['message' => 'Module result updated successfully', 'data' => $moduleResult]);
    }

    public function destroy($id)
    {
        $moduleResult = ModuleResult::findOrFail($id);
        $moduleResult->delete();
        return response()->json(['message' => 'Module result deleted successfully']);
    }
}