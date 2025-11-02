<?php

namespace App\Rules;

use App\Models\MedicalService;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AvailableTimeSlot implements ValidationRule
{
    protected int $employeeId;
    protected string $date;
    protected int $serviceId;
    protected ?int $excludeAppointmentId;

    public function __construct(int $employeeId, string $date, int $serviceId, ?int $excludeAppointmentId = null)
    {
        $this->employeeId = $employeeId;
        $this->date = $date;
        $this->serviceId = $serviceId;
        $this->excludeAppointmentId = $excludeAppointmentId;
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            // Verificar que el tiempo tenga formato válido
            if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $value)) {
                $fail('El formato del horario debe ser HH:MM.');
                return;
            }

            // Obtener el servicio y su duración
            $service = MedicalService::find($this->serviceId);
            if (!$service) {
                $fail('El servicio seleccionado no es válido.');
                return;
            }

            // Crear el datetime de inicio
            $startTime = Carbon::parse($this->date . ' ' . $value);
            
            // Verificar que no sea en el pasado
            if ($startTime->isPast()) {
                $fail('No se pueden programar citas en el pasado.');
                return;
            }

            // Verificar horario laboral
            $hour = $startTime->hour;
            $minute = $startTime->minute;
            
            if ($hour < 9) {
                $fail('Las citas no pueden ser antes de las 9:00 AM.');
                return;
            }
            
            if ($hour >= 18) {
                $fail('Las citas no pueden ser después de las 6:00 PM.');
                return;
            }
            
            // Verificar que la cita termine antes del cierre
            $endTime = (clone $startTime)->addMinutes($service->duration ?? 60);
            if ($endTime->hour > 18) {
                $fail('La cita se extiende más allá del horario laboral.');
                return;
            }

            // Verificar disponibilidad del fisioterapeuta
            $fisioterapeuta = User::find($this->employeeId);
            if (!$fisioterapeuta) {
                $fail('El fisioterapeuta seleccionado no es válido.');
                return;
            }

            if (!$fisioterapeuta->isAvailableAt($startTime, $service->duration ?? 60, $this->excludeAppointmentId)) {
                // Obtener citas conflictivas para dar más información
                $conflicts = $fisioterapeuta->getConflictingAppointments(
                    $startTime, 
                    $endTime, 
                    $this->excludeAppointmentId
                );
                
                if ($conflicts->isNotEmpty()) {
                    $conflictTime = $conflicts->first()->start_time->format('H:i');
                    $fail("El horario seleccionado no está disponible. Hay una cita programada a las {$conflictTime}.");
                } else {
                    $fail('El horario seleccionado no está disponible.');
                }
                return;
            }

        } catch (\Exception $e) {
            $fail('Error al validar la disponibilidad del horario.');
        }
    }
}
