<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class registerluzController extends Controller
{
    public function index() {
        return view('moduloLuz.registerluz'); // Aquí llamamos la vista desde la carpeta correcta
    }
    
}

