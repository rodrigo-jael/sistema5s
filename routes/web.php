<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReporteExportController;
use App\Http\Controllers\AguaController;




// Redirigir al login en la ruta principal si no está autenticado
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/welcome2');
    }
    return view('auth.login');
});

// Nueva vista de bienvenida después de iniciar sesión
Route::get('/welcome2', function () {
    return view('welcome2');
})->middleware(['auth', 'verified'])->name('welcome2');

// Vista de bienvenida para el módulo 5S
Route::get('/welcome', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

// Ruta para el dashboard
Route::get('/dashboard', [EmployeeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/grafica', [EmployeeController::class, 'chartData'])->name('employees.chart');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/employee/{id}', [EmployeeController::class, 'show'])->name('employee.view');

    Route::resource('employees', EmployeeController::class);
    Route::post('/employees/evaluation', [EmployeeController::class, 'evaluate'])->name('employees.evaluation');

    Route::get('/chart2', [EmployeeController::class, 'chart2'])->name('employees.chart2');

    Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/export', [ReporteExportController::class, 'export'])->name('reportes.export');

    
    Route::get('/agua', [AguaController::class, 'index'])->name('agua.index');

});

require __DIR__.'/auth.php';
