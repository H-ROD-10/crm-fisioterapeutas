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
        'medical_service_id',
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
     * Una Cita pertenece a un Servicio Médico
     */
    public function medicalService()
    {
        return $this->belongsTo(MedicalService::class, 'medical_service_id');
    }

    /**
     * Una Cita puede dar lugar a una Sesión (relación 1:1)
     */
    public function session()
    {
        return $this->hasOne(SessionTherapy::class, 'appointment_id');
    }

    // Métodos de validación de disponibilidad

    /**
     * Verificar si existe conflicto de horarios para un fisioterapeuta
     */
    public static function hasTimeConflict(int $fisioterapeutaId, \Carbon\Carbon $startTime, \Carbon\Carbon $endTime, ?int $excludeAppointmentId = null): bool
    {
        $query = static::where('fisioterapeuta_id', $fisioterapeutaId)
            ->where('status', '!=', 'cancelled')
            ->where(function ($q) use ($startTime, $endTime) {
                // Verificar solapamientos:
                // 1. La nueva cita empieza antes de que termine una existente Y termina después de que empiece una existente
                $q->where(function ($subQ) use ($startTime, $endTime) {
                    $subQ->where('start_time', '<', $endTime)
                         ->where('end_time', '>', $startTime);
                });
            });

        if ($excludeAppointmentId) {
            $query->where('id', '!=', $excludeAppointmentId);
        }

        return $query->exists();
    }

    /**
     * Obtener citas que se solapan con el horario dado
     */
    public static function getConflictingAppointments(int $fisioterapeutaId, \Carbon\Carbon $startTime, \Carbon\Carbon $endTime, ?int $excludeAppointmentId = null)
    {
        $query = static::where('fisioterapeuta_id', $fisioterapeutaId)
            ->where('status', '!=', 'cancelled')
            ->where(function ($q) use ($startTime, $endTime) {
                $q->where('start_time', '<', $endTime)
                  ->where('end_time', '>', $startTime);
            })
            ->with(['patient', 'medicalService']);

        if ($excludeAppointmentId) {
            $query->where('id', '!=', $excludeAppointmentId);
        }

        return $query->get();
    }

    /**
     * Verificar disponibilidad para una fecha y hora específica
     */
    public static function isTimeSlotAvailable(int $fisioterapeutaId, \Carbon\Carbon $startTime, int $durationMinutes = 60, ?int $excludeAppointmentId = null): bool
    {
        $endTime = (clone $startTime)->addMinutes($durationMinutes);
        return !static::hasTimeConflict($fisioterapeutaId, $startTime, $endTime, $excludeAppointmentId);
    }

    /**
     * Obtener horarios disponibles para un día específico
     */
    public static function getAvailableTimeSlots(int $fisioterapeutaId, \Carbon\Carbon $date, int $durationMinutes = 60, array $workingHours = ['09:00', '18:00'], int $slotInterval = 30): array
    {
        $availableSlots = [];
        $startHour = \Carbon\Carbon::parse($workingHours[0]);
        $endHour = \Carbon\Carbon::parse($workingHours[1]);
        
        // Crear slots cada $slotInterval minutos
        $currentSlot = $date->copy()->setTime($startHour->hour, $startHour->minute);
        $dayEnd = $date->copy()->setTime($endHour->hour, $endHour->minute);
        
        while ($currentSlot->addMinutes($durationMinutes)->lte($dayEnd)) {
            $slotStart = $currentSlot->copy()->subMinutes($durationMinutes);
            
            // Verificar si el slot está disponible
            if (static::isTimeSlotAvailable($fisioterapeutaId, $slotStart, $durationMinutes)) {
                $availableSlots[] = [
                    'time' => $slotStart->format('H:i'),
                    'datetime' => $slotStart->toISOString(),
                    'available' => true
                ];
            }
            
            $currentSlot->addMinutes($slotInterval);
        }
        
        return $availableSlots;
    }

    // Scopes

    /**
     * Scope para filtrar citas por fisioterapeuta
     */
    public function scopeForFisioterapeuta($query, int $fisioterapeutaId)
    {
        return $query->where('fisioterapeuta_id', $fisioterapeutaId);
    }

    /**
     * Scope para filtrar citas por fecha
     */
    public function scopeForDate($query, \Carbon\Carbon $date)
    {
        return $query->whereDate('start_time', $date->format('Y-m-d'));
    }

    /**
     * Scope para filtrar citas activas (no canceladas)
     */
    public function scopeActive($query)
    {
        return $query->where('status', '!=', 'cancelled');
    }
}
