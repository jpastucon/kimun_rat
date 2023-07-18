<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'nro_serie', 'marca_id', 'modelo_id', 'tipo_maquinas_id'
    ];


    public function rat()
    {
        return $this->belongsToMany(Rat::class, 'maquinas_rats')->withTimestamps();
    }

}
