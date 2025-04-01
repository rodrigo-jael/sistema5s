<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use Illuminate\Support\Facades\Storage;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::all();
        return view('equipos.index', compact('equipos'));
    }


    public function updateDias(Request $request)
  {
     // Asegurarse de que el formulario ha enviado datos para actualizar
     foreach ($request->dias as $equipoId => $dias) {
        // Encontrar el equipo por ID
        $equipo = Equipo::find($equipoId);
        
        // Si el equipo no existe, continuar con el siguiente
        if (!$equipo) {
            continue;
        }

        // Contar los días seleccionados
        $diasSeleccionados = collect(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'])
                                ->filter(fn($dia) => isset($dias[$dia]) && $dias[$dia] == 1)
                                ->count();

        // Actualizar los días de la semana y el consumo total
        $equipo->update([
            'lunes' => isset($dias['lunes']),
            'martes' => isset($dias['martes']),
            'miercoles' => isset($dias['miercoles']),
            'jueves' => isset($dias['jueves']),
            'viernes' => isset($dias['viernes']),
            'sabado' => isset($dias['sabado']),
            'dias_utilizados' => $diasSeleccionados,
            'consumo_total' => $equipo->consumo_promedio * $diasSeleccionados,
        ]);
       }

      return redirect()->route('equipos.index')->with('success', 'Días actualizados correctamente.');
 }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'consumo' => 'required|numeric',
        ]);
    
        // Guardar la imagen si se subió
        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('equipos', 'public');
            
        }
    
        // Crear el equipo en la base de datos
        Equipo::create([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'imagen' => $imagenPath, // Guardamos solo la ruta relativa
            'consumo_promedio' => $request->consumo,
        ]);
    
        return redirect()->route('equipos.index')->with('success', 'Equipo registrado correctamente.');
    }
}

