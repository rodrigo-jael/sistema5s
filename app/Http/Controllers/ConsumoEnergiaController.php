<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsumoEnergia;

class ConsumoEnergiaController extends Controller
{
    // Función para mostrar el formulario y los registros de consumo
    public function index()
    {
        // Obtener todos los registros de consumo de energía, ordenados por fecha
        $consumos = ConsumoEnergia::orderBy('fecha', 'desc')->get(); // Obtener todos los registros
        return view('consumoenergia.index', compact('consumos')); // Pasar los datos a la vista 'index'
    }

    

   
    
}

