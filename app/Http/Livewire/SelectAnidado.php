<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use App\Models\Modelo;
use App\Models\TipoMaquina;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SelectAnidado extends Component
{

    public $selectTipo = null, $selectMarca = null, $selectModelo = null;

    public $tipos = null, $aux_tipos = null, $marcas = null, $modelos = null;

    public function mount()
    {
        $this->aux_tipos = null;
        $this->tipos = TipoMaquina::all();
        $this->marcas = collect();
        $this->modelos = collect();
    }

    public function render()
    {
        return view('livewire.select-anidado');
    }

    public function updatedselectTipo($tipo_id)
    {
        $this->aux_tipos = $tipo_id;
        $this->marcas = Marca::join('marcas_tipo_maquinas', 'marcas_tipo_maquinas.marca_id', '=', 'marcas.id')
            ->join('tipo_maquinas', 'marcas_tipo_maquinas.tipo_maquina_id', '=', 'tipo_maquinas.id')
            ->select('marcas.id', 'marcas.name')
            ->where('tipo_maquinas.id', $tipo_id)
            ->get();
        $this->selectMarca = null;
    }

    public function updatedselectMarca($marca_id)
    {
        $this->modelos = Modelo::join('marcas', 'marcas.id', '=', 'modelos.marca_id')
            ->join('tipo_maquinas', 'tipo_maquinas.id', '=', 'modelos.tipo_maquina_id')
            ->select('modelos.id', 'modelos.name')
            ->where('tipo_maquinas.id', $this->aux_tipos)
            ->where('marcas.id', $marca_id)
            ->get();
        //dd($this->aux_tipos, $marca_id);
        $this->selectModelo = null;
    }
}
