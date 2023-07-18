<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'rut', 'email_empresa', 'razon_social', 'direccion', 'ciudad', 'comuna'
    ];

}
