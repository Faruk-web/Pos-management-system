<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplerPaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppler_payment_histories', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('supplier_return_product_id')->nullable();
            $table->float('withdrawal_amount')->default(0.0);
            $table->float('due_amount')->default(0.0);
            $table->float('total_blance')->default(0.0);
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
        Schema::dropIfExists('suppler_payment_histories');
    }
}
