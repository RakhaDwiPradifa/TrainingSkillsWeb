<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Tambahkan ini

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
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
     * @var array<string>
     */
    protected $hidden = [
        'Password',
        'remember_token',
    ];

    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->Password;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'TanggalLahir' => 'date',
        'TanggalDaftar' => 'datetime',
    ];
}
