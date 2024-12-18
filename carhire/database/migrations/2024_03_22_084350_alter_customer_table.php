<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('customer', 'date_of_birth')) {
            Schema::table('customer', function (Blueprint $table) {
                $table->date('date_of_birth')->nullable()->after('email');
            });
        }
        if (!Schema::hasColumn('customer', 'trustee')) {
            Schema::table('customer', function (Blueprint $table) {
                $table->string('trustee')->nullable()->after('date_of_birth');
            });
        }
        if (Schema::hasColumn('customer', 'contact_person')) {
            Schema::table('customer', function (Blueprint $table) {
                $table->dropColumn('contact_person');
            });
        }
        if (!Schema::hasColumn('customer', 'contact_person')) {
            Schema::table('customer', function (Blueprint $table) {
                $table->foreignId('contact_person')->nullable()->constrained('customer','customer_id')->after('trustee');

            });
        }
        if (Schema::hasColumn('customer', 'c_last_name')) {
            Schema::table('customer', function (Blueprint $table) {
                $table->dropColumn('c_last_name');
            });
        }
        if (Schema::hasColumn('customer', 'password')) {
            Schema::table('customer', function (Blueprint $table) {
                $table->dropColumn('password');
            });
        }
        if (!Schema::hasColumn('customer', 'c_last_name')) {
            Schema::table('customer', function (Blueprint $table) {
                $table->string('c_last_name')->nullable()->after('c_first_name');
            });
        }
        if (Schema::hasColumn('customer', 'abn')) {
            Schema::table('customer', function (Blueprint $table) {
                $table->dropColumn('abn');
            });
        }
        if (!Schema::hasColumn('customer', 'abn')) {
            Schema::table('customer', function (Blueprint $table) {
                $table->string('abn')->nullable()->after('acn');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
