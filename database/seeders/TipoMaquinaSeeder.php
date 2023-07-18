<?php

namespace Database\Seeders;

use App\Models\TipoMaquina;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoMaquinaSeeder extends Seeder
{
    public function run()
    {
        TipoMaquina::factory()->create(['name' => 'Mesa de Corte']);//1
        TipoMaquina::factory()->create(['name' => 'Rana CNC']);//2
        TipoMaquina::factory()->create(['name' => 'Plasma Manual']);//3
        TipoMaquina::factory()->create(['name' => 'Plasma Mecanizado']);//4
        TipoMaquina::factory()->create(['name' => 'Laser']);//5
        TipoMaquina::factory()->create(['name' => 'Plegadora']);//6
        TipoMaquina::factory()->create(['name' => 'Guillotina']);//7
        TipoMaquina::factory()->create(['name' => 'Cilindradora']);//8
        TipoMaquina::factory()->create(['name' => 'Chorro por Agua']);//9
        TipoMaquina::factory()->create(['name' => 'Otro']);//10
    }
}
