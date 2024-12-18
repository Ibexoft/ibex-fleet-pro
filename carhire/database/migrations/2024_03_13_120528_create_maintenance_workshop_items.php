<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceWorkshopItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_workshop_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_workshop_id')->constrained('maintenance_workshop_details');
            $table->string('parts_used');
            $table->float('rrp');
            $table->integer('quantity');
            $table->string('is_active')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('maintenance_workshop_items');
    }
}
