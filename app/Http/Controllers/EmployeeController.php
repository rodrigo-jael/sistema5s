<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();

        // Obtener IDs de empleados ya evaluados hoy
        $evaluatedEmployees = Evaluation::whereDate('evaluation_date', $today)
            ->pluck('employee_id')
            ->toArray();

        // Obtener empleados que aún no han sido evaluados hoy
        $employees = Employee::whereNotIn('id', $evaluatedEmployees)->get();

        // Obtener todas las fechas únicas de la base de datos y formatearlas
        $dates = Evaluation::selectRaw('DATE(evaluation_date) as date')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->format('d/m/Y'))
            ->toArray();

        // Obtener al empleado que más cumplió con las evaluaciones 5S
        $empleadoMasCumplidor = Employee::select('employees.name')
            ->join('evaluations', 'employees.id', '=', 'evaluations.employee_id')
            ->where('evaluations.evaluation_5s', 'cumplio')
            ->groupBy('employees.id', 'employees.name')
            ->orderByRaw('COUNT(evaluations.id) DESC')
            ->limit(1)
            ->value('name');

        // Si no hay empleados que hayan cumplido, asignar un mensaje por defecto
        $empleadoMasCumplidor = $empleadoMasCumplidor ?? 'No hay empleados que hayan cumplido';

        return view('dashboard', compact('employees', 'dates', 'empleadoMasCumplidor'));
    }

    public function evaluate(Request $request)
    {
        $evaluationDate = $request->evaluation_date ? Carbon::parse($request->evaluation_date)->toDateString() : Carbon::today()->toDateString();

        if ($request->has('status') && is_array($request->status)) {
            foreach ($request->status as $employeeId => $status) {
                // Solo guardar si no hay una evaluación para este empleado en la fecha dada
                $existingEvaluationForEmployee = Evaluation::where('employee_id', $employeeId)
                    ->whereDate('evaluation_date', $evaluationDate)
                    ->exists();

                if (!$existingEvaluationForEmployee) {
                    Evaluation::create([
                        'employee_id' => $employeeId,
                        'evaluation_5s' => $status,
                        'evaluation_date' => $evaluationDate
                    ]);
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Evaluación guardada correctamente.');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function chartData(Request $request)
    {
        $dates = Evaluation::selectRaw('DATE(evaluation_date) as date')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->toArray();

        $date = $request->input('date');
        $evaluations = Evaluation::when($date, function ($query) use ($date) {
            return $query->whereDate('evaluation_date', $date);
        })->get();

        return view('employees.chart', [
            'dates' => $dates,
            'evaluations' => $evaluations
        ]);
    }

    public function chart2(Request $request)
    {
        $date = $request->input('date');

        if (!$date) {
            return redirect()->route('employees.index')->with('error', 'Seleccione una fecha.');
        }

        $evaluations = Evaluation::whereDate('evaluation_date', $date)->get();

        if ($evaluations->isEmpty()) {
            return redirect()->route('employees.index')->with('error', 'No hay evaluaciones para esta fecha.');
        }

        $total = $evaluations->count();
        $cumplio = $evaluations->where('evaluation_5s', 'cumplio')->count();
        $noCumplio = $evaluations->where('evaluation_5s', 'no_cumplio')->count();

        $cumplioPorcentaje = ($total > 0) ? round(($cumplio / $total) * 100, 2) : 0;
        $noCumplioPorcentaje = ($total > 0) ? round(($noCumplio / $total) * 100, 2) : 0;

        return view('employees.chart2', compact('date', 'cumplio', 'noCumplio', 'cumplioPorcentaje', 'noCumplioPorcentaje'));
    }
}
