<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    public function run()
    {
       Rol::factory()->create(['name' => 'Administración', 'description' => 'Administrador del Sistema']);
       Rol::factory()->create(['name' => 'Técnico', 'description' => 'Técnico del Sistema']);
   
    }
}
