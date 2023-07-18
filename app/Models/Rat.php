<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rat extends Model
{
    use HasFactory;

    protected $fillable = [
        'contacto_id', 'user_id', 'name',
        'tipo_rat', 'sintoma', 'desarrollo',
        'observaciones', 'pendientes'
    ];


    public function maquina()
    {
        return $this->belongsToMany(Maquina::class, 'maquinas_rats')->withTimestamps();
    }

    public function estado()
    {
        return $this->belongsToMany(Estado::class, 'estados_rats')->withTimestamps();
    }


    public function fecha()
    {
        return $this->belongsToMany(Fecha::class, 'fechas_rats')->withTimestamps();
    }

    public function horario()
    {
        return $this->belongsToMany(Horario::class, 'horarios_rats')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'users_rats')->withTimestamps();
    }
}
