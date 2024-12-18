<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ModifyVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // check if the column exists
        if (Schema::hasColumn('vehicle', 'vehicle_name')) {
            Schema::table('vehicle', function ($table) {
                // Check if the new column already exists to avoid duplicate column errors
                if (!Schema::hasColumn('vehicle', 'fuel_type')) {
                    $table->string('fuel_type')->after('vehicle_name'); // Adjust according to the actual data type
                }
            });

            // Copy data from 'vehicle_name' to 'fuel_type'
            DB::table('vehicle')->get()->each(function ($vehicle) {
                DB::table('vehicle')->where('vehicle_id', $vehicle->vehicle_id)->update([
                    'fuel_type' => $vehicle->vehicle_name,
                ]);
            });

            // Now drop the old 'vehicle_name' column if it's no longer needed
            Schema::table('vehicle', function ($table) {
                $table->dropColumn('vehicle_name');
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
