<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'courses';

    /**
     * Kolom-kolom yang dapat diisi massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'JudulKursus',
        'Deskripsi',
        'Kategori',
        'Level',
        'TanggalDibuat',
        'Status',
        'Harga',
    ];

    /**
     * Tipe data kolom yang perlu di-cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'TanggalDibuat' => 'datetime', // Agar TanggalDibuat di-cast menjadi objek Carbon
        'Harga' => 'decimal:2', // Agar harga dicatat dengan 2 angka desimal
    ];
}