<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // desactivar restriccion para truncar
        //Client::truncate(); // vaciar tabla
        //DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // reactivar restriccion para truncar
        Client::factory(100)->create();
    }
}
