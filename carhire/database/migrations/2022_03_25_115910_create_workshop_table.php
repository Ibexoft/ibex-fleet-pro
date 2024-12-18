<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop', function (Blueprint $table) {
            $table->bigIncrements('workshop_id');
            $table->string('workshop_type');
            $table->string('workshop_name');
            $table->text('workshop_address');
            $table->string('organizer_email');
            $table->string('organizer_name');
            $table->string('organizer_contact');
            $table->bigInteger('added_by');
            $table->string('is_active');
            $table->boolean('is_deleted');
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
        Schema::dropIfExists('workshop');
    }
}
