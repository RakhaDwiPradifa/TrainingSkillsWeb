<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'courses_id',
        'JudulModul',
        'DeskripsiModul',
        'Urutan',
        'Durasi',
        'File',
        'Konten',
    ];

    /**
     * Relasi ke model Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'courses_id');
    }
}