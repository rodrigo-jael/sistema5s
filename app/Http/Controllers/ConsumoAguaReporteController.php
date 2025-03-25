<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsumoAgua;
use Carbon\Carbon;

class ConsumoAguaReporteController extends Controller
{
    public function show(Request $request)
    {
        // Obtener el primer y último registro de consumo de agua desde la base de datos para determinar el rango de fechas
        $primerRegistro = ConsumoAgua::orderBy('fecha', 'asc')->first();
        $ultimoRegistro = ConsumoAgua::orderBy('fecha', 'desc')->first();

        // Si no hay registros de consumo de agua
        if (!$primerRegistro || !$ultimoRegistro) {
            return redirect()->route('consumo_agua.index')->with('error', 'No se encontraron registros de consumo de agua.');
        }

        // Obtener el rango de fechas del primer y último registro
        $periodoInicio = Carbon::parse($primerRegistro->fecha);
        $periodoFin = Carbon::parse($ultimoRegistro->fecha);

        // Obtener los registros filtrados entre el rango de fechas
        $registros = ConsumoAgua::whereBetween('fecha', [$periodoInicio, $periodoFin])->get();

        // Si no hay registros en el periodo seleccionado
        if ($registros->isEmpty()) {
            return redirect()->route('consumo_agua.index')->with('error', 'No se encontraron registros para el periodo seleccionado.');
        }

        // Calcular el promedio de litros consumidos en el periodo seleccionado
        $promedioConsumo = $registros->avg('litros_consumidos');

        // Crear lista de datos para la vista
        $periodos = [];
        foreach ($registros as $registro) {
            $esSobrePromedio = $registro->litros_consumidos > $promedioConsumo;
            $periodos[] = [
                'fecha' => $registro->fecha,
                'litros_utilizados' => $registro->litros_consumidos,
                'es_sobre_promedio' => $esSobrePromedio,
            ];
        }

        // Pasar los datos a la vista
        return view('moduloagua.show', compact('periodos', 'promedioConsumo', 'periodoInicio', 'periodoFin'));
    }
}
