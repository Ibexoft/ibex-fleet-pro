<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ModifyMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $databaseName = env('DB_DATABASE');
        $foreignKeys = DB::select(DB::raw("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'maintenance' AND COLUMN_NAME = 'workshop_id' AND TABLE_SCHEMA = '$databaseName'"));

        foreach ($foreignKeys as $foreignKey) {
            $foreignKeyName = $foreignKey->CONSTRAINT_NAME;
            Schema::table('maintenance', function ($table) use ($foreignKeyName) {
                $table->dropForeign($foreignKeyName);
            });
        }
        if (Schema::hasColumn('maintenance', 'workshop_id')) {
            Schema::table('maintenance', function ($table) {
                $table->dropColumn('workshop_id');
            });
        }
        if (Schema::hasColumn('maintenance', 'maintenance_type')) {
            Schema::table('maintenance', function ($table) {
                $table->dropColumn('maintenance_type');
            });
        }
        if (Schema::hasColumn('maintenance', 'description')) {
            Schema::table('maintenance', function ($table) {
                $table->dropColumn('description');
            });
        }
        if (Schema::hasColumn('maintenance', 'return_date')) {
            Schema::table('maintenance', function ($table) {
                $table->dropColumn('return_date');
            });
        }
        if (Schema::hasColumn('maintenance', 'actual_return_date')) {
            Schema::table('maintenance', function ($table) {
                $table->dropColumn('actual_return_date');
            });
        }
        if (Schema::hasColumn('maintenance', 'reference')) {
            Schema::table('maintenance', function ($table) {
                $table->dropColumn('reference');
            });
        }
        if (Schema::hasColumn('maintenance', 'paid_by')) {
            Schema::table('maintenance', function ($table) {
                $table->dropColumn('paid_by');
            });
        }
        if (Schema::hasColumn('maintenance', 'maintenance_id')) {
            Schema::table('maintenance', function ($table) {
                $table->dropColumn('maintenance_id');
            });
        }
        if (Schema::hasColumn('maintenance', 'deleted_at')) {
            Schema::table('maintenance', function ($table) {
                $table->dropColumn('deleted_at');
            });
        }
        if (Schema::hasColumn('maintenance', 'bill_amount')) {
            Schema::table('maintenance', function ($table) {
                $table->dropColumn('bill_amount');
            });
        }
        if (Schema::hasColumn('maintenance', 'is_deleted')) {
            Schema::table('maintenance', function ($table) {
                $table->dropColumn('is_deleted');
            });
        }

        if (Schema::hasColumn('maintenance', 'odo_meter')) {
            Schema::table('maintenance', function ($table) {
                $table->dropColumn('odo_meter');
            });
        }



        if (!Schema::hasColumn('maintenance', 'id')) {
            Schema::table('maintenance', function ($table) {
                $table->id()->first();
            });
        }
        if (!Schema::hasColumn('maintenance', 'odo_meter')) {
            Schema::table('maintenance', function ($table) {
                $table->integer('odo_meter')->nullable()->after('vehicle_reg_id');
            });
        }
        if (!Schema::hasColumn('maintenance', 'next_service')) {
            Schema::table('maintenance', function ($table) {
                $table->integer('next_service')->nullable()->after('odo_meter');
            });
        }
        if (!Schema::hasColumn('maintenance', 'driver_id')) {
            Schema::table('maintenance', function ($table) {
                $table->foreignId('driver_id')->constrained('driver', 'driver_id')->after('vehicle_reg_id');
            });
        }
        if (!Schema::hasColumn('maintenance', 'start_time')) {
            Schema::table('maintenance', function ($table) {
                $table->timestamp('start_time')->nullable()->after('maintenance_date');
            });
        }
        if (!Schema::hasColumn('maintenance', 'end_time')) {
            Schema::table('maintenance', function ($table) {
                $table->timestamp('end_time')->nullable()->after('start_time');
            });
        }
        if (!Schema::hasColumn('maintenance', 'paid_by')) {
            Schema::table('maintenance', function ($table) {
                $table->foreignId('paid_by')->constrained('customer', 'customer_id')->after('comments');
            });
        }

        if (!Schema::hasColumn('maintenance', 'deleted_at')) {
            Schema::table('maintenance', function ($table) {
                $table->softDeletes();
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
