<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_category_id')->nullable();
            $table->unsignedBigInteger('merchant_zone_id')->nullable();
            $table->string('merchant_name')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('merchant_owner_name')->nullable();
            $table->string('merchant_phone_one')->nullable();
            $table->string('merchant_phone_two')->nullable();
            $table->string('merchant_bank_details')->nullable();
            $table->string('merchant_mobile_bank_details')->nullable();
            $table->longText('merchant_address')->nullable();
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
        Schema::dropIfExists('merchants');
    }
}
