<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance', function (Blueprint $table) {
            $table->bigIncrements('maintenance_id');
            $table->bigInteger('vehicle_reg_id')->unsigned();
            $table->bigInteger('workshop_id')->unsigned();
            $table->string('maintenance_type');
            $table->text('description')->nullable();
            $table->text('comments')->nullable();
            $table->string('bill_amount');
            $table->date('maintenance_date');
            $table->date('return_date');
            $table->date('actual_return_date')->nullable();
            $table->string('reference');
            $table->string('odo_meter');
            $table->string('paid_by');
            $table->integer('job_status');
            $table->bigInteger('added_by');
            $table->string('is_active');
            $table->boolean('is_deleted');
            $table->timestamps();


            $table->foreign('vehicle_reg_id')->references('vehicle_id')->on('vehicle');
            $table->foreign('workshop_id')->references('workshop_id')->on('workshop');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance');
    }
}
