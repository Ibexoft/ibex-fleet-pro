<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ModifyCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $databaseName = env('DB_DATABASE');
        $foreignKeys = DB::select(DB::raw("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'comment' AND COLUMN_NAME = 'vehicle_id' AND TABLE_SCHEMA = '$databaseName'"));

        foreach ($foreignKeys as $foreignKey) {
            $foreignKeyName = $foreignKey->CONSTRAINT_NAME;
            Schema::table('comment', function ($table) use ($foreignKeyName) {
                $table->dropForeign($foreignKeyName);
            });
        }

        Schema::table('comment', function (Blueprint $table) {
            if (Schema::hasColumn('comment', 'vehicle_id')) {
                $table->dropColumn('vehicle_id');
            }
            if (!Schema::hasColumn('comment', 'booking_id')) {
                $table->bigInteger('booking_id')->unsigned()->after('comment_id');
                $table->foreign('booking_id')->references('booking_id')->on('booking');
            }
            if (!Schema::hasColumn('comment', 'user_id')) {
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $databaseName = env('DB_DATABASE');
        $foreignKeys = DB::select(DB::raw("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'comment' AND (COLUMN_NAME = 'booking_id' OR COLUMN_NAME = 'user_id') AND TABLE_SCHEMA = '$databaseName'"));
        
        foreach ($foreignKeys as $foreignKey) {
            $foreignKeyName = $foreignKey->CONSTRAINT_NAME;
            Schema::table('comment', function ($table) use ($foreignKeyName) {
                $table->dropForeign($foreignKeyName);
            });
        }
    

        Schema::table('comment', function (Blueprint $table) {

            if (Schema::hasColumn('comment', 'booking_id')) {
                $table->dropColumn('booking_id');
            }

            if (Schema::hasColumn('comment', 'user_id')) {
                $table->dropColumn('user_id');
            }

            if (!Schema::hasColumn('comment', 'vehicle_id')) {
                $table->bigInteger('vehicle_id')->unsigned()->after('comment_id');
                $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle');
            }
        });
    }
}