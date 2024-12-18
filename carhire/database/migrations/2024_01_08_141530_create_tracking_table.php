<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking', function (Blueprint $table) {
            $table->bigIncrements('tracking_id');
            $table->string('tracker_name');
            $table->string('tracker_imei')->unique();
            $table->string('cell_provider');
            $table->string('mobile_no');
            $table->string('iccid_no');
            $table->bigInteger('vehicle_id')->unsigned();
            $table->bigInteger('allocated_to')->nullable()->unsigned();
            $table->bigInteger('added_by');
            $table->string('is_active');
            $table->boolean('is_deleted');
            $table->timestamps();


            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle');
            $table->foreign('allocated_to')->references('driver_id')->on('driver');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracking');
    }
}
