<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::all(); // Obtener todos los equipos de la BD
        return view('consumoenergia.index', compact('equipos'));
    }
}
