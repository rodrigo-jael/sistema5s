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
        $fechaActual = Carbon::now();
        $primerRegistroFecha = Evaluation::orderBy('evaluation_date')->first()?->evaluation_date ?? $fechaActual;

        $fechaInicio = Carbon::parse($primerRegistroFecha);
        $fechaFin = Carbon::parse($fechaActual);

        $semanas = $this->getSemanas($fechaInicio, $fechaFin);

        if ($request->has('semana')) {
            $semanaIndex = $request->semana - 1;
            if (isset($semanas[$semanaIndex])) {
                $semanaSeleccionada = $semanas[$semanaIndex];
                $fechaInicio = $semanaSeleccionada['start'];
                $fechaFin = $semanaSeleccionada['end'];
            }
        }

        // Obtener todas las evaluaciones dentro de la semana seleccionada
        $evaluaciones = Evaluation::whereBetween('evaluation_date', [$fechaInicio, $fechaFin])->get();

        $totalEvaluaciones = $evaluaciones->count();
        $totalCumplio = $evaluaciones->where('evaluation_5s', 'cumplio')->count();
        $totalNoCumplio = $evaluaciones->where('evaluation_5s', 'no_cumplio')->count();

        $empleados = Employee::withCount([
            'evaluations as cumplio_count' => function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('evaluation_date', [$fechaInicio, $fechaFin])
                      ->where('evaluation_5s', 'cumplio');
            },
            'evaluations as no_cumplio_count' => function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('evaluation_date', [$fechaInicio, $fechaFin])
                      ->where('evaluation_5s', 'no_cumplio');
            }
        ])->get();

        $empleadoMenosCumplio = $empleados->isEmpty() ? 'Ninguno' : $empleados->sortBy('cumplio_count')->first();
        
        $porcentajeCumplio = $totalEvaluaciones > 0 ? round(($totalCumplio / $totalEvaluaciones) * 100, 2) : 0;
        $porcentajeNoCumplio = $totalEvaluaciones > 0 ? round(($totalNoCumplio / $totalEvaluaciones) * 100, 2) : 0;
        $estrategias = $porcentajeNoCumplio > $porcentajeCumplio
            ? 'Implementar estrategias de mejora, como capacitaciones adicionales.'
            : 'No se requieren estrategias adicionales';

        return view('reportes.index', compact(
            'semanas', 'totalEvaluaciones', 'totalCumplio', 'totalNoCumplio',
            'porcentajeCumplio', 'porcentajeNoCumplio', 'empleados',
            'empleadoMenosCumplio', 'estrategias'
        ));
    }

    private function getSemanas($fechaInicio, $fechaFin)
    {
        $fechaInicio = Carbon::parse($fechaInicio);
        $fechaFin = Carbon::parse($fechaFin);
        $semanas = [];
        $startDate = $fechaInicio->copy();

        while ($startDate <= $fechaFin) {
            $lunes = $startDate->copy()->startOfWeek();
            $viernes = $lunes->copy()->addDays(4);

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
