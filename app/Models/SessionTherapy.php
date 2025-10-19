<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionTherapy extends Model
{
    /** @use HasFactory<\Database\Factories\SessionTherapyFactory> */
    use HasFactory;

    protected $table = 'sessions_therapy';

    protected $fillable = [
        'treatment_id',
        'appointment_id',
        'session_date',
        'subjective_data',
        'objective_data',
        'assessment',
        'treatment_applied',
        'homework_recommendations',
        'duration_minutes',
    ];

    protected function casts(): array
    {
        return [
            'session_date' => 'datetime',
        ];
    }

    /**
     * Obtener el título descriptivo de la sesión
     */
    public function getTitleAttribute(): string
    {
        $patientName = $this->treatment?->patient 
            ? $this->treatment->patient->name . ' ' . $this->treatment->patient->last_name 
            : 'Sin paciente';
        $date = $this->session_date?->format('d/m/Y') ?? '';
        $treatmentName = $this->treatment?->name ?? 'Sin tratamiento';
        
        return "Sesión: {$patientName} - {$treatmentName} ({$date})";
    }

    // Relaciones

    /**
     * Una Sesión pertenece a un Tratamiento
     */
    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }

    /**
     * Una Sesión está asociada a una única Cita
     */
    public function appointment()
    {
        return $this->belongsTo(Appoinment::class, 'appointment_id');
    }

    /**
     * Una Sesión puede involucrar varios Servicios Médicos (relación muchos a muchos)
     */
    public function services()
    {
        return $this->belongsToMany(MedicalService::class, 'session_service')
                    ->withTimestamps();
    }
}
