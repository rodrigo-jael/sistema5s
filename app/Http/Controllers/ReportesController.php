<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Employee;
use Carbon\Carbon;
use App\Exports\ReportesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportesController extends Controller
{
    public function index(Request $request)
    {
        // Definir el rango de fechas
        $fechaInicio = Carbon::parse('2025-02-03'); // 3 de febrero
        $fechaFin = Carbon::parse('2025-03-05'); // 5 de marzo

        // Crear las semanas de lunes a viernes
        $semanas = $this->getSemanas($fechaInicio, $fechaFin);

        // Filtrar evaluaciones por semana si se seleccionó una
        if ($request->has('semana')) {
            $semanaIndex = $request->semana - 1;

            if (isset($semanas[$semanaIndex])) {
                $semanaSeleccionada = $semanas[$semanaIndex];
                $fechaInicio = $semanaSeleccionada['start'];
                $fechaFin = $semanaSeleccionada['end'];
            }
        }

        // Obtener las evaluaciones dentro del rango de fechas
        $evaluaciones = Evaluation::whereBetween('evaluation_date', [$fechaInicio, $fechaFin]);

        // Obtener fechas únicas
        $fechas = $evaluaciones->selectRaw('DATE(evaluation_date) as evaluation_date')
            ->groupBy('evaluation_date')
            ->orderBy('evaluation_date', 'asc')
            ->pluck('evaluation_date')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d'))
            ->toArray();

        // Inicializar variables para almacenar los totales
        $totalEvaluaciones = 0;
        $totalCumplio = 0;
        $totalNoCumplio = 0;
        $empleados = [];
        $empleadoMenosCumplio = null;
        $estrategias = '';

        // Recorrer las fechas y calcular los datos por cada fecha
        foreach ($fechas as $fecha) {
            $evaluacionesPorFecha = $evaluaciones->whereDate('evaluation_date', Carbon::parse($fecha));

            $totalEvaluaciones += $evaluacionesPorFecha->count();
            $totalCumplio += $evaluacionesPorFecha->where('evaluation_5s', 'cumplio')->count();
            $totalNoCumplio += $evaluacionesPorFecha->where('evaluation_5s', 'no_cumplio')->count();

            // Obtener empleados con sus conteos de cumplimiento
            $empleados = Employee::withCount([
                'evaluations as cumplio_count' => function ($query) use ($fecha) {
                    $query->whereDate('evaluation_date', Carbon::parse($fecha))
                        ->where('evaluation_5s', 'cumplio');
                },
                'evaluations as no_cumplio_count' => function ($query) use ($fecha) {
                    $query->whereDate('evaluation_date', Carbon::parse($fecha))
                        ->where('evaluation_5s', 'no_cumplio');
                }
            ])->get();

            // Obtener el empleado con menor cumplimiento
            $empleadoMenosCumplio = $empleados->isEmpty() ? 'Ninguno' : $empleados->sortBy('cumplio_count')->first();

            // Estrategias si el porcentaje de no cumplimiento es mayor
            $porcentajeCumplio = ($totalEvaluaciones > 0) ? round(($totalCumplio / $totalEvaluaciones) * 100, 2) : 0;
            $porcentajeNoCumplio = ($totalEvaluaciones > 0) ? round(($totalNoCumplio / $totalEvaluaciones) * 100, 2) : 0;
            $estrategias = $porcentajeNoCumplio > $porcentajeCumplio
                ? 'Implementar estrategias de mejora, como capacitaciones adicionales.'
                : 'No se requieren estrategias adicionales';
        }

        // Pasar los datos a la vista
        return view('reportes.index', compact(
            'semanas', 
            'totalEvaluaciones', 
            'totalCumplio', 
            'totalNoCumplio', 
            'porcentajeCumplio', 
            'porcentajeNoCumplio', 
            'empleados', 
            'empleadoMenosCumplio', 
            'estrategias'
        ));
    }

    // Método para obtener las semanas de lunes a viernes
    private function getSemanas($fechaInicio, $fechaFin)
    {
        $semanas = [];
        $startDate = $fechaInicio->copy();

        while ($startDate <= $fechaFin) {
            $lunes = $startDate->copy()->startOfWeek();
            $viernes = $lunes->copy()->addDays(4); // Viernes de la semana

            if ($lunes >= $fechaInicio && $viernes <= $fechaFin) {
                $semanas[] = [
                    'nombre' => 'Semana ' . (count($semanas) + 1),
                    'fecha_inicio' => $lunes->format('d/m/Y'),
                    'fecha_fin' => $viernes->format('d/m/Y'),
                    'start' => $lunes->copy(),
                    'end' => $viernes->copy(),
                ];
            }

            $startDate = $lunes->copy()->addDays(7);
        }

        return $semanas;
    }
}
