<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsumoAgua;
use Carbon\Carbon;

class ConsumoAguaReporteController extends Controller
{
    public function show(Request $request)
    {
        // Verificar si las fechas de inicio y fin están presentes
        if (!$request->has('inicio') || !$request->has('fin')) {
            return response()->json(['error' => 'Las fechas de inicio y fin son requeridas.'], 400);
        }

        // Intentar parsear las fechas de inicio y fin
        try {
            $periodoInicio = Carbon::createFromFormat('Y-m-d', $request->inicio);
            $periodoFin = Carbon::createFromFormat('Y-m-d', $request->fin);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Formato de fecha no válido para las fechas personalizadas.'], 400);
        }

        // Filtrar registros por fecha
        $registros = ConsumoAgua::whereBetween('fecha', [$periodoInicio, $periodoFin])->get();

        // Calcular el promedio de litros utilizados en el período
        $promedioConsumo = $registros->avg('litros_consumidos');

        // Crear una lista de los periodos con el cálculo
        $periodos = [];
        foreach ($registros as $registro) {
            $esSobrePromedio = $registro->litros_consumidos > $promedioConsumo;
            $periodos[] = [
                'fecha' => $registro->fecha,
                'litros_utilizados' => $registro->litros_consumidos,
                'es_sobre_promedio' => $esSobrePromedio,
            ];
        }

        return view('moduloagua.show', compact('periodos', 'promedioConsumo', 'periodoInicio', 'periodoFin'));
    }
}
