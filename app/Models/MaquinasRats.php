<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaquinasRats extends Model
{
    use HasFactory;

    protected $fillable = [
        'maquina_id', 'rat_id'
    ];

}
