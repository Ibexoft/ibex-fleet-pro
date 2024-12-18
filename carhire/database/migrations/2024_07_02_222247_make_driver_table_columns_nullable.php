<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MakeDriverTableColumnsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('driver', function (Blueprint $table) {
            // Using raw SQL to make columns nullable
            DB::statement('ALTER TABLE driver MODIFY last_name VARCHAR(255) NULL');
            DB::statement('ALTER TABLE driver MODIFY contact VARCHAR(255) NULL');
            DB::statement('ALTER TABLE driver MODIFY driver_license_no VARCHAR(255) NULL');
            DB::statement('ALTER TABLE driver MODIFY license_expiry_date DATE NULL');
            DB::statement('ALTER TABLE driver MODIFY dob DATE NULL');
            DB::statement('ALTER TABLE driver MODIFY street VARCHAR(255) NULL');
            DB::statement('ALTER TABLE driver MODIFY suburb VARCHAR(255) NULL');
            DB::statement('ALTER TABLE driver MODIFY state VARCHAR(255) NULL');
            DB::statement('ALTER TABLE driver MODIFY country BIGINT(20) UNSIGNED NULL');
            DB::statement('ALTER TABLE driver MODIFY ezi_debt VARCHAR(255) NULL');
            DB::statement('ALTER TABLE driver MODIFY postal_code VARCHAR(255) NULL');
            DB::statement('ALTER TABLE driver MODIFY driver_image VARCHAR(255) NULL');
            DB::statement('ALTER TABLE driver MODIFY license_back_image VARCHAR(255) NULL');
            DB::statement('ALTER TABLE driver MODIFY license_front_image VARCHAR(255) NULL');
            DB::statement('ALTER TABLE driver MODIFY added_by BIGINT(20) NULL');
            DB::statement('ALTER TABLE driver MODIFY p_m_value VARCHAR(255) NULL');
            DB::statement('ALTER TABLE driver MODIFY p_m_image VARCHAR(255) NULL');

            // Adding user_id column separately
            DB::statement('ALTER TABLE driver ADD user_id BIGINT(20) UNSIGNED NULL');
        });

        // Add the foreign key constraint in a separate Schema operation
        Schema::table('driver', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('driver', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // Reverse the raw SQL changes
            DB::statement('ALTER TABLE driver MODIFY last_name VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY contact VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY driver_license_no VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY license_expiry_date DATE NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY dob DATE NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY street VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY suburb VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY state VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY country BIGINT(20) UNSIGNED NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY ezi_debt VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY postal_code VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY driver_image VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY license_back_image VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY license_front_image VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY added_by BIGINT(20) NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY p_m_value VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE driver MODIFY p_m_image VARCHAR(255) NOT NULL');
        });
    }
}
