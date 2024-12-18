<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $array = ['role'];
        $array = ["role","user","owner","driver","vehicle","maintenance","insurance","workshop","fine","booking","tracking","maintenance_type","incompany","workshop_type"];
        Role::create([
            'role_name' => 'Super-Admin',
            'permissions' => json_encode($array),
            'added_by' => 1,
            'is_active' => 1,
            'is_deleted' => 0,
        ]);
        $user= User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123123123'),
            'is_active' => 1,
            'is_deleted' => 0,
        ]);

        $user->assignRole('Super-Admin');

    }
}
