<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_movie_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_category_id');
            $table->unsignedBigInteger('movie_id');
            $table->timestamps();

            $table->foreign('movie_category_id')->references('id')->on('movie_categories')->onDelete('cascade');
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_movie_category');
    }
};
