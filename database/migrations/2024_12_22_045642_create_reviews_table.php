<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('course_id')
                  ->constrained('courses')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->unsignedTinyInteger('rating')
                  ->check(function ($rating) {
                      return $rating >= 1 && $rating <= 5;
                  });
            $table->text('komentar')->nullable();
            $table->date('tanggal_review');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}