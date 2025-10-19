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
