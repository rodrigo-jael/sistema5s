<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsumoAgua;
use Carbon\Carbon;

class ConsumoAguaController extends Controller
{
    public function index()
    {
        $consumo = ConsumoAgua::orderBy('fecha', 'desc')->first();
        return view('moduloagua.index', compact('consumo'));
    }

    public function index2()
    {
        $consumos = ConsumoAgua::orderBy('fecha', 'desc')->get();
        return view('moduloagua.index2', compact('consumos'));
    }

    public function create()
    {
        return view('moduloagua.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'litros_consumidos' => 'required|numeric|min:0|max:565'
        ]);

        $semana = Carbon::parse($request->fecha)->weekOfYear;

        ConsumoAgua::create([
            'fecha' => $request->fecha,
            'semana' => $semana,
            'litros_consumidos' => $request->litros_consumidos,
            'litros_maximos' => 565
        ]);

        return redirect()->route('consumo_agua.index')->with('success', 'Registro guardado correctamente.');
    }

    public function show()
    {
        $consumo = ConsumoAgua::latest()->first(); 
        return view('moduloagua.show', compact('consumo'));
    }

    public function destroy($id)
    {
        $consumo = ConsumoAgua::findOrFail($id);
        $consumo->delete();

        return redirect()->route('consumo_agua.index')->with('success', 'Registro eliminado correctamente.');
    }

    public function reporte(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
        ]);

        $inicio = Carbon::parse($request->fecha_inicio)->startOfDay();
        $fin = Carbon::parse($request->fecha_fin)->endOfDay();

        $consumos = ConsumoAgua::whereBetween('fecha', [$inicio, $fin])->orderBy('fecha')->get();

        if ($consumos->isEmpty()) {
            return redirect()->back()->with('error', 'No hay registros para el periodo seleccionado.');
        }

        $promedioConsumo = $consumos->avg('litros_consumidos');

        $periodos = $consumos->map(function ($consumo) use ($promedioConsumo) {
            return [
                'fecha' => $consumo->fecha,
                'litros_utilizados' => $consumo->litros_consumidos,
                'es_sobre_promedio' => $consumo->litros_consumidos > $promedioConsumo,
            ];
        });

        // ✅ Aquí se calcula la huella total de carbono
        $huellaTotalCarbono = $periodos->sum(function ($periodo) {
            return $periodo['litros_utilizados'] * 0.000298;
        });

        return view('moduloagua.reporte', [
            'periodos' => $periodos,
            'promedioConsumo' => $promedioConsumo,
            'periodoInicio' => $inicio,
            'periodoFin' => $fin,
            'huellaTotalCarbono' => $huellaTotalCarbono
        ]);
    }
}
