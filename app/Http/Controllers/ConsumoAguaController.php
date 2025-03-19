<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsumoAgua;
use Carbon\Carbon;

class ConsumoAguaController extends Controller
{
    public function index()
    {
        $consumo = ConsumoAgua::orderBy('fecha', 'desc')->first(); // Selecciona el último registro
        return view('moduloagua.index', compact('consumo'));  // Vista principal
    }
    
    public function index2()
    {
        // Obtén los consumos para pasarlos a la vista, si es necesario
        $consumos = ConsumoAgua::orderBy('fecha', 'desc')->get();
        return view('moduloagua.index2', compact('consumos'));  // Pasa los consumos a la vista
    }

    public function create()
    {
        return view('moduloagua.create');  // Vista para crear registros
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'litros_consumidos' => 'required|numeric|min:0|max:450'
        ]);

        $semana = Carbon::parse($request->fecha)->weekOfYear;

        ConsumoAgua::create([
            'fecha' => $request->fecha,
            'semana' => $semana,
            'litros_consumidos' => $request->litros_consumidos,
            'litros_maximos' => 450
        ]);

        return redirect()->route('consumo_agua.index')->with('success', 'Registro guardado correctamente.');
    }

    public function show()
    {
    // Obtener el último registro (o puedes cambiarlo por obtener todos los registros si prefieres)
    $consumo = ConsumoAgua::latest()->first(); 

        return view('moduloagua.show', compact('consumo'));  // Pasamos el último registro a la vista
    }
    

    public function destroy($id)
    {
        $consumo = ConsumoAgua::findOrFail($id);
        $consumo->delete();

        return redirect()->route('consumo_agua.index')->with('success', 'Registro eliminado correctamente.');
    }
}
