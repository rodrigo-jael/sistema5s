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
            ->map(function ($date) {
                // Formatea la fecha a un formato amigable para mostrar en la vista
                return Carbon::parse($date)->format('d/m/Y');
            })
            ->toArray(); // Convertimos la colección a array para evitar problemas con la vista

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
        ->toArray(); // Convertimos la colección a array para evitar problemas con la vista

    // Filtrar las evaluaciones por la fecha seleccionada, si se especifica alguna
    $date = $request->input('date');
    $evaluations = Evaluation::when($date, function ($query) use ($date) {
        return $query->whereDate('evaluation_date', $date);
    })
    ->get();

    // Pasar las variables a la vista correctamente
    return view('employees.chart', [
        'dates' => $dates,
        'evaluations' => $evaluations
    ]);
}

    public function evaluate(Request $request)
    {
        // Verifica si hay datos en el formulario
        if ($request->has('status') && is_array($request->status)) {
            foreach ($request->status as $employeeId => $status) {
                // Guarda la evaluación en la tabla evaluations
                Evaluation::create([
                    'employee_id' => $employeeId,
                    'evaluation_5s' => $status,
                    'evaluation_date' => $request->evaluation_date // Obtiene la fecha del formulario
                ]);
            }
            return redirect()->route('dashboard')->with('success', 'Evaluación guardada correctamente.');
        } else {
            return redirect()->route('dashboard')->with('error', 'No se seleccionaron evaluaciones para guardar.');
        }
    }

    public function store(Request $request)
{
    // Validar si ya existe un registro para la fecha
    $existingEvaluation = Evaluation::where('evaluation_date', $request->evaluation_date)->first();

    if ($existingEvaluation) {
        // Si ya existe un registro, redirige con un mensaje de error
        return redirect()->back()->with('error', 'Ya existe un registro para esta fecha.');
    }

    // Si no existe un registro, guardar la nueva evaluación
    $evaluation = new Evaluation();
    $evaluation->employee_id = $request->employee_id;
    $evaluation->evaluation_date = $request->evaluation_date;
    $evaluation->evaluation_5s = $request->evaluation_5s;
    $evaluation->save();

    return redirect()->route('evaluations.index')->with('success', 'Registro guardado con éxito.');
}

}
