<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Inspecciones;


class Vehiculo extends Model
{
    protected $fillable = ['nombre', 'placa', 'combustible'];

    public function inspecciones()
{
    return $this->hasMany(Inspecciones::class);
}

}


