<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Inspecciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehiculo_id',
        'fecha',
        'placas',
        'kilometraje',
        'luces_delanteras',
        'luces_traseras',
        'intermitentes',
        'direccionales',
        'espejos',
        'limpia_parabrisas',
        'circulacion',
        'licencia',
        'seguro',
        'nivel_aceite',
        'nivel_frenos',
        'nivel_anticongelante',
        'llantas',
        'rines',
        'cables',
        'fugas',
        'sede',
        'chofer',
        'supervisor',
        'nivel_gasolina',
    ];

}

