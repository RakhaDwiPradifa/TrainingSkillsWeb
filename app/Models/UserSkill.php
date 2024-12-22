<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    use HasFactory;

    protected $table = 'user_skills';

    protected $fillable = [
        'user_id',
        'skill_id',
        'level',
        'tanggal_dicapai',
    ];

    /**
     * Relasi ke tabel Users.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke tabel Skills.
     */
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}