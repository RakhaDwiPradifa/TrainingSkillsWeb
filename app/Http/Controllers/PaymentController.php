<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        // Mengambil semua data pembayaran
        $payments = Payment::all();
        return response()->json($payments);
    }

    public function show($id)
    {
        // Menampilkan data pembayaran berdasarkan ID
        $payment = Payment::find($id);

        if ($payment) {
            return response()->json($payment);
        }

        return response()->json(['message' => 'Payment not found'], 404);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,user_id',
            'course_id' => 'required|exists:courses,course_id',
            'tanggal_pembayaran' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'status' => 'required|in:Berhasil,Gagal,Pending',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Menyimpan data pembayaran baru
        $payment = Payment::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'jumlah' => $request->jumlah,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => $request->status,
        ]);

        return response()->json($payment, 201);
    }

    public function update(Request $request, $id)
    {
        // Menampilkan data pembayaran berdasarkan ID
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,user_id',
            'course_id' => 'required|exists:courses,course_id',
            'tanggal_pembayaran' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'status' => 'required|in:Berhasil,Gagal,Pending',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update data pembayaran
        $payment->update([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'jumlah' => $request->jumlah,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => $request->status,
        ]);

        return response()->json($payment);
    }

    public function destroy($id)
    {
        // Menghapus data pembayaran berdasarkan ID
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->delete();
        return response()->json(['message' => 'Payment deleted successfully']);
    }
}