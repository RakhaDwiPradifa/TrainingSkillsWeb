<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;

    protected $table = 'sesi'; // Nama tabel di database
    protected $fillable = [
        'course_id',
        'user_id',
        'judul_sesi',
        'deskripsi_sesi',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'tipe',
    ];

    // Relasi dengan tabel courses
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}