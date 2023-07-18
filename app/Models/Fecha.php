<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    use HasFactory;

    protected $table = 'fechas';

    protected $fillable = ['name'];

    public function rat()
    {
        return $this->belongsToMany(Rat::class, 'fechas_rats')->withTimestamps();
    }
}
