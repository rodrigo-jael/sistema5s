<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumoLuz extends Model
{
    use HasFactory;

    protected $table = 'consumo_luz'; // Nombre de la tabla en la base de datos

    protected $fillable = ['fecha', 'mes', 'kwh_consumidos', 'kwh_presupuestado'];
}