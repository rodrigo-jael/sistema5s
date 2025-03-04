<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Employee; // Asegúrate de importar Employee
use Carbon\Carbon;
use App\Exports\ReportesExport;
use Maatwebsite\Excel\Facades\Excel; // Asegúrate de importar Excel

class ReportesController extends Controller
{
    public function index()
    {
        // Obtener todas las fechas únicas de evaluación
        $fechas = Evaluation::selectRaw('DATE(evaluation_date) as date')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->format('d/m/Y'));

        // Obtener estadísticas generales
        $totalEvaluaciones = Evaluation::count();
        $totalCumplio = Evaluation::where('evaluation_5s', 'cumplio')->count();
        $totalNoCumplio = Evaluation::where('evaluation_5s', 'no_cumplio')->count();

        // Calcular porcentajes
        $porcentajeCumplio = ($totalEvaluaciones > 0) ? round(($totalCumplio / $totalEvaluaciones) * 100, 2) : 0;
        $porcentajeNoCumplio = ($totalEvaluaciones > 0) ? round(($totalNoCumplio / $totalEvaluaciones) * 100, 2) : 0;

        // Obtener al empleado más cumplidor
        $empleadoMasCumplidor = Employee::select('employees.name')
            ->join('evaluations', 'employees.id', '=', 'evaluations.employee_id')
            ->where('evaluations.evaluation_5s', 'cumplio')
            ->groupBy('employees.id', 'employees.name')
            ->orderByRaw('COUNT(evaluations.id) DESC')
            ->limit(1)
            ->value('name');

        // Si no hay empleados que hayan cumplido, asignar un mensaje por defecto
        $empleadoMasCumplidor = $empleadoMasCumplidor ?? 'No hay empleados que hayan cumplido';

        // Retornar la vista con todas las variables
        return view('reportes.index', compact(
            'fechas', 'totalEvaluaciones', 'totalCumplio', 
            'totalNoCumplio', 'porcentajeCumplio', 'porcentajeNoCumplio', 
            'empleadoMasCumplidor'
        ));
    }

    public function export()
    {
        // Obtener los datos desde el método index
        $fechas = Evaluation::selectRaw('DATE(evaluation_date) as date')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->format('d/m/Y'));

        $totalEvaluaciones = Evaluation::count();
        $totalCumplio = Evaluation::where('evaluation_5s', 'cumplio')->count();
        $totalNoCumplio = Evaluation::where('evaluation_5s', 'no_cumplio')->count();

        $porcentajeCumplio = ($totalEvaluaciones > 0) ? round(($totalCumplio / $totalEvaluaciones) * 100, 2) : 0;
        $porcentajeNoCumplio = ($totalEvaluaciones > 0) ? round(($totalNoCumplio / $totalEvaluaciones) * 100, 2) : 0;

        $empleadoMasCumplidor = Employee::select('employees.name')
            ->join('evaluations', 'employees.id', '=', 'evaluations.employee_id')
            ->where('evaluations.evaluation_5s', 'cumplio')
            ->groupBy('employees.id', 'employees.name')
            ->orderByRaw('COUNT(evaluations.id) DESC')
            ->limit(1)
            ->value('name');

        $empleadoMasCumplidor = $empleadoMasCumplidor ?? 'No hay empleados que hayan cumplido';

        // Pasamos los datos al exportador
        return Excel::download(new ReportesExport(
            $fechas,
            $totalEvaluaciones,
            $totalCumplio,
            $totalNoCumplio,
            $porcentajeCumplio,
            $porcentajeNoCumplio,
            $empleadoMasCumplidor
        ), 'reportes_5s.xlsx');
    }
}
