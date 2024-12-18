<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateBookingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Update the 'status' column to 'Completed' for rows where 'actual_return_date' is not null
        DB::table('booking')->whereNotNull('actual_return_date')->update(['status' => 'Completed']);

        // Update the 'status' column from 'Pending' to 'Booked' for existing data
        DB::table('booking')->whereNull('actual_return_date')->update(['status' => 'Booked']);
    }
}
