<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->enum('jenis_notifikasi', ['Pengingat', 'Pemberitahuan Kursus', 'Promosi']);
            $table->text('pesan');
            $table->enum('status', ['Dibaca', 'Tidak Dibaca'])->default('Tidak Dibaca');
            $table->timestamp('tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};