<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelosTipoMaquinas extends Model
{
    use HasFactory;

    protected $fillable = [
        'modelo_id', 'tipo_maquina_id'
    ];
}
