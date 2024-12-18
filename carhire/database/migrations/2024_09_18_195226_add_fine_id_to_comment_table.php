<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comment', function (Blueprint $table) {
            $table->unsignedBigInteger('fine_id')->nullable()->default(null)->after('booking_id');
            $table->foreign('fine_id')->references('fine_id')->on('fine')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comment', function (Blueprint $table) {
            $table->dropForeign(['fine_id']);
            $table->dropColumn('fine_id');
        });
    }
};