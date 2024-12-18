<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->bigIncrements('booking_id');
            $table->bigInteger('vehicle_reg_id')->unsigned();
            $table->bigInteger('driver_id')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('amount');
            $table->text('comments')->nullable();
            $table->string('documents');
            $table->string('bond_held');
            $table->integer('added_by');
            $table->string('date_status');
            $table->string('is_active');
            $table->boolean('is_deleted');
            $table->timestamps();
            $table->date('actual_return_date')->nullable();

            $table->foreign('vehicle_reg_id')->references('vehicle_id')->on('vehicle');
            $table->foreign('driver_id')->references('driver_id')->on('driver');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking');
    }
}
