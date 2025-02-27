<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation; // Importa el modelo de Evaluación

class EvaluationController extends Controller
{
    // Función para crear un nuevo registro de evaluación
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'date' => 'required|date|unique:evaluations,evaluation_date', // Asegura que la fecha sea única
            'evaluation_5s' => 'required|string',
            // Otros campos que necesites
        ]);

        // Crear un nuevo registro de evaluación
        Evaluation::create([
            'evaluation_date' => $request->date,
            'evaluation_5s' => $request->evaluation_5s,
            // Otros campos si los hay
        ]);

        // Obtener las evaluaciones después de guardar el registro
        $evaluations = Evaluation::all(); // O puedes modificar esto para obtener solo las evaluaciones del día o según tu necesidad

        // Redirigir a la vista dashboard y pasar las evaluaciones
        return redirect()->route('dashboard')->with('success', 'Registro de evaluación creado exitosamente!')->with('evaluations', $evaluations);
    }

    // Función para mostrar el Dashboard con las evaluaciones
    public function index()
    {
        // Obtener todas las evaluaciones
        $evaluations = Evaluation::all(); // Puedes modificar esto si deseas filtrar las evaluaciones

        // Pasar las evaluaciones a la vista
        return view('dashboard', compact('evaluations'));
    }
}
