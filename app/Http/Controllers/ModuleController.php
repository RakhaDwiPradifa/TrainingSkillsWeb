<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ModuleController extends Controller
{
    // Menampilkan semua modul
    public function index()
    {
        $modules = Module::all();
        return response()->json($modules);
    }

    // Menampilkan modul berdasarkan ID
    public function show($id)
    {
        $module = Module::findOrFail($id);
        return response()->json($module);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'courses_id' => 'required|exists:courses,id',
            'JudulModul' => 'required|string|max:255',
            'DeskripsiModul' => 'required|string',
            'Urutan' => 'required|integer',
            'Durasi' => 'required|integer',
            'File' => 'required|string',  // Validasi nama file sebagai string
            'Konten' => 'required|in:teks,video,dokumen'
        ]);

        // Validasi ekstensi file (misalnya mp4, pdf, docx, ppt)
        $fileName = $validated['File'];
        $validExtensions = ['mp4', 'pdf', 'docx', 'ppt'];  
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (!in_array($fileExtension, $validExtensions)) {
            return response()->json([
                'message' => 'File type not allowed. Allowed types are: mp4, pdf, docx, ppt.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Anda bisa menyimpan path atau nama file sebagai string di database, tidak perlu mengunggah file
        // Di sini kita menganggap file sudah ada di folder yang sesuai
        // Misalnya di folder public/files
        $filePath = 'files/' . $fileName;

        try {
            $module = Module::create([
                'courses_id' => $validated['courses_id'],
                'JudulModul' => $validated['JudulModul'],
                'DeskripsiModul' => $validated['DeskripsiModul'],
                'Urutan' => $validated['Urutan'],
                'Durasi' => $validated['Durasi'],
                'File' => $filePath,  // Simpan path file sebagai string
                'Konten' => $validated['Konten']
            ]);

            return response()->json([
                'message' => 'Modul Created Successfully',
                'data' => $module
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create module',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, int $id)
    {
        $module = Module::find($id);
        if (!$module) {
            return response()->json([
                'message' => 'Module not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'JudulModul' => 'required|string|max:255',
            'DeskripsiModul' => 'required|string',
            'Urutan' => 'required|integer',
            'Durasi' => 'required|integer',
            'File' => 'nullable|string',  // File bisa kosong, karena hanya string
            'Konten' => 'required|in:teks,video,dokumen'
        ]);

        // Jika ada perubahan file
        if ($request->has('File')) {
            $fileName = $validated['File'];
            $validExtensions = ['mp4', 'pdf', 'docx', 'ppt'];  
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            if (!in_array($fileExtension, $validExtensions)) {
                return response()->json([
                    'message' => 'File type not allowed. Allowed types are: mp4, pdf, docx, ppt.'
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            // Update path file baru, tidak perlu unggah ulang file
            $validated['File'] = 'files/' . $fileName;
        }

        try {
            $module->update($validated);

            return response()->json([
                'message' => 'Module Updated Successfully',
                'data' => $module
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update module',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        $module = Module::find($id);
        if (!$module) {
            return response()->json([
                'message' => 'Module not found'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            // Hapus file yang terkait dengan modul jika ada
            $filePath = public_path($module->File);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Hapus modul dari database
            $module->delete();

            return response()->json([
                'message' => 'Module Deleted Successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete module',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
