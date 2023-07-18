<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'lastname' => 'Kimun',
            'phone' => '987654321',
            'email' => 'admin@kimunspa.cl',
            'password' => Hash::make('k1munsp4'),
            'rol_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        /*
        \App\Models\User::factory()->create([
            'name' => 'Técnico',
            'lastname' => 'Test',
            'phone' => '987654321',
            'email' => 'tecnico@kimunspa.cl',
            'password' => Hash::make('qwer1234'),
            'rol_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        */
        //USUARIOS PLATAFORMA
        \App\Models\User::factory()->create([
            'name' => 'Alvaro',
            'lastname' => 'Ibarra',
            'phone' => '934298279',
            'email' => 'alvaro.ibarra@madein-eirl.cl',
            'password' => Hash::make('c876RQVf7x'),
            'rol_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Cristian',
            'lastname' => 'Sepulveda',
            'phone' => '987654321',
            'email' => 'cristian.sepulveda@madein-eirl.cl',
            'password' => Hash::make('6opNdnKtA4'),
            'rol_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Rodrigo',
            'lastname' => 'Pizarro',
            'phone' => '987654321',
            'email' => 'rodrigo.pizarro@madein-eirl.cl',
            'password' => Hash::make('q5DzOVWrk3'),
            'rol_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        /*
        \App\Models\User::factory()->create([
            'name' => 'Luis',
            'lastname' => 'Alarcon',
            'phone' => '998244451',
            'email' => 'lalarcon@kimunspa.cl',
            'password' => Hash::make('k1munsp4'),
            'rol_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        */
    }
}
