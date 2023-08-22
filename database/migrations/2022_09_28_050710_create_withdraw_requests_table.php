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
        Schema::create('withdraw_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('method_id');
            $table->foreignId('currency_convert_id')->constrained()->onDelete('cascade');
            $table->bigInteger('coins')->nullable();
            $table->string('account')->nullable();
            $table->double('amount')->default(0);
            $table->integer('approve_status')->default(1);
            $table->integer('status')->default(1);
            $table->foreign('method_id')->references('id')->on('withdraw_methods')->onDelete('cascade');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('withdraw_requests');
    }
};
