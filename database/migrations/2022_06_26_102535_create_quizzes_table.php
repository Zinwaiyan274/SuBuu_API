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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->text('name',100)->nullable();
            $table->string('image')->nullable();
            $table->integer('paid_status')->default(0); // 0. Free, 1. Paid
            $table->bigInteger('free_or_paid')->nullable();
            $table->bigInteger('reward_point')->nullable();
            $table->bigInteger('retake_point')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->foreign('category_id')->references('id')->on('quiz_categories')->onDelete('cascade');
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
        Schema::dropIfExists('quizzes');
    }
};
