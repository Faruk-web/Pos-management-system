<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_references', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');

            $table->string('reference_name_one');
            $table->string('reference_mobile_one');
            $table->string('reference_relationship_one');
            $table->string('reference_address_one');

            $table->string('reference_name_two');
            $table->string('reference_mobile_num_two');
            $table->string('reference_relationship_two');
            $table->string('reference_address_two');

            $table->string('reference_name_3')->nullable();
            $table->string('reference_mobile_num_3')->nullable();
            $table->string('reference_relationship_3')->nullable();
            $table->string('reference_address_3')->nullable();

             $table->string('reference_name_4')->nullable();
             $table->string('reference_mobile_num_4')->nullable();
             $table->string('reference_relationship_4')->nullable();
             $table->string('reference_address_4')->nullable();
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
        Schema::dropIfExists('employee_references');
    }
}