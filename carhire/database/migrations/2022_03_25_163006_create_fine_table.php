<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fine', function (Blueprint $table) {
            $table->bigIncrements('fine_id');
            $table->bigInteger('vehicle_reg_id')->unsigned();
            $table->bigInteger('payable_id')->unsigned();
            $table->string('payable_type');
            $table->text('notice');
            $table->string('notice_type');
            $table->date('due_date');
            $table->string('amount');
            $table->date('date_of_offence');
            $table->date('date_process');
            $table->string('comment')->nullable();
            $table->bigInteger('added_by');
            $table->string('is_active');
            $table->boolean('is_deleted');
            $table->timestamps();

            $table->foreign('vehicle_reg_id')->references('vehicle_id')->on('vehicle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fine');
    }
}
