<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Agregar 'cumplio' al array fillable
    protected $fillable = [
        'name',       // Asegúrate de incluir los otros campos que estás utilizando
        'cumplio',    // Aquí agregamos 'cumplio' para permitir la asignación masiva
        // Otros campos si los necesitas...
    ];

    public function evaluations()
{
    return $this->hasMany(Evaluation::class);
}

}
