<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('courses_id')
                  ->constrained('courses')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->date('TanggalEnrol');
            $table->enum('Status', ['Sedang Berlangsung', 'Selesai', 'Dibatalkan']);
            $table->float('NilaiAkhir')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
}