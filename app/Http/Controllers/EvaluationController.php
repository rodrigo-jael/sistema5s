<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    // Método para ver la foto de una evaluación
    public function verFoto($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        return view('evaluaciones.foto', compact('evaluation'));
    }
}
}