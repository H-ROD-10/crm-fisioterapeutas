<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Landing\FeatureController;
use App\Http\Controllers\Landing\LegalController;
use App\Http\Controllers\Landing\BookingController;

// Landing principal (reemplaza welcome)
Route::get('/', [LandingController::class, 'index'])->name('landing.home');
Route::get('/demo', function () {
    $services = \App\Models\MedicalService::all();
    return view('landing.pages.fisioalcoy-demo', compact('services'));
})->name('landing.demo');

// Features
Route::prefix('features')->name('features.')->group(function () {
    Route::get('/appointments', [FeatureController::class, 'appointments'])->name('appointments');
    Route::get('/billing', [FeatureController::class, 'billing'])->name('billing');
    Route::get('/clinical-history', [FeatureController::class, 'clinicalHistory'])->name('clinical-history');
    Route::get('/marketing', [FeatureController::class, 'marketing'])->name('marketing');
    Route::get('/virtual-assistant', [FeatureController::class, 'virtualAssistant'])->name('virtual-assistant');
    Route::get('/ai-phone', [FeatureController::class, 'aiPhone'])->name('ai-phone');
    Route::get('/ai-calls', [FeatureController::class, 'aiCalls'])->name('ai-calls');
    Route::get('/reminders', [FeatureController::class, 'reminders'])->name('reminders');
    Route::get('/whatsapp-bot', [FeatureController::class, 'whatsappBot'])->name('whatsapp-bot');
    Route::get('/smart-transcription', [FeatureController::class, 'smartTranscription'])->name('smart-transcription');
});

// Legal
Route::prefix('legal')->name('legal.')->group(function () {
    Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
    Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');
    Route::get('/cookies', [LegalController::class, 'cookies'])->name('cookies');
});

// Booking
Route::prefix('booking')->name('booking.')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('index');
    Route::post('/store', [BookingController::class, 'store'])->name('store');
    Route::get('/confirmation/{id}', [BookingController::class, 'confirmation'])->name('confirmation');
});

Route::get('/fisioalcoy-demo', function () {
    $services = \App\Models\MedicalService::all();
    return view('landing.pages.fisioalcoy-demo', compact('services'));
})->name('fisioalcoy.demo');

// Public API for Booking Widget
Route::prefix('api/public')->name('public.')->group(function () {
    // Get users (employees) by service
    Route::get('/employees-by-service/{serviceId?}', function ($serviceId = null) {
        $users = \App\Models\User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['fisioterapeuta', 'admin']);
        })->get(['id', 'name', 'email']);
        
        return response()->json($users);
    })->name('employees_by_service');
    
    // Get available dates for a service and employee
    Route::get('/available-dates', function () {
        $serviceId = request('service_id');
        $employeeId = request('employee_id');
        
        // Generate next 30 days as available dates
        $dates = [];
        for ($i = 1; $i <= 30; $i++) {
            $date = now()->addDays($i);
            if ($date->isWeekday()) { // Solo días laborables
                $dates[] = $date->format('Y-m-d');
            }
        }
        
        return response()->json($dates);
    })->name('available_dates');
    
    // Get available time slots for a specific date with real availability check
    Route::get('/available-time-slots', function () {
        $date = request('date');
        $employeeId = request('employee_id');
        $serviceId = request('service_id');
        
        if (!$employeeId || !$serviceId || !$date) {
            return response()->json([
                'success' => false,
                'message' => 'Parámetros requeridos: employee_id, service_id, date'
            ], 400);
        }

        try {
            $fisioterapeuta = \App\Models\User::find($employeeId);
            $service = \App\Models\MedicalService::find($serviceId);
            $dateCarbon = \Carbon\Carbon::parse($date);
            
            if (!$fisioterapeuta || !$service) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fisioterapeuta o servicio no válido'
                ], 400);
            }

            $availableSlots = $fisioterapeuta->getAvailableTimeSlotsForDate(
                $dateCarbon, 
                $service->duration ?? 60
            );
            
            return response()->json([
                'success' => true,
                'slots' => $availableSlots,
                'date' => $date,
                'employee' => $fisioterapeuta->name,
                'service' => $service->name
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener horarios disponibles'
            ], 500);
        }
    })->name('available_time_slots');
    
    // Save booking with validation
    Route::post('/save-booking', function (\App\Http\Requests\CreateAppointmentRequest $request) {
        try {
            $data = $request->validated();

            $service = \App\Models\MedicalService::findOrFail($data['service_id']);
            $start = \Carbon\Carbon::parse($data['date'].' '.$data['time_slot']);
            $end = (clone $start)->addMinutes($service->duration ?? 60);
            
            // Verificar disponibilidad una vez más antes de crear
            $fisioterapeuta = \App\Models\User::findOrFail($data['employee_id']);
            if (!$fisioterapeuta->isAvailableAt($start, $service->duration ?? 60)) {
                return response()->json([
                    'success' => false,
                    'message' => 'El horario seleccionado ya no está disponible. Por favor, seleccione otro horario.',
                    'conflicts' => $fisioterapeuta->getConflictingAppointments($start, $end)->map(function($appointment) {
                        return [
                            'start_time' => $appointment->start_time->format('H:i'),
                            'end_time' => $appointment->end_time->format('H:i'),
                            'patient' => $appointment->patient->name ?? 'Paciente',
                            'service' => $appointment->medicalService->name ?? 'Servicio'
                        ];
                    })
                ], 409);
            }
            
            // Crear o encontrar paciente por email
            $patient = \App\Models\Patient::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'dni' => $data['dni'],
                    'fisioterapeuta_id' => $data['employee_id'],
                ]
            );
            
            // Crear cita
            $appointment = \App\Models\Appoinment::create([
                'patient_id'         => $patient->id,
                'fisioterapeuta_id'  => $data['employee_id'],
                'medical_service_id' => $data['service_id'],
                'start_time'         => $start,
                'end_time'           => $end,
                'status'             => 'pending',
                'notes'              => $data['comments'] ?? null,
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Cita reservada exitosamente',
                'appointment_id' => $appointment->id,
                'appointment_details' => [
                    'date' => $start->format('d/m/Y'),
                    'time' => $start->format('H:i'),
                    'service' => $service->name,
                    'fisioterapeuta' => $fisioterapeuta->name,
                    'patient' => $patient->name
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la reserva: ' . $e->getMessage()
            ], 500);
        }
    })->name('save_booking');
});

// Agente de Reservas IA
Route::prefix('booking-agent')->name('booking-agent.')->group(function () {
    Route::post('/chat', [App\Http\Controllers\SimpleBookingAgentController::class, 'chat'])->name('chat');
});
