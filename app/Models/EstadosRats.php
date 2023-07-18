<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosRats extends Model
{
    use HasFactory;

    protected $fillable = [
        'estado_id', 'rat_id'
    ];

}
