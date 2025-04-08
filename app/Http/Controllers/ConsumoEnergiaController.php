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
        $consumos = ConsumoEnergia::orderBy('fecha_inicio', 'desc')->get(); // Obtener todos los registros
        return view('consumoenergia.reportes', compact('consumos')); // Pasar los datos a la vista 'index'
    }

    

    public function reportes()
    {
        // Obtener todos los registros de consumo de energía, ordenados por fecha
        $consumos = ConsumoEnergia::orderBy('fecha_inicio', 'desc')->get();
    
        // Calcular el consumo total de todos los equipos
        $totalConsumoGeneral = ConsumoEnergia::sum('kwh_consumidos');
    
        // Pasar los datos a la vista 'reportes'
        return view('consumoenergia.reportes', compact('consumos', 'totalConsumoGeneral'));
    }
    
    /*public function subirRecibo(Request $request, $id)
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
    }*/

    /*public function descargarRecibo($id)
    {
        $consumo = ConsumoEnergia::findOrFail($id);

        if ($consumo->pdf_recibo) {
            return response()->download(storage_path("app/public/{$consumo->pdf_recibo}"));
        }

        return back()->with('error', 'No hay recibo disponible.');
    }*/

    public function create()
    {
        return view('consumoenergia.nuevo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kwh_consumidos' => 'required|numeric|min:0',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'pdf_recibo' => 'nullable|mimes:pdf|max:2048', // Nuevo
        ]);

        $datos = $request->only(['kwh_consumidos', 'fecha_inicio', 'fecha_fin']);

        if ($request->hasFile('pdf_recibo')) {
            $archivo = $request->file('pdf_recibo');
            $nombre = time() . '_' . $archivo->getClientOriginalName();
            $ruta = $archivo->storeAs('recibos', $nombre, 'public');
            $datos['pdf_recibo'] = $ruta;
        }

        ConsumoEnergia::create($datos);

        return redirect()->route('consumoenergia.reportes')->with('success', 'Consumo de energía registrado correctamente.');
    }

    public function destroy($id)
    {
        $consumo = ConsumoEnergia::findOrFail($id);
    
        // Eliminar archivo PDF si existe
        if ($consumo->pdf_recibo && \Storage::disk('public')->exists($consumo->pdf_recibo)) {
            \Storage::disk('public')->delete($consumo->pdf_recibo);
        }
    
        // Eliminar registro de la base de datos
        $consumo->delete();
    
        return redirect()->route('consumoenergia.reportes')->with('success', 'La fila fue eliminada correctamente.');
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'kwh_consumidos' => 'required|numeric|min:0',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'pdf_recibo' => 'nullable|mimes:pdf|max:2048',
        ]);

        $consumo = ConsumoEnergia::findOrFail($id);

        $consumo->kwh_consumidos = $request->kwh_consumidos;
        $consumo->fecha_inicio = $request->fecha_inicio;
        $consumo->fecha_fin = $request->fecha_fin;

        if ($request->hasFile('pdf_recibo')) {
            // Borrar el archivo anterior si existe
            if ($consumo->pdf_recibo && \Storage::disk('public')->exists($consumo->pdf_recibo)) {
                \Storage::disk('public')->delete($consumo->pdf_recibo);
            }

            $archivo = $request->file('pdf_recibo');
            $nombre = time() . '_' . $archivo->getClientOriginalName();
            $ruta = $archivo->storeAs('recibos', $nombre, 'public');
            $consumo->pdf_recibo = $ruta;
        }

        $consumo->save();

        return redirect()->route('consumoenergia.reportes')->with('success', 'Reporte actualizado correctamente.');
    }


}

