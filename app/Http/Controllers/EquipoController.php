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
        foreach ($request->dias as $equipoId => $dias) {
            $equipo = Equipo::find($equipoId);
    
            if (!$equipo) {
                continue;
            }
    
            // Contar los días seleccionados
            $diasSeleccionados = collect(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'])
                                    ->filter(fn($dia) => isset($dias[$dia]) && $dias[$dia] == 1)
                                    ->count();
    
            // Calcular total de horas encendido (24 horas por día)
            $horasEncendido = $diasSeleccionados * 24;
    
            // Calcular consumo total
            $consumoTotal = $equipo->consumo_promedio * $diasSeleccionados;
    
            // Actualizar el equipo en la base de datos
            $equipo->update([
                'lunes' => isset($dias['lunes']),
                'martes' => isset($dias['martes']),
                'miercoles' => isset($dias['miercoles']),
                'jueves' => isset($dias['jueves']),
                'viernes' => isset($dias['viernes']),
                'sabado' => isset($dias['sabado']),
                'dias_utilizados' => $diasSeleccionados,
                'horas_encendido' => $horasEncendido,  // Nuevo campo
                'consumo_total' => $consumoTotal,
            ]);
        }
    
        return redirect()->route('equipos.index')->with('success', 'Días y horas actualizados correctamente.');
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
           $imagenPath = $request->hasFile('imagen') 
           ? $request->file('imagen')->store('equipos', 'public') 
           : null;

          // Crear el equipo en la base de datos
           Equipo::create([
          'nombre' => $request->nombre,
          'ubicacion' => $request->ubicacion,
          'imagen' => $imagenPath,
          'consumo_promedio' => $request->consumo,
           ]);

          return redirect()->route('equipos.index')->with('success', 'Equipo registrado correctamente.');
        }

        public function eliminar($equipo)
        {
            // Encontramos el equipo
            $equipo = Equipo::findOrFail($equipo);

            // Eliminamos el equipo
            $equipo->delete();

            // Redirigimos de vuelta a la lista de equipos con un mensaje de éxito
            return redirect()->route('equipos.index')->with('success', 'Equipo eliminado correctamente.');
        }

}
