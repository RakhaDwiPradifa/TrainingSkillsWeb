<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key tabel
    public $timestamps = true; // Gunakan timestamps (created_at, updated_at)

    protected $fillable = [
        'user_id',
        'jenis_notifikasi',
        'pesan',
        'status',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'datetime', // Mengonversi tanggal ke tipe datetime
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}