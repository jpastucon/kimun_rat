<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'hora_ini_traslado', 'hora_fin_traslado', 'hora_ini_trabajo',
        'hora_fin_trabajo', 'hora_ini_salida', 'hora_fin_salida', 
        'tiempoTraslado', 'tiempoTrabajo', 'tiempoSalida'
    ];

    public function rat()
    {
        return $this->belongsToMany(Rat::class, 'horarios_rats')->withTimestamps();
    }

    public function tiempoTraslado()
    {
        $tiempo1 = date_create($this->hora_ini_traslado);
        $tiempo2 = date_create($this->hora_fin_traslado);
        $diferencia = date_diff($tiempo1, $tiempo2)->format('%H:%I');
        return $diferencia;
    }
    public function tiempoTrabajo()
    {
        $tiempo1 = date_create($this->hora_ini_trabajo);
        $tiempo2 = date_create($this->hora_fin_trabajo);
        $diferencia = date_diff($tiempo1, $tiempo2)->format('%H:%I');
        return $diferencia;
    }
    public function tiempoSalida()
    {
        $tiempo1 = date_create($this->hora_ini_salida);
        $tiempo2 = date_create($this->hora_fin_salida);
        $diferencia = date_diff($tiempo1, $tiempo2)->format('%H:%I');
        return $diferencia;
    }
}
