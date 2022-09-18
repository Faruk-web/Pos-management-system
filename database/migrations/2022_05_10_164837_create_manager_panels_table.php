<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagerPanelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_panels', function (Blueprint $table) {
            $table->id();
            $table->string('shop_manager_id_code');
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->longText('shop_manager_address')->nullable();
            $table->longText('shop_manager_address2')->nullable();
            $table->string('shop_manager_photo')->nullable();
            $table->string('shop_manager_status')->nullable();
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
        Schema::dropIfExists('manager_panels');
    }
}
