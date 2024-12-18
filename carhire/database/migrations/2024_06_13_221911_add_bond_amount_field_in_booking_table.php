<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBondAmountFieldInBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('booking', 'bond_held')) {
            Schema::table('booking', function (Blueprint $table) {
                $table->dropColumn('bond_held');
            });
        }

        Schema::table('booking', function (Blueprint $table) {

            $table->foreignId('bond_held')->nullable()->constrained('customer', 'customer_id')->after('handover_checklist_image');
            $table->float('bond_amount')->nullable()->after('bond_held');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking', function (Blueprint $table) {

            $table->dropColumn(['bond_held', 'bond_amount']);
            $table->string('bond_held')->after('handover_checklist_image'); 

        });
    }
}
