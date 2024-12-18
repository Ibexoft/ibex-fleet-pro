<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $brands = ['Toyota', 'Ford', 'Holden', 'Honda', 'Hyundai', 'Volkswagen', 'Mazda', 'Nissan', 'Subaru', 'BMW', 'Mercedes-Benz', 'Audi', 'Kia', 'Mitsubishi', 'Volvo', 'Lexus', 'Jaguar', 'Land Rover', 'Porsche', 'Tesla'];

        
        foreach ($brands as $brand) {
            DB::table('brands')->insert(['name' => $brand]);
        }
    }
}

