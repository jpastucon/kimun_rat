<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RolsPermisos;
class RolsPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolsPermisos::factory()->create(['rol_id' => 1, 'permiso_id' => 1]);
        RolsPermisos::factory()->create(['rol_id' => 1, 'permiso_id' => 2]);
        RolsPermisos::factory()->create(['rol_id' => 2, 'permiso_id' => 3]);
    }
}
