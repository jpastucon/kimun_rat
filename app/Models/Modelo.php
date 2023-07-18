<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'marca_id', 'tipo_maquina_id'
    ];

    public function marca()
    {
        return $this->belongsToMany(Marca::class, 'modelos_marcas')->withTimestamps();
    }

    public function tipo_maquina()
    {
        return $this->belongsToMany(TipoMaquina::class, 'modelos_tipo_maquinas')->withTimestamps();
    }
}
