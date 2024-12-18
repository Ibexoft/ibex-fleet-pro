<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeReturnDateTypeInBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking', function (Blueprint $table) {
            if (Schema::hasColumn('booking', 'actual_return_date')) {
                $table->dropColumn('actual_return_date');
            }
        });

        Schema::table('booking', function (Blueprint $table) {
            $table->timestamp('actual_return_date')->nullable()->after('date_status');
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
            //
        });
    }
}
