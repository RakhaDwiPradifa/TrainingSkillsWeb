<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Mengambil semua notifikasi
        $notifications = Notification::all();
        return response()->json($notifications);
    }

    public function show($id)
    {
        // Mengambil notifikasi berdasarkan ID
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notifikasi tidak ditemukan'], 404);
        }

        return response()->json($notification);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_notifikasi' => 'required|in:Pengingat,Pemberitahuan Kursus,Promosi',
            'pesan' => 'required|string',
            'status' => 'required|in:Dibaca,Tidak Dibaca',
            'tanggal' => 'required|date',
        ]);

        // Menambahkan notifikasi baru
        $notification = Notification::create($validated);

        return response()->json($notification, 201); // Status 201 untuk resource yang baru dibuat
    }

    public function update(Request $request, $id)
    {
        // Mengambil notifikasi berdasarkan ID
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notifikasi tidak ditemukan'], 404);
        }

        // Validasi input
        $validated = $request->validate([
            'jenis_notifikasi' => 'nullable|in:Pengingat,Pemberitahuan Kursus,Promosi',
            'pesan' => 'nullable|string',
            'status' => 'nullable|in:Dibaca,Tidak Dibaca',
            'tanggal' => 'nullable|date',
        ]);

        // Memperbarui notifikasi
        $notification->update($validated);

        return response()->json($notification);
    }

    public function destroy($id)
    {
        // Mengambil notifikasi berdasarkan ID
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notifikasi tidak ditemukan'], 404);
        }

        // Menghapus notifikasi
        $notification->delete();

        return response()->json(['message' => 'Notifikasi berhasil dihapus']);
    }
}