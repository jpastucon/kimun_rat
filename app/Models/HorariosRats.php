<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorariosRats extends Model
{
    use HasFactory;

    protected $fillable = [
        'horario_id', 'rat_id'
    ];
}
