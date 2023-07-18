<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function modelo()
    {
        return $this->belongsToMany(Modelo::class, 'modelos_marcas')->withTimestamps();
    }

    public function tipo_maquina()
    {
        return $this->belongsToMany(TipoMaquina::class, 'marcas_tipo_maquinas')->withTimestamps();
    }
}
