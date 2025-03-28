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

    public function create()
    {
        return view('equipos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'consumo_promedio' => 'required|numeric',
        ]);

        // Guardar la imagen si se subió
        $imagenPath = $request->hasFile('imagen') 
            ? $request->file('imagen')->store('equipos', 'public') 
            : null;

        // Contar los días seleccionados
        $diasSeleccionados = collect(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'])
                                ->filter(fn($dia) => $request->has($dia))
                                ->count();

        // Crear el equipo en la base de datos
        Equipo::create([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'imagen' => $imagenPath,
            'consumo_promedio' => $request->consumo_promedio,
            'lunes' => $request->has('lunes'),
            'martes' => $request->has('martes'),
            'miercoles' => $request->has('miercoles'),
            'jueves' => $request->has('jueves'),
            'viernes' => $request->has('viernes'),
            'sabado' => $request->has('sabado'),
            'domingo' => $request->has('domingo'),
            'dias_utilizados' => $diasSeleccionados,
            'consumo_total' => $request->consumo_promedio * $diasSeleccionados,
        ]);

        return redirect()->route('equipos.index')->with('success', 'Equipo registrado correctamente.');
    }

    public function edit(Equipo $equipo)
    {
        return view('equipos.edit', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'consumo_promedio' => 'required|numeric',
        ]);

        // Manejar la imagen si se subió una nueva
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($equipo->imagen) {
                Storage::disk('public')->delete($equipo->imagen);
            }
            $imagenPath = $request->file('imagen')->store('equipos', 'public');
            $equipo->imagen = $imagenPath;
        }

        // Contar los días seleccionados
        $diasSeleccionados = collect(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'])
                                ->filter(fn($dia) => $request->has($dia))
                                ->count();

        $equipo->update([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'consumo_promedio' => $request->consumo_promedio,
            'lunes' => $request->has('lunes'),
            'martes' => $request->has('martes'),
            'miercoles' => $request->has('miercoles'),
            'jueves' => $request->has('jueves'),
            'viernes' => $request->has('viernes'),
            'sabado' => $request->has('sabado'),
            'domingo' => $request->has('domingo'),
            'dias_utilizados' => $diasSeleccionados,
            'consumo_total' => $request->consumo_promedio * $diasSeleccionados,
        ]);

        return redirect()->route('equipos.index')->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy(Equipo $equipo)
    {
        // Eliminar la imagen si existe
        if ($equipo->imagen) {
            Storage::disk('public')->delete($equipo->imagen);
        }

        $equipo->delete();
        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado correctamente.');
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

}
