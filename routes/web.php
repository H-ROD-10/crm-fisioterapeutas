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
    
    // Get available time slots for a specific date
    Route::get('/available-time-slots', function () {
        $date = request('date');
        $employeeId = request('employee_id');
        $serviceId = request('service_id');
        
        // Generate time slots from 9:00 to 18:00 every 30 minutes
        $slots = [];
        $start = 9;
        $end = 18;
        
        for ($hour = $start; $hour < $end; $hour++) {
            $slots[] = sprintf('%02d:00', $hour);
            $slots[] = sprintf('%02d:30', $hour);
        }
        
        return response()->json($slots);
    })->name('available_time_slots');
    
    // Save booking
    Route::post('/save-booking', function () {
        $data = request()->validate([
            'service_id' => 'required|exists:medical_services,id',
            'employee_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => 'required',
            'patient_name' => 'required|string',
            'patient_email' => 'required|email',
            'patient_phone' => 'required|string',
            'notes' => 'nullable|string',
        ]);
        
        // Crear o encontrar paciente
        $patient = \App\Models\Patient::firstOrCreate(
            ['email' => $data['patient_email']],
            [
                'name' => $data['patient_name'],
                'phone' => $data['patient_phone'],
                'fisioterapeuta_id' => $data['employee_id'],
            ]
        );
        
        // Crear cita
        $appointment = \App\Models\Appoinment::create([
            'patient_id' => $patient->id,
            'fisioterapeuta_id' => $data['employee_id'],
            'medical_service_id' => $data['service_id'],
            'appointment_date' => $data['date'],
            'appointment_time' => $data['time'],
            'status' => 'pending',
            'notes' => $data['notes'] ?? null,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Cita reservada exitosamente',
            'appointment_id' => $appointment->id,
        ]);
    })->name('save_booking');
});
