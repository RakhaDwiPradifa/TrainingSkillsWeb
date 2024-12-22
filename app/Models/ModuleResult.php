<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleResult extends Model
{
    use HasFactory;

    protected $table = 'module_results';

    protected $fillable = [
        'EnrollmentID',
        'ModuleID',
        'Nilai',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'EnrollmentID');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'ModuleID');
    }
}