<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    /**
     * Muestra el dashboard con las cámaras existentes.
     */
    public function index()
    {
        // Obtener todas las cámaras de la base de datos
        $cameras = Camera::all();

        // Pasar las cámaras a la vista 'dashboard'
        return view('dashboard', compact('cameras'));
    }

    /**
     * Almacena una nueva cámara en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => 'required|string|max:50',
        ]);

        // Crear una nueva cámara con los datos del formulario
        Camera::create($request->all());

        // Redirigir a la vista de dashboard con un mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Cámara agregada correctamente.');
    }

    /**
     * Actualiza la información de una cámara existente.
     */
    public function update(Request $request, Camera $camera)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => 'required|string|max:50',
        ]);

        // Actualizar los datos de la cámara
        $camera->update($request->all());

        // Devolver una respuesta JSON con el éxito de la operación
        return response()->json(['message' => 'Cámara actualizada correctamente.']);
    }

    /**
     * Elimina una cámara de la base de datos.
     */
    public function destroy(Camera $camera)
    {
        // Eliminar la cámara
        $camera->delete();

        // Devolver una respuesta JSON con el éxito de la operación
        return response()->json(['message' => 'Cámara eliminada correctamente.']);
    }
}
