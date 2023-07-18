<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolSeeder::class,
            PermisoSeeder::class,
            UserSeeder::class,
            ClienteSeeder::class,
            EstadoSeeder::class,
            TipoMaquinaSeeder::class,
            MarcaSeeder::class,
            ModeloSeeder::class,
            HorarioSeeder::class,
            RolsPermisosSeeder::class
        ]);
    }
}
