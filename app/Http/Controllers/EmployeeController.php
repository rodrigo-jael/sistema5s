<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function index()
    {
        // Obtiene todos los empleados
        $employees = Employee::all();
        
        // Obtener todas las fechas únicas de la base de datos y formatearlas
        $dates = Evaluation::selectRaw('DATE(evaluation_date) as date')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->format('d/m/Y'))
            ->toArray();

        // Muestra el dashboard con los empleados y las fechas
        return view('dashboard', compact('employees', 'dates'));
    }

    public function show($id)
    {
        // Obtiene los detalles de un empleado específico
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function chartData(Request $request)
    {
        // Obtener todas las fechas únicas de la base de datos
        $dates = Evaluation::selectRaw('DATE(evaluation_date) as date')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->toArray();

        // Filtrar las evaluaciones por la fecha seleccionada, si se especifica alguna
        $date = $request->input('date');
        $evaluations = Evaluation::when($date, function ($query) use ($date) {
            return $query->whereDate('evaluation_date', $date);
        })->get();

        return view('employees.chart', [
            'dates' => $dates,
            'evaluations' => $evaluations
        ]);
    }

    public function evaluate(Request $request)
    {
        // Obtener la fecha del formulario o usar la fecha actual
        $evaluationDate = $request->evaluation_date ? Carbon::parse($request->evaluation_date)->toDateString() : Carbon::today()->toDateString();

        // Validar si ya se ha registrado alguna evaluación en la fecha seleccionada
        $existingEvaluations = Evaluation::whereDate('evaluation_date', $evaluationDate)->exists();

        if ($existingEvaluations) {
            return redirect()->route('dashboard')->with('error', 'Ya has realizado registros para esta fecha.');
        }

        // Verifica si hay datos en el formulario
        if ($request->has('status') && is_array($request->status)) {
            foreach ($request->status as $employeeId => $status) {
                // Verificar si ya existe una evaluación para este empleado en la fecha dada
                $existingEvaluationForEmployee = Evaluation::where('employee_id', $employeeId)
                    ->whereDate('evaluation_date', $evaluationDate)
                    ->exists();

                if (!$existingEvaluationForEmployee) {
                    // Guarda la evaluación en la tabla evaluations
                    Evaluation::create([
                        'employee_id' => $employeeId,
                        'evaluation_5s' => $status,
                        'evaluation_date' => $evaluationDate
                    ]);
                }
            }
            return redirect()->route('dashboard')->with('success', 'Evaluación guardada correctamente.');
        } else {
            return redirect()->route('dashboard')->with('error', 'No se seleccionaron evaluaciones para guardar.');
        }
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
