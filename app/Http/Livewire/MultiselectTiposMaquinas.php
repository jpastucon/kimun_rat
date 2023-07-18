<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;

class MultiselectTiposMaquinas extends Component
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
        $tipos = DB::table('tipo_maquinas')->select('id', 'name')->get();
        return view('livewire.multiselect-tipos-maquinas', ['tipos' => $this->readyToLoad ? $tipos : $tipos]);
    }
}
