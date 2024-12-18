<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class DriverRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $driverRole = Role::firstOrCreate(['name' => 'System-Driver']);
        $driverRole->givePermissionTo([
            'create-booking',
            'view-booking',
        ]);
    }
}
