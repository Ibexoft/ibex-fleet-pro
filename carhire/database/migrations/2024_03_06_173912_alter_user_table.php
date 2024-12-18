<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        // Assuming 'users' is your table name
        $tableName = 'users';
        $columnName = 'role_id';

        if (Schema::hasColumn($tableName, $columnName)) {
            $databaseName = env('DB_DATABASE');
            $foreignKeys = DB::select(DB::raw("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = '$tableName' AND COLUMN_NAME = '$columnName' AND TABLE_SCHEMA = '$databaseName'"));
            Schema::table($tableName, function ($table) use ($foreignKeys, $columnName) {
                foreach ($foreignKeys as $foreignKey) {
                    $foreignKeyName = $foreignKey->CONSTRAINT_NAME;
                    $table->dropForeign($foreignKeyName);

                 }
                $table->dropColumn($columnName);
            });
        }

        Schema::enableForeignKeyConstraints();
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
