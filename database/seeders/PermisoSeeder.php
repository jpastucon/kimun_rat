<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    public function run()
    {
        Permiso::factory()->create([
            'name' => 'Administración Global',
            'description' => 'all-access',
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => true
        ]);
        Permiso::factory()->create([
            'name' => 'Administración módulo RATs',
            'description' => 'Permisos para el módulo RATs',
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => true
        ]);
        Permiso::factory()->create([
            'name' => 'Administración módulo RATs',
            'description' => 'Permisos para el módulo RATs sin eliminación',
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => false
        ]);
    }
}
