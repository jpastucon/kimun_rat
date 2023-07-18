<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcasTipoMaquinas extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca_id', 'tipo_maquina_id'
    ];
}
