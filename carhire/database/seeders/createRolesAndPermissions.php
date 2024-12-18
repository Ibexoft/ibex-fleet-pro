<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class createRolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissionMappings = [
            'role' => ['create-role', 'edit-role', 'delete-role', 'view-role'],
            'user' => ['create-user', 'edit-user', 'delete-user', 'view-user'],
            'owner' => ['create-owner', 'edit-owner', 'delete-owner', 'view-owner'],
            'driver' => ['create-driver', 'edit-driver', 'delete-driver', 'view-driver'],
            'vehicle' => ['create-vehicle', 'edit-vehicle', 'delete-vehicle', 'view-vehicle'],
            'maintenance' => ['create-maintenance', 'edit-maintenance', 'delete-maintenance', 'view-maintenance'],
            'insurance' => ['create-insurance', 'edit-insurance', 'delete-insurance', 'view-insurance'],
            'workshop' => ['create-workshop', 'edit-workshop', 'delete-workshop', 'view-workshop'],
            'fine' => ['create-fine', 'edit-fine', 'delete-fine', 'view-fine'],
            'booking' => ['create-booking', 'edit-booking', 'delete-booking', 'view-booking'],
            'tracking' => ['create-tracking', 'edit-tracking', 'delete-tracking', 'view-tracking'],
            'maintenance_type' => ['create-maintenance-type', 'edit-maintenance-type', 'delete-maintenance-type', 'view-maintenance-type'],
            'incompany' => ['create-insurance-company', 'edit-insurance-company', 'delete-insurance-company', 'view-insurance-company'],
            'workshop_type' => ['create-workshop-type', 'edit-workshop-type', 'delete-workshop-type', 'view-workshop-type'],
        ];

        $oldRoles = DB::table('role')->get();

        foreach ($oldRoles as $oldRole) {
            $newRole = Role::findOrCreate($oldRole->role_name);
            $oldPermissions = json_decode($oldRole->permissions, true);

            foreach ($oldPermissions as $oldPermission) {
                if (array_key_exists($oldPermission, $permissionMappings)) {
                    foreach ($permissionMappings[$oldPermission] as $newPerm) {
                        $permission = Permission::findOrCreate($newPerm);
                        $newRole->givePermissionTo($permission);
                    }
                }
            }
        }
    }
}
