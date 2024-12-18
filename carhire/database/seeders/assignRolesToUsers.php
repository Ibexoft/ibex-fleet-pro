<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;

class assignRolesToUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = DB::table('users')->get();

        foreach ($users as $user) {
            $oldRoleName = DB::table('role')->where('role_id', $user->role_id)->first()->role_name;
            if ($oldRoleName) {
                $newRole = Role::findByName($oldRoleName);
                $userModel = User::find($user->id);
                if ($userModel && $newRole) {
                    $userModel->assignRole($newRole);
                }
            }
        }
    }
}
