<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use HasFactory;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'name', 
        'latitude', 
        'longitude', 
        'status'
    ];

    /**
     * Relación: Una cámara tiene muchos reportes
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Obtener el estatus de la cámara en un formato legible
     * Ejemplo: "Activa" o "Inactiva"
     */
    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Obtener la información de la cámara en formato legible.
     * Ejemplo: "Cámara 1 (19.12345, -98.12345)"
     */
    public function getCameraInfoAttribute()
    {
        return $this->name . ' (' . $this->latitude . ', ' . $this->longitude . ')';
    }
}
