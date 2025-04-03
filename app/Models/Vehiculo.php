<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Vehiculo extends Model
{
    protected $fillable = ['nombre', 'placa', 'combustible'];
}
