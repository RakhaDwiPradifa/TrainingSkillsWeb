<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courses_id')
                  ->constrained('courses')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('JudulModul');
            $table->text('DeskripsiModul');
            $table->integer('Urutan');
            $table->integer('Durasi');
            $table->string('File');
            $table->enum('Konten', ['teks', 'video', 'dokumen']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
}