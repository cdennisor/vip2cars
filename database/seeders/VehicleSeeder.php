<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create([
            'brand'=>'Toyota',
            'model'=>'Corolla',
            'plate'=>'ABC1234',
            'manufacturing_year'=>2025,
            'id_client'=>22,
        ]);

        Vehicle::create([
            'brand'=>'Honda',
            'model'=>'Civic',
            'plate'=>'XYZ5674',
            'manufacturing_year'=>2020,
            'id_client'=>12,
        ]);
        
        Vehicle::create([
            'brand'=>'Ford',
            'model'=>'Focus',
            'plate'=>'LMN4562',
            'manufacturing_year'=>2019,
            'id_client'=>45,
        ]);
        
        Vehicle::create([
            'brand'=>'Chevrolet',
            'model'=>'Onix',
            'plate'=>'JKL1454',
            'manufacturing_year'=>2022,
            'id_client'=>2,
        ]);
        
        Vehicle::create([
            'brand'=>'Nissan',
            'model'=>'Sentra',
            'plate'=>'TYU1458',
            'manufacturing_year'=>2018,
            'id_client'=>50,
        ]);
        
        Vehicle::create([
            'brand'=>'Hyundai',
            'model'=>'Elantra',
            'plate'=>'ERF1254',
            'manufacturing_year'=>2017,
            'id_client'=>1,
        ]);        
    }
}
