<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LuzController extends Controller
{
    public function index() {
        return view('moduloLuz.index'); // Aquí llamamos la vista desde la carpeta correcta
    }
    
}

