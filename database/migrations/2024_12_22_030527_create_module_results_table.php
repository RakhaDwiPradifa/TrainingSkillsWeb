<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleResultsTable extends Migration
{
    public function up(): void
    {
        Schema::create('module_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('EnrollmentID')
                  ->constrained('enrollments')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('ModuleID')
                  ->constrained('modules')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->float('Nilai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module_results');
    }
}