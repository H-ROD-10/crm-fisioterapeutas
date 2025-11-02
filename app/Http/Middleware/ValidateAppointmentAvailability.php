<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\MedicalService;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateAppointmentAvailability
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Solo aplicar a rutas de creación/actualización de citas
        if (!$this->shouldValidate($request)) {
            return $next($request);
        }

        $employeeId = $request->input('employee_id') ?? $request->input('fisioterapeuta_id');
        $serviceId = $request->input('service_id') ?? $request->input('medical_service_id');
        $date = $request->input('date');
        $timeSlot = $request->input('time_slot');
        $appointmentId = $request->route('appointment') ?? $request->input('appointment_id');

        // Si no tenemos los datos necesarios, continuar (las validaciones del FormRequest se encargarán)
        if (!$employeeId || !$serviceId || !$date || !$timeSlot) {
            return $next($request);
        }

        try {
            $fisioterapeuta = User::find($employeeId);
            $service = MedicalService::find($serviceId);
            
            if (!$fisioterapeuta || !$service) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fisioterapeuta o servicio no válido',
                    'error_code' => 'INVALID_RESOURCE'
                ], 400);
            }

            $startTime = Carbon::parse($date . ' ' . $timeSlot);
            $duration = $service->duration ?? 60;
            
            // Verificar disponibilidad
            if (!$fisioterapeuta->isAvailableAt($startTime, $duration, $appointmentId)) {
                $endTime = $startTime->copy()->addMinutes($duration);
                $conflicts = $fisioterapeuta->getConflictingAppointments($startTime, $endTime, $appointmentId);
                
                return response()->json([
                    'success' => false,
                    'message' => 'El horario seleccionado no está disponible',
                    'error_code' => 'TIME_SLOT_UNAVAILABLE',
                    'conflicts' => $conflicts->map(function($appointment) {
                        return [
                            'id' => $appointment->id,
                            'start_time' => $appointment->start_time->format('H:i'),
                            'end_time' => $appointment->end_time->format('H:i'),
                            'patient' => $appointment->patient->name ?? 'Paciente',
                            'service' => $appointment->medicalService->name ?? 'Servicio'
                        ];
                    }),
                    'suggestions' => $this->getAlternativeTimeSlots($fisioterapeuta, $startTime, $duration)
                ], 409);
            }

        } catch (\Exception $e) {
            \Log::error('Error en ValidateAppointmentAvailability middleware', [
                'error' => $e->getMessage(),
                'request_data' => $request->only(['employee_id', 'service_id', 'date', 'time_slot'])
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error interno al validar disponibilidad',
                'error_code' => 'VALIDATION_ERROR'
            ], 500);
        }

        return $next($request);
    }

    /**
     * Determinar si se debe validar la disponibilidad
     */
    protected function shouldValidate(Request $request): bool
    {
        $route = $request->route();
        
        if (!$route) {
            return false;
        }

        $routeName = $route->getName();
        $method = $request->getMethod();
        
        // Validar en rutas específicas
        $validationRoutes = [
            'public.save_booking',
            'booking.store',
            'appointments.store',
            'appointments.update'
        ];

        return in_array($routeName, $validationRoutes) || 
               ($method === 'POST' && str_contains($request->path(), 'appointment')) ||
               ($method === 'PUT' && str_contains($request->path(), 'appointment'));
    }

    /**
     * Obtener sugerencias de horarios alternativos
     */
    protected function getAlternativeTimeSlots(User $fisioterapeuta, Carbon $preferredTime, int $duration): array
    {
        $suggestions = [];
        $date = $preferredTime->copy()->startOfDay();
        
        // Buscar en el mismo día
        $sameDaySlots = $fisioterapeuta->getAvailableTimeSlotsForDate($date, $duration);
        
        // Filtrar slots que sean después del horario preferido
        $laterSlots = array_filter($sameDaySlots, function($slot) use ($preferredTime) {
            $slotTime = Carbon::parse($slot['datetime']);
            return $slotTime->gt($preferredTime);
        });
        
        if (!empty($laterSlots)) {
            $suggestions[] = [
                'type' => 'same_day',
                'date' => $date->format('Y-m-d'),
                'date_formatted' => $date->format('d/m/Y'),
                'slots' => array_slice($laterSlots, 0, 3) // Máximo 3 sugerencias
            ];
        }
        
        // Buscar en los próximos 3 días laborables
        for ($i = 1; $i <= 3; $i++) {
            $nextDate = $date->copy()->addDays($i);
            
            // Saltar fines de semana
            if ($nextDate->isWeekend()) {
                continue;
            }
            
            $nextDaySlots = $fisioterapeuta->getAvailableTimeSlotsForDate($nextDate, $duration);
            
            if (!empty($nextDaySlots)) {
                $suggestions[] = [
                    'type' => 'next_days',
                    'date' => $nextDate->format('Y-m-d'),
                    'date_formatted' => $nextDate->format('d/m/Y'),
                    'slots' => array_slice($nextDaySlots, 0, 3)
                ];
            }
            
            // Máximo 2 días de sugerencias
            if (count($suggestions) >= 2) {
                break;
            }
        }
        
        return $suggestions;
    }
}
