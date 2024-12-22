<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesiTable extends Migration
{
    public function up()
    {
        Schema::create('sesi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')
                  ->constrained('courses')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('judul_sesi');
            $table->text('deskripsi_sesi');
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->enum('tipe', ['Live', 'Rekaman']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sesi');
    }
}