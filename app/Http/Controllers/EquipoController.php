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
            // Buscar el equipo, si no existe, ignorar la actualización
            $equipo = Equipo::find($equipoId);
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

        return redirect()->route('equipos.index')->with('success', 'Días de uso actualizados correctamente.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'consumo' => 'required|numeric',
        ]);

        // Verificar si la imagen se subió correctamente
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('equipos', 'public');
            if (!$imagenPath) {
                return back()->withErrors(['imagen' => 'No se pudo guardar la imagen.']);
            }
        } else {
            $imagenPath = null;
        }

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
        $equipo = Equipo::findOrFail($equipo);

        // Borrar la imagen si existe
        if ($equipo->imagen) {
            Storage::disk('public')->delete($equipo->imagen);
        }

        // Eliminar el equipo
        $equipo->delete();

        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado correctamente.');
    }
}
