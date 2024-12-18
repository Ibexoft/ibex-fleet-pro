<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle', function (Blueprint $table) {
            $table->bigIncrements('vehicle_id');
            $table->bigInteger('owner')->unsigned();
            $table->string('fuel_type');
            $table->string('vehicle_type',25);
            $table->string('vehicle_registration_no',25);
            $table->string('vehicle_engine_no',25);
            $table->BigInteger('vehicle_making_company')->unsigned();
            $table->string('vehicle_model',100)->nullable();
            $table->string('vehicle_year',10);
            $table->string('vehicle_color',20);
            $table->string('biller_code')->nullable();
            $table->string('reference_no')->nullable();
            $table->text('bepay_detail')->nullable();
            $table->BigInteger('added_by');
            $table->string('vin');
            $table->string('admin_fee')->nullable();
            $table->string('vehicle_status')->nullable();
            $table->string('is_active');
            $table->boolean('is_deleted');
            $table->timestamps();

            $table->foreign('owner')->references('customer_id')->on('customer');
            $table->foreign('vehicle_making_company')->references('brand_id')->on('brands');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle');
    }
}
