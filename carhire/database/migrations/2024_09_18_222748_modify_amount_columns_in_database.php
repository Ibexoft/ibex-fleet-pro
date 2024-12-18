<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyAmountColumnsInDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modify 'amount' and 'bond_amount' columns in 'booking'
        DB::statement('ALTER TABLE booking MODIFY amount DECIMAL(10, 2);');
        DB::statement('ALTER TABLE booking MODIFY bond_amount DECIMAL(10, 2);');

        // Modify 'rrp' column in 'maintenance_type_items'
        DB::statement('ALTER TABLE maintenance_type_items MODIFY rrp DECIMAL(10, 2);');

        // Modify 'invoice' column in 'maintenance_workshop_details'
        DB::statement('ALTER TABLE maintenance_workshop_details MODIFY invoice DECIMAL(10, 2);');

        // Modify 'rrp' column in 'maintenance_workshop_items'
        DB::statement('ALTER TABLE maintenance_workshop_items MODIFY rrp DECIMAL(10, 2);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Rollback changes
        DB::statement('ALTER TABLE booking MODIFY amount DECIMAL(8, 2);');
        DB::statement('ALTER TABLE booking MODIFY bond_amount DOUBLE(8, 2);');

        DB::statement('ALTER TABLE maintenance_type_items MODIFY rrp DOUBLE(8, 2);');

        DB::statement('ALTER TABLE maintenance_workshop_details MODIFY invoice DOUBLE(8, 2);');

        DB::statement('ALTER TABLE maintenance_workshop_items MODIFY rrp DOUBLE(8, 2);');
    }
}
