<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_category_id')->nullable();
            $table->unsignedBigInteger('merchant_id')->nullable();
            //auto generate
            $table->string('merchant_package_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('package_weight')->nullable();
            $table->DateTime('customer_expected_delivery_time')->nullable();
            $table->string('payment_type')->nullable();
            $table->float('product_price')->default(0.00)->nullable();
            $table->float('delivery_fee')->default(0.00)->nullable();
            $table->mediumText('customer_address')->nullable();
            $table->mediumText('status')->nullable();

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
        Schema::dropIfExists('merchant_packages');
    }
}
