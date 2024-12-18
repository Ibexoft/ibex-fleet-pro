<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'view-role',
            'create-user',
            'edit-user',
            'delete-user',
            'view-user',
            'create-owner',
            'edit-owner',
            'delete-owner',
            'view-owner',
            'create-driver',
            'edit-driver',
            'delete-driver',
            'view-driver',
            'create-vehicle',
            'edit-vehicle',
            'delete-vehicle',
            'view-vehicle',
            'create-maintenance',
            'edit-maintenance',
            'delete-maintenance',
            'view-maintenance',
            'create-insurance',
            'edit-insurance',
            'delete-insurance',
            'view-insurance',
            'create-workshop',
            'edit-workshop',
            'delete-workshop',
            'view-workshop',
            'create-fine',
            'edit-fine',
            'delete-fine',
            'view-fine',
            'create-booking',
            'edit-booking',
            'delete-booking',
            'view-booking',
            'view-back-date',
            'create-tracking',
            'edit-tracking',
            'delete-tracking',
            'view-tracking',
            'create-maintenance-type',
            'edit-maintenance-type',
            'delete-maintenance-type',
            'view-maintenance-type',
            'create-insurance-company',
            'edit-insurance-company',
            'delete-insurance-company',
            'view-insurance-company',
            'create-workshop-type',
            'edit-workshop-type',
            'delete-workshop-type',
            'view-workshop-type',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'Super-Admin']);
        $role->givePermissionTo(Permission::all());
    }
}
