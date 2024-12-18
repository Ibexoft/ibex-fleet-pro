<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance', function (Blueprint $table) {
            $table->bigIncrements('insurance_id');
            $table->bigInteger('vehicle_reg_id')->unsigned();
            $table->bigInteger('owner_id')->unsigned();
            $table->bigInteger('insurance_company_id')->unsigned();
            $table->string('policy_number');
            $table->string('insurance_premium');
            $table->string('ins_prem_direct_debit');
            $table->string('payment_method_id');
            $table->string('account_no')->nullable();
            $table->string('account_name');
            $table->integer('four_digit')->nullable();
            $table->string('bsb')->nullable();
            $table->date('insurance_start_date');
            $table->date('insurance_end_date');
            $table->bigInteger('added_by');
            $table->string('is_active');
            $table->boolean('is_deleted');
            $table->timestamps();


            $table->foreign('vehicle_reg_id')->references('vehicle_id')->on('vehicle');
            $table->foreign('owner_id')->references('customer_id')->on('customer');
            $table->foreign('insurance_company_id')->references('ic_id')->on('insurance_company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurance');
    }
}
