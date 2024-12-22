<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'skills';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nama_skill',
        'deskripsi_skill',
        'kategori',
    ];

    // Tentukan kolom yang tidak boleh diisi (guarded)
    // protected $guarded = [];
}