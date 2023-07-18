<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use App\Models\TipoMaquina;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SelectAnidadoTipoMarca extends Component
{

    public $selectTipo = null, $selectMarca = null;

    public $tipos = null, $aux_tipos = null, $marcas = null;

    public function mount()
    {
        $this->aux_tipos = null;
        $this->tipos = TipoMaquina::all();
        $this->marcas = collect();
    }

    public function render()
    {
        return view('livewire.select-anidado-tipo-marca');
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
}
