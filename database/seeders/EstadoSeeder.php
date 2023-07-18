<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    public function run()
    {
        Estado::factory()->create(['name' => 'Nuevo']);
        Estado::factory()->create(['name' => 'Firmado y validado']);
        Estado::factory()->create(['name' => 'Enviado correo / Resuelto']);
        Estado::factory()->create(['name' => 'Archivado']);
    }
}
