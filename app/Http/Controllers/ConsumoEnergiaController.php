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

    // Función para almacenar nuevos registros de consumo
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'fecha' => 'required|date',
            'mes' => 'required|string',
            'kwh_consumidos' => 'required|numeric',
            'kwh_presupuestado' => 'required|numeric',
        ]);

        // Crear un nuevo registro en la base de datos
        ConsumoEnergia::create($request->all());

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->route('consumoenergia.index')->with('success', 'Registro guardado exitosamente.');
    }

    // Función para mostrar los reportes (registros) de consumo
    public function reportes()
    {
        // Obtener todos los registros de consumo de energía, ordenados por fecha
        $consumos = ConsumoEnergia::orderBy('fecha', 'desc')->get(); // Obtener todos los registros
        return view('consumoenergia.reportes', compact('consumos')); // Pasar los datos a la vista 'reportes'
    }
   
    
}

