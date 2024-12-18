<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MakeFirstNameNullableInDriverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Run raw SQL to alter the column
        DB::statement('ALTER TABLE driver MODIFY first_name VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Run raw SQL to revert the column to NOT NULL
        DB::statement('ALTER TABLE driver MODIFY first_name VARCHAR(255) NOT NULL');
    }
}
