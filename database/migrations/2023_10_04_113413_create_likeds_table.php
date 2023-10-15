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
        Schema::create('likeds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->longText('album_id')->nullable();
            $table->longText('artist_id')->nullable();
            $table->longText('audio_id')->nullable();
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
        Schema::dropIfExists('likeds');
    }
};
