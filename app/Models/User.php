<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'Nama',
        'Email',
        'Password',
        'JenisKelamin',
        'TanggalLahir',
        'Alamat',
        'NomorTelepon',
        'TanggalDaftar',
        'Role',
        'FotoProfil',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'Password', // Jangan lupa untuk menyembunyikan password
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'TanggalLahir' => 'date',
            'TanggalDaftar' => 'datetime',
            'Password' => 'hashed',
        ];
    }
}