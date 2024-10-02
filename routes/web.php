<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta para el dashboard (protegido por autenticación y verificación de email)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Agrupar rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // Ruta para el dashboard, utilizando el método 'index' del CameraController
    Route::get('/dashboard', [CameraController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


    // Rutas para la edición de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para cámaras
    

    Route::get('/cameras', [CameraController::class, 'index'])->name('cameras.index'); // Mostrar cámaras
    Route::post('/cameras', [CameraController::class, 'store'])->name('cameras.store'); // Guardar cámaras
    Route::put('/cameras/{id}', [CameraController::class, 'update'])->name('cameras.update'); // Actualizar cámara
    Route::delete('/cameras/{id}', [CameraController::class, 'destroy'])->name('cameras.destroy'); // Eliminar cámara

    // Rutas para reportes
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create'); // Formulario de creación de reporte
    Route::post('/reports/store', [ReportController::class, 'store'])->name('reports.store'); // Guardar reportes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index'); // Mostrar todos los reportes
    Route::put('/reports/{id}', [ReportController::class, 'update'])->name('reports.update'); // Actualizar reporte
    Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.destroy'); // Eliminar reporte
});

// Archivo que contiene las rutas de autenticación (login, registro, etc.)
require __DIR__.'/auth.php';
