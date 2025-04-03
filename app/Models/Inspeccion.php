<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspeccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'luces_faro',
        'luces_niebla',
        // Agrega el resto de los campos aquí
    ];
}
