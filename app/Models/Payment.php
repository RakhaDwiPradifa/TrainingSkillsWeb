<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments'; // Nama tabel yang digunakan (optional, karena Laravel sudah otomatis mengikuti plural nama model)

    protected $primaryKey = 'payment_id'; // Menentukan primary key, jika bukan id

    protected $fillable = [
        'user_id',
        'course_id',
        'tanggal_pembayaran',
        'jumlah',
        'metode_pembayaran',
        'status',
    ];

    protected $casts = [
        'tanggal_pembayaran' => 'datetime', // Mengubah format tanggal
        'jumlah' => 'decimal:2', // Menentukan jumlah pembayaran dengan 2 desimal
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}