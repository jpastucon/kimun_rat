<?php

namespace App\Http\Livewire;

use App\Models\Maquina;
use Livewire\Component;
use DB;
use Auth;

class MultiselectMaquinas extends Component
{
    public $readyToLoad = false;

    public $options = [];

    public $selected = [];

    public $trackBy;

    public $label;

    public function __construct($options, $selected = [], $trackBy = 'id', $label = 'name')
    {
        $this->options = $options;
        $this->selected = $selected;
        $this->trackBy = $trackBy;
        $this->label = $label;
    }
    public function loadMultiselect()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $maquinas = DB::table('maquinas')
        ->select('maquinas.id as id', 'maquinas.name as name', 'marcas.name as namemarca','modelos.name as namemodelo')
        ->join('marcas', 'marcas.id', '=', "maquinas.marca_id")
        ->join('modelos', 'modelos.id', '=', "maquinas.modelo_id")
        ->get();
        return view('livewire.multiselect-maquinas', ['maquinas' => $this->readyToLoad ? $maquinas : $maquinas]);
    }
}
