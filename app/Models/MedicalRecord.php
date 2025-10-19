<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    /** @use HasFactory<\Database\Factories\MedicalRecordFactory> */
    use HasFactory;

    protected $fillable = [
        'allergies',
        'pathologies',
        'medications',
        'past_surgeries',
        'notes_general',
        'patient_id',
        'fisioterapeuta_id',
    ];

    /**
     * Obtener el título descriptivo del historial médico
     */
    public function getTitleAttribute(): string
    {
        $patientName = $this->patient 
            ? $this->patient->name . ' ' . $this->patient->last_name 
            : 'Sin paciente';
        
        return "Historial Médico: {$patientName}";
    }

    // Relaciones

    /**
     * El Historial Médico pertenece a un Paciente
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * El Historial Médico es gestionado por un Fisioterapeuta
     */
    public function fisioterapeuta()
    {
        return $this->belongsTo(User::class, 'fisioterapeuta_id');
    }
}
