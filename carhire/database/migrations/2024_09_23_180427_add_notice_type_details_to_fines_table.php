<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoticeTypeDetailsToFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fine', function (Blueprint $table) {
            $table->json('notice_type_details')->nullable()->after('notice_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fine', function (Blueprint $table) {
            $table->dropColumn('notice_type_details');
        });
    }
}
