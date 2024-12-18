<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('customer_id');
            $table->string('c_first_name');
            $table->string('c_last_name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('contact');
            $table->string('street_address');
            $table->string('postal_code');
            $table->bigInteger('country')->unsigned();
            $table->string('city');
            $table->string('state');
            $table->string('entity_type');
            $table->string('acn')->nullable();
            $table->string('abn');
            $table->string('crn')->nullable();
            $table->string('contact_person')->nullable();
            $table->bigInteger('added_by');
            $table->string('is_active');
            $table->boolean('is_deleted');
            $table->timestamps();


            $table->foreign('country')->references('countries_id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
