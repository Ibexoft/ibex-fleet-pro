<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->bigIncrements('contract_id');
            $table->bigInteger('vehicle_id')->unsigned();
            $table->bigInteger('driver_id')->unsigned();
            $table->bigInteger('insurance_id')->unsigned();
            $table->bigInteger('tracker_id')->unsigned();
            $table->string('bond');
            $table->string('held_by');
            $table->string('advance');
            $table->string('per_week');
            $table->string('rate_changes');
            $table->string('rego_due');
            $table->string('coi_due');
            $table->string('bhsl_due');
            $table->date('return_date');
            $table->string('biller_code');
            $table->string('reference_no');
            $table->string('vin')->nullable();
            $table->tinyInteger('is_active');
            $table->tinyInteger('is_deleted');
            $table->timestamps();


            // Foreign key constraints
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle');
            $table->foreign('driver_id')->references('driver_id')->on('driver');
            $table->foreign('insurance_id')->references('insurance_id')->on('insurance');
            $table->foreign('tracker_id')->references('tracking_id')->on('tracking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract');
    }
}
