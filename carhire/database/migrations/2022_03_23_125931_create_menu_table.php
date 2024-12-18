<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('menu_id');
            $table->string('name');
            $table->boolean('status');
            $table->integer('menu_level');
            $table->integer('parent_id');
            $table->string('menu_route');
            $table->integer('display_order');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->boolean('is_route');
            $table->string('menu_icon');
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
        Schema::dropIfExists('menu');
    }
}
