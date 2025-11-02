<?php

namespace App\Http\Requests;

use App\Models\Appoinment;
use App\Models\MedicalService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => [
                'required',
                'integer',
                Rule::exists('medical_services', 'id')
            ],
            'employee_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id'),
                function ($attribute, $value, $fail) {
                    // Verificar que el usuario tenga rol de fisioterapeuta
                    $user = User::find($value);
                    if (!$user || !$user->hasRole('fisioterapeuta')) {
                        $fail('El profesional seleccionado no es válido.');
                    }
                }
            ],
            'date' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    // No permitir citas en fines de semana (opcional)
                    $date = Carbon::parse($value);
                    if ($date->isWeekend()) {
                        $fail('No se pueden programar citas los fines de semana.');
                    }
                }
            ],
            'time_slot' => [
                'required',
                'regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/',
                function ($attribute, $value, $fail) {
                    if (!$this->validateTimeSlot()) {
                        $fail('El horario seleccionado no está disponible.');
                    }
                }
            ],
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'dni' => 'required|string|max:20',
            'comments' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Validar que el slot de tiempo esté disponible
     */
    protected function validateTimeSlot(): bool
    {
        $employeeId = $this->input('employee_id');
        $date = $this->input('date');
        $timeSlot = $this->input('time_slot');
        $serviceId = $this->input('service_id');

        if (!$employeeId || !$date || !$timeSlot || !$serviceId) {
            return false;
        }

        try {
            // Obtener la duración del servicio
            $service = MedicalService::find($serviceId);
            if (!$service) {
                return false;
            }

            // Crear el datetime de inicio
            $startTime = Carbon::parse($date . ' ' . $timeSlot);
            
            // Verificar que no sea en el pasado
            if ($startTime->isPast()) {
                return false;
            }

            // Verificar que esté dentro del horario laboral (9:00 - 18:00)
            $hour = $startTime->hour;
            $minute = $startTime->minute;
            if ($hour < 9 || $hour >= 18 || ($hour == 17 && $minute > 30)) {
                return false;
            }

            // Verificar disponibilidad del fisioterapeuta
            $fisioterapeuta = User::find($employeeId);
            if (!$fisioterapeuta) {
                return false;
            }

            return $fisioterapeuta->isAvailableAt($startTime, $service->duration ?? 60);

        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'service_id.required' => 'Debe seleccionar un servicio.',
            'service_id.exists' => 'El servicio seleccionado no es válido.',
            'employee_id.required' => 'Debe seleccionar un fisioterapeuta.',
            'employee_id.exists' => 'El fisioterapeuta seleccionado no es válido.',
            'date.required' => 'Debe seleccionar una fecha.',
            'date.date' => 'La fecha debe ser válida.',
            'date.after_or_equal' => 'La fecha no puede ser anterior a hoy.',
            'time_slot.required' => 'Debe seleccionar un horario.',
            'time_slot.regex' => 'El formato del horario debe ser HH:MM.',
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede exceder 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe proporcionar un correo electrónico válido.',
            'phone.required' => 'El teléfono es obligatorio.',
            'dni.required' => 'El DNI es obligatorio.',
            'comments.max' => 'Los comentarios no pueden exceder 1000 caracteres.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'service_id' => 'servicio',
            'employee_id' => 'fisioterapeuta',
            'date' => 'fecha',
            'time_slot' => 'horario',
            'name' => 'nombre',
            'email' => 'correo electrónico',
            'phone' => 'teléfono',
            'dni' => 'DNI',
            'comments' => 'comentarios',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        if ($this->expectsJson()) {
            $response = response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);

            throw new \Illuminate\Validation\ValidationException($validator, $response);
        }

        parent::failedValidation($validator);
    }
}
