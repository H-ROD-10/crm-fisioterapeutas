<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appoinment extends Model
{
    /** @use HasFactory<\Database\Factories\AppoinmentFactory> */
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'status',
        'patient_id',
        'fisioterapeuta_id',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];
    }

    /**
     * Obtener el título descriptivo de la cita
     */
    public function getTitleAttribute(): string
    {
        $patientName = $this->patient ? $this->patient->name . ' ' . $this->patient->last_name : 'Sin paciente';
        $date = $this->start_time ? $this->start_time->format('d/m/Y H:i') : '';
        return "{$patientName} - {$date}";
    }

    // Relaciones

    /**
     * Una Cita pertenece a un Paciente
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Una Cita es realizada por un Fisioterapeuta
     */
    public function fisioterapeuta()
    {
        return $this->belongsTo(User::class, 'fisioterapeuta_id');
    }

    /**
     * Una Cita puede dar lugar a una Sesión (relación 1:1)
     */
    public function session()
    {
        return $this->hasOne(SessionTherapy::class, 'appointment_id');
    }
}
