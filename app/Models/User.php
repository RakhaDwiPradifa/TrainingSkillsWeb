<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'Role',  // Pastikan 'role' dengan huruf kecil
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
        'Role' => 'string',  // Anda bisa menambahkan ini jika diperlukan
    ];

    /**
     * Check if the user has a specific role.
     */
    public function hasRole($role)
    {
        return $this->Role === $role;
    }
}

