<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AguaController extends Controller
{
    public function index() {
        return view('moduloagua.index'); // Aquí llamamos la vista desde la carpeta correcta
    }
    
}
