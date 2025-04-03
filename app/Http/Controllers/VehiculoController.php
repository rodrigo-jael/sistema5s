<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;


class VehiculoController extends Controller
{
    public function index()
{
    return view('modulovehicular.index');
}



public function create()
{
    return view('modulovehicular.create');
}

public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'placa' => 'required|string|max:20|unique:vehiculos,placa',
        'combustible' => 'required|string'
    ]);

    // Guardar el vehículo en la base de datos
    Vehiculo::create([
        'nombre' => $request->nombre,
        'placa' => $request->placa,
        'combustible' => $request->combustible
    ]);

    // Redirigir con mensaje de éxito
    return redirect()->route('vehiculos.create')->with('success', 'Vehículo agregado correctamente.');
}

}
