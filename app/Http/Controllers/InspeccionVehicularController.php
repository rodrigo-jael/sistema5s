<?php

namespace App\Http\Controllers;

use App\Models\Inspecciones;
use Illuminate\Http\Request;
use App\Models\Vehiculo;

class InspeccionVehicularController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('modulovehicular.inspeccion.index', compact('vehiculos'));
    }

    // Formulario para nueva inspección
    public function create($vehiculo_id)
    {
        $vehiculo = Vehiculo::findOrFail($vehiculo_id);
        return view('modulovehicular.inspeccion.create', compact('vehiculo'));
    }

    // Guardar inspección
    public function store(Request $request)
{
   

    $validated = $request->validate([
        'vehiculo_id' => 'required|exists:vehiculos,id',
        'fecha' => 'nullable|date',
        'kilometraje' => 'nullable|integer',
    ]);

    // Guardar inspección
    Inspecciones::create([
        'vehiculo_id' => $validated['vehiculo_id'],
        'fecha' => $validated['fecha'],
        'placas' => Vehiculo::find($validated['vehiculo_id'])->placa, // <- Usamos el valor desde el modelo Vehiculo
        'kilometraje' => $validated['kilometraje'],
        'luces_delanteras' => $request->has('luces_delanteras'),
        'luces_traseras' => $request->has('luces_traseras'),
        'intermitentes' => $request->has('intermitentes'),
        'direccionales' => $request->has('direccionales'),
        'espejos' => $request->has('espejos'),
        'limpia_parabrisas' => $request->has('limpia_parabrisas'),
        'circulacion' => $request->has('circulacion'),
        'licencia' => $request->has('licencia'),
        'seguro' => $request->has('seguro'),
        'nivel_aceite' => $request->has('nivel_aceite'),
        'nivel_frenos' => $request->has('nivel_frenos'),
        'nivel_anticongelante' => $request->has('nivel_anticongelante'),
        'llantas' => $request->has('llantas'),
        'rines' => $request->has('rines'),
        'cables' => $request->has('cables'),
        'fugas' => $request->has('fugas'),
        'sede' => $request->sede,
        'chofer' => $request->chofer,
        'supervisor' => $request->supervisor,
        'nivel_gasolina' => $request->nivel_gasolina,
    ]);

    return redirect()->route('inspeccion.index')->with('success', 'Inspección guardada correctamente');
}

public function verInspecciones($vehiculoId)
{
    $vehiculo = Vehiculo::with('inspecciones')->findOrFail($vehiculoId);

    return view('modulovehicular.inspeccion.index2', compact('vehiculo'));
}
    
}
