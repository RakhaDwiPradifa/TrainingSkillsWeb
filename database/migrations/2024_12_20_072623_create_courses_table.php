<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('JudulKursus');
            $table->text('Deskripsi');
            $table->enum('Kategori', ['Manajemen Waktu', 'Public Speaking', 'Kepemimpinan', 'Lainnya']);
            $table->enum('Level', ['Pemula', 'Menengah', 'Lanjutan']);
            $table->timestamp('TanggalDibuat')->useCurrent(); 
            $table->enum('Status', ['Aktif', 'Nonaktif']);
            $table->decimal('Harga', 10, 2); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}