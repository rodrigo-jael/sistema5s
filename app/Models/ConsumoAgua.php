<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumoAgua extends Model
{
    use HasFactory;

    protected $table = 'consumo_agua';

    protected $fillable = [
        'fecha',
        'semana',
        'litros_consumidos',
        'litros_maximos'
    ];
}
