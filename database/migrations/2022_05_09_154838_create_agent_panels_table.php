<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentPanelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_panels', function (Blueprint $table) {
            $table->id();
            $table->string('shop_agent_id_code');
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->longText('shop_agent_address')->nullable();
            $table->string('shop_agent_photo')->nullable();
            $table->string('shop_agent_status')->nullable();
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
        Schema::dropIfExists('agent_panels');
    }
}
