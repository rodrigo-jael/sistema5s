<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InspeccionVehicularController extends Controller
{
    public function index (){
        return view ('modulovehicular.inspeccion.index');
    }

    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'luces_faro' => 'required|string',
            'luces_niebla' => 'required|string',
            // Agrega validaciones para el resto de los campos
        ]);

        // Crear la nueva inspección
        Inspeccion::create($request->all());

        // Redirigir a la página de inspecciones con un mensaje de éxito
        return redirect()->route('vehicular.index')->with('success', 'Inspección registrada con éxito.');
    }

    public function create()
    {
        return view('modulovehicular.inspeccion.create'); // Asegúrate de tener la vista correspondiente
    }

}

