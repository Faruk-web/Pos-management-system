<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {  
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('street_address');
            $table->string('district_id');
            $table->string('thana_id');
            $table->string('floor_no')->nullable();
            $table->string('appartment_no')->nullable();
            $table->string('phone_no');
            $table->string('name');
            $table->boolean('status');
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
        Schema::dropIfExists('customer_addresses');
    }
}
