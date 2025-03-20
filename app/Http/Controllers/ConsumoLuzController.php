<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsumoLuz; 

class ConsumoLuzController extends Controller
{          
    public function index()
    {
        $consumo = ConsumoLuz::latest()->first();
    
        if (!$consumo) {
            return view('consumo_luz.index', ['consumo' => null]); // Enviar como `null`
        }
    
        return view('consumo_luz.index', compact('consumo'));
    }
    
    

    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'fecha' => 'required|date',
            'mes' => 'required|string',
            'kwh_consumidos' => 'required|numeric',
            'kwh_presupuestado' => 'required|numeric',
        ]);

        // Guardar el nuevo registro
        ConsumoLuz::create($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('consumo_luz.index')->with('success', 'Registro agregado con éxito.');
    }
}
