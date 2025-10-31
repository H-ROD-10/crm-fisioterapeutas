<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalService extends Model
{
    /** @use HasFactory<\Database\Factories\MedicalServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'duration',
    ];

    // Accessors
    
    /**
     * Obtener la URL completa de la imagen
     */
    public function getImageAttribute($value)
    {
        if (!$value) {
            return null;
        }
        
        // Si ya es una URL completa, devolverla tal como está
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        
        // Si es una ruta relativa, convertirla a URL completa
        return asset('storage/' . $value);
    }

    // Relaciones

    /**
     * Un Servicio Médico puede ser usado en muchas Sesiones (relación muchos a muchos)
     */
    public function sessions()
    {
        return $this->belongsToMany(SessionTherapy::class, 'session_service', 'medical_service_id', 'session_therapy_id')
                    ->withTimestamps();
    }
}
