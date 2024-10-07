<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Camera;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Mostrar formulario de creación de reportes con cámaras disponibles
    public function create()
    {
        // Obtener todas las cámaras para el dropdown en el formulario
        $cameras = Camera::all();
        
        // Retornar la vista de creación de reportes con las cámaras
        return view('dashboard', compact('cameras'));
    }

    // Guardar el reporte en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'camera_id' => 'required|exists:cameras,id',
            'description' => 'required|string',
            'status' => 'required|in:Pendiente,Solucionado',
            'report_date' => 'required|date',
        ]);

        // Crear el reporte y guardarlo en la base de datos
        Report::create([
            'camera_id' => $request->camera_id,
            'description' => $request->description,
            'status' => $request->status,
            'report_date' => $request->report_date,
        ]);

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->back()->with('message', 'Reporte guardado correctamente.');
    }

    // Mostrar todos los reportes en el dashboard
    public function index()
    {
        // Obtener todos los reportes junto con las cámaras asociadas
        $reports = Report::with('camera')->get();
        
        // Retornar la vista de dashboard con los reportes
        return view('dashboard', compact('reports'));
    }

    // Mostrar listado de cámaras con reportes
    public function camerasWithReports()
    {
        // Obtener cámaras que tienen reportes
        $cameras = Camera::has('reports')->with('reports')->get();
        //dd($cameras);
        // Retornar la vista con las cámaras
        return view('cameras_with_reports', compact('cameras'));
    }
}
