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
        return view('consumoenergia.reportes', compact('consumos')); // Pasar los datos a la vista 'index'
    }

    

    public function reportes()
    {
        // Obtener todos los registros de consumo de energía, ordenados por fecha
        $consumos = ConsumoEnergia::orderBy('fecha', 'desc')->get();
    
        // Calcular el consumo total de todos los equipos
        $totalConsumoGeneral = ConsumoEnergia::sum('kwh_consumidos');
    
        // Pasar los datos a la vista 'reportes'
        return view('consumoenergia.reportes', compact('consumos', 'totalConsumoGeneral'));
    }
    
    public function subirRecibo(Request $request, $id)
    {
        $request->validate([
            'pdf_recibo' => 'required|mimes:pdf|max:2048'
        ]);

        $consumo = ConsumoEnergia::findOrFail($id);

        if ($request->hasFile('pdf_recibo')) {
            $path = $request->file('pdf_recibo')->store('recibos', 'public');
            $consumo->pdf_recibo = $path;
            $consumo->save();
        }

        return redirect()->route('consumoenergia.reportes')->with('success', 'Recibo de luz guardado correctamente.');
    }

    public function descargarRecibo($id)
    {
        $consumo = ConsumoEnergia::findOrFail($id);

        if ($consumo->pdf_recibo) {
            return response()->download(storage_path("app/public/{$consumo->pdf_recibo}"));
        }

        return back()->with('error', 'No hay recibo disponible.');
    }

    public function create()
    {
        return view('consumoenergia.nuevo');
    }

   


}

