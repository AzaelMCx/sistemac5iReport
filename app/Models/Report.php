<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'camera_id', 
        'description', 
        'status', 
        'report_date'
    ];

    /**
     * Relación: Un reporte pertenece a una cámara
     */
    public function camera()
    {
        return $this->belongsTo(Camera::class);
    }

    /**
     * Obtener el estatus del reporte en un formato legible
     * Ejemplo: "Pendiente" o "Solucionado"
     */
    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Formatear la fecha del reporte
     * Ejemplo: 01-10-2024
     */
    public function getReportDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }
}
