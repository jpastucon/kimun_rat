<?php

namespace Database\Seeders;

use App\Models\Horario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    public function run()
    {
        Horario::factory()->create([
            'hora_ini_traslado' => '09:00', 
            'hora_fin_traslado' => '09:30', 
            'hora_ini_trabajo' => '09:45', 
            'hora_fin_trabajo' => '16:30', 
            'hora_ini_salida' => '16:45',
            'hora_fin_salida' => '17:00'
        ]);
        Horario::factory()->create([
            'hora_ini_traslado' => '09:00', 
            'hora_fin_traslado' => '09:30', 
            'hora_ini_trabajo' => '09:45', 
            'hora_fin_trabajo' => '17:30', 
            'hora_ini_salida' => '17:45',
            'hora_fin_salida' => '18:00'
        ]);
    }
}
