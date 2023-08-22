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
        Schema::create('adnetworks', function (Blueprint $table) {
            $table->id();
            $table->string('admob_interstitial_android')->nullable();
            $table->string('admob_interstitial_ios')->nullable();
            $table->string('admob_rewarded_android')->nullable();
            $table->string('admob_rewarded_ad_ios')->nullable();
            $table->string('applovin_rewarded_ad_android')->nullable();
            $table->string('applovin_rewarded_ad_ios')->nullable();
            $table->string('audience_network_rewarded_ad_android')->nullable();
            $table->string('audience_network_ad_ios')->nullable();
            $table->string('audience_network_interstitial_android')->nullable();
            $table->string('audience_network_interstitial_ios')->nullable();
            $table->string('offertoro_publisher_id')->nullable();
            $table->string('offertoro_app_id')->nullable();
            $table->string('offertoro_secret_key')->nullable();
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
        Schema::dropIfExists('adnetworks');
    }
};
