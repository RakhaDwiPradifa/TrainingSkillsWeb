<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('course_id')
                  ->constrained('courses')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->timestamp('tanggal_pembayaran');
            $table->decimal('jumlah', 10, 2);
            $table->string('metode_pembayaran');
            $table->enum('status', ['Berhasil', 'Gagal', 'Pending'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};