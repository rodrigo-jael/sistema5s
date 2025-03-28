<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\EmployeePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EvaluationController extends Controller
{
    // Método para almacenar la foto del empleado en la evaluación
    public function storeEvaluation(Request $request)
    {
        // Validación para la foto en formato Base64
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id', // Validar que el empleado existe
            'foto_capturada' => 'required|string', // Validación para la foto Base64
        ]);

        $employeeId = $validatedData['employee_id'];
        $base64Image = $validatedData['foto_capturada'];

        // Extraer la parte Base64 de la cadena
        $imageData = explode(',', $base64Image)[1];
        $imageName = 'photo_' . $employeeId . '_' . time() . '.png';

        // Crear el directorio 'images' si no existe
        $directory = storage_path('app/public/images');
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);  // Crear directorio con permisos adecuados
        }

        // Guardamos la imagen en el directorio 'images'
        $saved = Storage::disk('public')->put('images/' . $imageName, base64_decode($imageData));

        // Log para verificar si la imagen se guardó correctamente
        if ($saved) {
            Log::info('Imagen guardada correctamente: ' . $imageName);
        } else {
            Log::error('Error al guardar la imagen: ' . $imageName);
            return redirect()->route('employees.evaluation')->with('error', 'Hubo un error al guardar la imagen.');
        }

        // Crear la evaluación y asociar la foto con el empleado
        $evaluation = Evaluation::create([
            'employee_id' => $employeeId,
            'photo_path' => 'images/' . $imageName, // Guardar la ruta relativa en la base de datos
        ]);

        // Crear un registro en la tabla EmployeePhoto (si así lo deseas)
        EmployeePhoto::create([
            'employee_id' => $employeeId,
            'photo_path' => 'images/' . $imageName, // Guardar la ruta de la foto
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('employees.evaluation')->with('success', 'Evaluación guardada correctamente');
    }

    // Método para mostrar la lista de evaluaciones
    public function showEvaluations()
    {
        $evaluations = Evaluation::all();  // Obtener todas las evaluaciones

        return view('evaluations.index', compact('evaluations'));
    }
}
