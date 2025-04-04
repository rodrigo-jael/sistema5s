<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumoEnergia extends Model
{
    use HasFactory;

    protected $table = 'consumo_energia'; // Nombre de la tabla

    // Los campos que pueden ser llenados de manera masiva
    protected $fillable = ['fecha', 'mes', 'kwh_consumidos', 'kwh_presupuestado','pdf_recibo','fecha_inicio', 'fecha_fin'];
}
