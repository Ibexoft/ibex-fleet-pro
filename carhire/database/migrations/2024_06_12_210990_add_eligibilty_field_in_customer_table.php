<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddEligibiltyFieldInCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer', function (Blueprint $table) {
            if (!Schema::hasColumn('customer', 'eligibility')) {
                $table->string('eligibility')->after('crn')->default('Ineligible');
            }
        });

        DB::table('customer')->where('eligibility','')->update(['eligibility' => 'Ineligible']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer', function (Blueprint $table) {
            //
        });
    }
}
