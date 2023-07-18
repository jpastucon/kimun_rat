<?php

namespace Database\Seeders;

use App\Models\Modelo;
use App\Models\ModelosMarcas;
use App\Models\ModelosTipoMaquinas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModeloSeeder extends Seeder
{
    public function run()
    {

        Modelo::factory()->create(['marca_id' => 1, 'tipo_maquina_id' => 1, 'name' => 'Master 20']);//1
        Modelo::factory()->create(['marca_id' => 1, 'tipo_maquina_id' => 1, 'name' => 'Master 25']);//2
        Modelo::factory()->create(['marca_id' => 1, 'tipo_maquina_id' => 1, 'name' => 'Master 30']);//3
        Modelo::factory()->create(['marca_id' => 1, 'tipo_maquina_id' => 1, 'name' => 'Master 35']);//4
        Modelo::factory()->create(['marca_id' => 1, 'tipo_maquina_id' => 1, 'name' => 'Master 40']);//5
        Modelo::factory()->create(['marca_id' => 1, 'tipo_maquina_id' => 1, 'name' => 'Master 45']);//6
        Modelo::factory()->create(['marca_id' => 1, 'tipo_maquina_id' => 1, 'name' => 'Master 60']);//7
        Modelo::factory()->create(['marca_id' => 1, 'tipo_maquina_id' => 1, 'name' => 'Master 65']);//8
        Modelo::factory()->create(['marca_id' => 2, 'tipo_maquina_id' => 1, 'name' => 'Econocut 3500']);//9
        Modelo::factory()->create(['marca_id' => 2, 'tipo_maquina_id' => 2,'name' => 'Caricut 3']);//10
        Modelo::factory()->create(['marca_id' => 2, 'tipo_maquina_id' => 2,'name' => 'Caricut 5']);//11
        Modelo::factory()->create(['marca_id' => 3, 'tipo_maquina_id' => 1,'name' => 'HNC 3000 G']);//12
        Modelo::factory()->create(['marca_id' => 3, 'tipo_maquina_id' => 1,'name' => 'CNC 4000 H']);//13
        Modelo::factory()->create(['marca_id' => 3, 'tipo_maquina_id' => 1,'name' => 'TNC 3015']);//14
        Modelo::factory()->create(['marca_id' => 3, 'tipo_maquina_id' => 2,'name' => 'HNC 1500 W']);//15
        Modelo::factory()->create(['marca_id' => 3, 'tipo_maquina_id' => 2,'name' => 'HNC 1800 W']);//16
        Modelo::factory()->create(['marca_id' => 4, 'tipo_maquina_id' => 1,'name' => 'DP 5000']);//17
        Modelo::factory()->create(['marca_id' => 5, 'tipo_maquina_id' => 1,'name' => 'E-Vent ']);//18
        Modelo::factory()->create(['marca_id' => 6, 'tipo_maquina_id' => 1,'name' => 'Oxitome']);//19
        Modelo::factory()->create(['marca_id' => 7, 'tipo_maquina_id' => 1,'name' => 'Mastergraph']);//20
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 3, 'name' => 'PMX 30']);//21
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 3, 'name' => 'PMX 45']);//22
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 3, 'name' => 'PMX 65']);//23
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 3, 'name' => 'PMX 85']);//24
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 3, 'name' => 'PMX 105']);//25
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 3, 'name' => 'PMX 125']);//26
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 3, 'name' => 'PMX 1000']);//27
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 3, 'name' => 'PMX 1250']);//28
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 3, 'name' => 'PMX 1650']);//29
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 4, 'name' => 'HPR 130']);//30
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 4, 'name' => 'HPR 260']);//31
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 4, 'name' => 'HPR 130 XD']);//32
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 4, 'name' => 'HPR 260 XD']);//33
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 4, 'name' => 'HPR 400 XD']);//34
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 4, 'name' => 'Max Pro 200']);//35
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 4, 'name' => 'XPR 170']);//36
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 4, 'name' => 'XPR 300']);//37
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 4, 'name' => 'HT 2000']);//38
        Modelo::factory()->create(['marca_id' => 8,'tipo_maquina_id' => 4, 'name' => 'HSD 130']);//39
        Modelo::factory()->create(['marca_id' => 9,'tipo_maquina_id' => 5, 'name' => 'Platino Fiber']);//40

        ModelosMarcas::factory()->create(['modelo_id' => 1, 'marca_id' => 1]);
        ModelosMarcas::factory()->create(['modelo_id' => 2, 'marca_id' => 1]);
        ModelosMarcas::factory()->create(['modelo_id' => 3, 'marca_id' => 1]);
        ModelosMarcas::factory()->create(['modelo_id' => 4, 'marca_id' => 1]);
        ModelosMarcas::factory()->create(['modelo_id' => 5, 'marca_id' => 1]);
        ModelosMarcas::factory()->create(['modelo_id' => 6, 'marca_id' => 1]);
        ModelosMarcas::factory()->create(['modelo_id' => 7, 'marca_id' => 1]);
        ModelosMarcas::factory()->create(['modelo_id' => 8, 'marca_id' => 1]);
        ModelosMarcas::factory()->create(['modelo_id' => 9, 'marca_id' => 2]);
        ModelosMarcas::factory()->create(['modelo_id' => 10, 'marca_id' => 2]);
        ModelosMarcas::factory()->create(['modelo_id' => 11, 'marca_id' => 2]);
        ModelosMarcas::factory()->create(['modelo_id' => 12, 'marca_id' => 3]);
        ModelosMarcas::factory()->create(['modelo_id' => 13, 'marca_id' => 3]);
        ModelosMarcas::factory()->create(['modelo_id' => 14, 'marca_id' => 3]);
        ModelosMarcas::factory()->create(['modelo_id' => 15, 'marca_id' => 3]);
        ModelosMarcas::factory()->create(['modelo_id' => 16, 'marca_id' => 3]);
        ModelosMarcas::factory()->create(['modelo_id' => 17, 'marca_id' => 4]);
        ModelosMarcas::factory()->create(['modelo_id' => 18, 'marca_id' => 5]);
        ModelosMarcas::factory()->create(['modelo_id' => 19, 'marca_id' => 6]);
        ModelosMarcas::factory()->create(['modelo_id' => 20, 'marca_id' => 7]);
        ModelosMarcas::factory()->create(['modelo_id' => 21, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 22, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 23, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 24, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 25, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 26, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 27, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 28, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 29, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 30, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 31, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 32, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 33, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 34, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 35, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 36, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 37, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 38, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 39, 'marca_id' => 8]);
        ModelosMarcas::factory()->create(['modelo_id' => 40, 'marca_id' => 9]);

        ModelosTipoMaquinas::factory()->create(['modelo_id' => 1, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 2, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 3, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 4, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 5, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 6, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 7, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 8, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 9, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 10, 'tipo_maquina_id' => 2]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 11, 'tipo_maquina_id' => 2]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 12, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 13, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 14, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 15, 'tipo_maquina_id' => 2]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 16, 'tipo_maquina_id' => 2]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 17, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 18, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 19, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 20, 'tipo_maquina_id' => 1]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 21, 'tipo_maquina_id' => 3]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 22, 'tipo_maquina_id' => 3]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 23, 'tipo_maquina_id' => 3]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 24, 'tipo_maquina_id' => 3]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 25, 'tipo_maquina_id' => 3]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 26, 'tipo_maquina_id' => 3]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 27, 'tipo_maquina_id' => 3]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 28, 'tipo_maquina_id' => 3]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 29, 'tipo_maquina_id' => 3]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 30,'tipo_maquina_id' => 4]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 31, 'tipo_maquina_id' => 4]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 32, 'tipo_maquina_id' => 4]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 33, 'tipo_maquina_id' => 4]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 34,'tipo_maquina_id' => 4]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 35,'tipo_maquina_id' => 4]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 36,'tipo_maquina_id' => 4]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 37, 'tipo_maquina_id' => 4]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 38, 'tipo_maquina_id' => 4]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 39,'tipo_maquina_id' => 4]);
        ModelosTipoMaquinas::factory()->create(['modelo_id' => 40, 'tipo_maquina_id' => 5]);

    }
}
