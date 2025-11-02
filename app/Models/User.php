<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Accessors
    
    /**
     * Obtener la URL completa de la foto
     */
    public function getPhotoAttribute($value)
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
     * Un Fisioterapeuta puede tener muchos Pacientes asignados
     */
    public function patients()
    {
        return $this->hasMany(Patient::class, 'fisioterapeuta_id');
    }

    /**
     * Un Fisioterapeuta realiza muchas Citas
     */
    public function appointments()
    {
        return $this->hasMany(Appoinment::class, 'fisioterapeuta_id');
    }

    /**
     * Un Fisioterapeuta puede gestionar muchos Historiales Médicos
     */
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'fisioterapeuta_id');
    }

    /**
     * Un Fisioterapeuta puede gestionar muchos Tratamientos
     */
    public function treatments()
    {
        return $this->hasMany(Treatment::class, 'fisioterapeuta_id');
    }

    // Métodos de disponibilidad

    /**
     * Verificar si el fisioterapeuta está disponible en un horario específico
     */
    public function isAvailableAt(\Carbon\Carbon $startTime, int $durationMinutes = 60, ?int $excludeAppointmentId = null): bool
    {
        return Appoinment::isTimeSlotAvailable($this->id, $startTime, $durationMinutes, $excludeAppointmentId);
    }

    /**
     * Obtener citas del fisioterapeuta para una fecha específica
     */
    public function getAppointmentsForDate(\Carbon\Carbon $date)
    {
        return $this->appointments()
            ->forDate($date)
            ->active()
            ->orderBy('start_time')
            ->with(['patient', 'medicalService'])
            ->get();
    }

    /**
     * Obtener horarios disponibles para una fecha específica
     */
    public function getAvailableTimeSlotsForDate(\Carbon\Carbon $date, int $durationMinutes = 60, array $workingHours = ['09:00', '18:00'], int $slotInterval = 30): array
    {
        return Appoinment::getAvailableTimeSlots($this->id, $date, $durationMinutes, $workingHours, $slotInterval);
    }

    /**
     * Verificar si tiene conflictos en un rango de tiempo
     */
    public function hasConflictInTimeRange(\Carbon\Carbon $startTime, \Carbon\Carbon $endTime, ?int $excludeAppointmentId = null): bool
    {
        return Appoinment::hasTimeConflict($this->id, $startTime, $endTime, $excludeAppointmentId);
    }

    /**
     * Obtener citas que se solapan con un horario dado
     */
    public function getConflictingAppointments(\Carbon\Carbon $startTime, \Carbon\Carbon $endTime, ?int $excludeAppointmentId = null)
    {
        return Appoinment::getConflictingAppointments($this->id, $startTime, $endTime, $excludeAppointmentId);
    }

    /**
     * Obtener el próximo slot disponible después de una fecha/hora dada
     */
    public function getNextAvailableSlot(\Carbon\Carbon $afterDateTime, int $durationMinutes = 60, array $workingHours = ['09:00', '18:00']): ?\Carbon\Carbon
    {
        $currentDate = $afterDateTime->copy()->startOfDay();
        $maxDaysToCheck = 30; // Buscar hasta 30 días en el futuro
        
        for ($i = 0; $i < $maxDaysToCheck; $i++) {
            $checkDate = $currentDate->copy()->addDays($i);
            
            // Saltar fines de semana (opcional)
            if ($checkDate->isWeekend()) {
                continue;
            }
            
            $availableSlots = $this->getAvailableTimeSlotsForDate($checkDate, $durationMinutes, $workingHours);
            
            foreach ($availableSlots as $slot) {
                $slotDateTime = \Carbon\Carbon::parse($slot['datetime']);
                
                // Si es el mismo día, asegurar que sea después de la hora especificada
                if ($checkDate->isSameDay($afterDateTime) && $slotDateTime->lte($afterDateTime)) {
                    continue;
                }
                
                return $slotDateTime;
            }
        }
        
        return null; // No hay slots disponibles en los próximos 30 días
    }

    // Scopes

    /**
     * Scope para obtener fisioterapeutas disponibles en un horario específico
     */
    public function scopeAvailableAt($query, \Carbon\Carbon $startTime, int $durationMinutes = 60)
    {
        $endTime = (clone $startTime)->addMinutes($durationMinutes);
        
        return $query->whereDoesntHave('appointments', function ($appointmentQuery) use ($startTime, $endTime) {
            $appointmentQuery->where('status', '!=', 'cancelled')
                ->where('start_time', '<', $endTime)
                ->where('end_time', '>', $startTime);
        });
    }

    /**
     * Scope para fisioterapeutas (usuarios con rol de fisioterapeuta)
     */
    public function scopeFisioterapeutas($query)
    {
        return $query->whereHas('roles', function ($roleQuery) {
            $roleQuery->where('name', 'fisioterapeuta');
        });
    }
}
