<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\EmployeePhoto; // Asegúrate de tener un modelo para almacenar la ruta de la imagen

class EmployeePhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer',
            'foto_capturada' => 'required|string', // La imagen viene en formato Base64
        ]);

        // Convertir Base64 a imagen
        $imageData = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $request->foto_capturada));
        $filename = "empleado_{$request->employee_id}_" . time() . ".png";
        Storage::put("public/fotos/{$filename}", $imageData);

        // Guardar la ruta en la base de datos
        $photo = EmployeePhoto::create([
            'employee_id' => $request->employee_id,
            'photo_path' => "storage/fotos/{$filename}",
        ]);

        return response()->json(['success' => true, 'message' => 'Foto guardada', 'photo' => $photo]);
    }
}
