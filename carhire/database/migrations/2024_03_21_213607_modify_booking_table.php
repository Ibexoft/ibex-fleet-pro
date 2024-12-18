<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('booking', 'documents')) {
            Schema::table('booking', function (Blueprint $table) {
                $table->dropColumn('documents');
            });
        }

        Schema::table('booking', function (Blueprint $table) {
            if (!Schema::hasColumn('booking', 'contract_image')) {
                $table->string('contract_image')->nullable()->after('comments');
            }
            if (!Schema::hasColumn('booking', 'ezidebit_image')) {
                $table->string('ezidebit_image')->nullable()->after('contract_image');
            }
            if (!Schema::hasColumn('booking', 'insurance_declaration_image')) {
                $table->string('insurance_declaration_image')->nullable()->after('ezidebit_image');
            }
            if (!Schema::hasColumn('booking', 'handover_checklist_image')) {
                $table->string('handover_checklist_image')->nullable()->after('insurance_declaration_image');
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
        //
    }
}
