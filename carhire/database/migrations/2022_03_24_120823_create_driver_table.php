<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver', function (Blueprint $table) {
            $table->bigIncrements('driver_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('contact');
            $table->string('driver_license_no')->unique();
            $table->date('license_expiry_date');
            $table->date('dob');
            $table->string('street');
            $table->string('suburb')->nullable();
            $table->string('state');
            $table->string('city');
            $table->bigInteger('country')->unsigned();
            $table->string('ezi_debt')->nullable();
            $table->string('postal_code');
            $table->string('driver_image');
            $table->string('passport_image');
            $table->string('other_document')->nullable();
            $table->string('license_back_image');
            $table->string('license_front_image');
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
        Schema::dropIfExists('driver');
    }
}
