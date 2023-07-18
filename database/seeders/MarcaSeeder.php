<?php

namespace Database\Seeders;

use App\Models\Marca;
use App\Models\MarcasTipoMaquinas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    public function run()
    {
        Marca::factory()->create(['name' => 'Prorac']);//1
        Marca::factory()->create(['name' => 'Hugong']);//2
        Marca::factory()->create(['name' => 'Huawei']);//3
        Marca::factory()->create(['name' => 'Messer']);//4
        Marca::factory()->create(['name' => 'ESAB']);//5
        Marca::factory()->create(['name' => 'SAF']);//6
        Marca::factory()->create(['name' => 'Koike']);//7
        Marca::factory()->create(['name' => 'Hypertherm']);//8
        Marca::factory()->create(['name' => 'Prima Power']);//9
        Marca::factory()->create(['name' => 'Gweike']);//10
        Marca::factory()->create(['name' => 'Durma']);//11
        Marca::factory()->create(['name' => 'Akyapak']);//12
        Marca::factory()->create(['name' => 'Flow']);//13
        Marca::factory()->create(['name' => 'Otro']);//14

        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 1, 'marca_id' => 1]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 1, 'marca_id' => 2]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 1, 'marca_id' => 3]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 1, 'marca_id' => 4]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 1, 'marca_id' => 5]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 1, 'marca_id' => 6]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 1, 'marca_id' => 7]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 1, 'marca_id' => 14]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 2, 'marca_id' => 2]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 2, 'marca_id' => 3]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 2, 'marca_id' => 14]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 3, 'marca_id' => 8]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 3, 'marca_id' => 14]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 4, 'marca_id' => 8]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 4, 'marca_id' => 14]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 5, 'marca_id' => 9]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 5, 'marca_id' => 2]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 5, 'marca_id' => 10]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 5, 'marca_id' => 14]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 6, 'marca_id' => 11]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 6, 'marca_id' => 12]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 6, 'marca_id' => 14]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 7, 'marca_id' => 11]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 7, 'marca_id' => 12]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 7, 'marca_id' => 14]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 8, 'marca_id' => 11]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 8, 'marca_id' => 12]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 8, 'marca_id' => 14]);
        MarcasTipoMaquinas::factory()->create(['tipo_maquina_id' => 9, 'marca_id' => 13]);
    }
}
