@props(['services' => collect(), 'compact' => false])
@php use Illuminate\Support\Str; @endphp

<div id="booking-wizard" 
     class="{{ $compact ? 'max-w-4xl' : 'max-w-6xl' }} mx-auto" 
     role="region" 
     aria-labelledby="wizard-title"
     data-employees-url="{{ route('public.employees_by_service') }}"
     data-dates-url="{{ route('public.available_dates') }}"
     data-times-url="{{ route('public.available_time_slots') }}">
    
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
        <div class="p-8">
            <h2 id="wizard-title" class="sr-only">Reserva de cita</h2>
            <div id="wizard-status" class="sr-only" aria-live="polite" role="status"></div>
            
            <!-- Step Indicators -->
            <div class="grid grid-cols-4 gap-4 mb-8">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold mb-2 step-circle" id="step1" aria-current="step">1</div>
                    <span class="text-sm font-medium text-gray-900 step-label">Tratamiento</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center font-bold mb-2 step-circle" id="step2">2</div>
                    <span class="text-sm font-medium text-gray-500 step-label">Fisioterapeuta</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center font-bold mb-2 step-circle" id="step3">3</div>
                    <span class="text-sm font-medium text-gray-500 step-label">Fecha y Hora</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center font-bold mb-2 step-circle" id="step4">4</div>
                    <span class="text-sm font-medium text-gray-500 step-label">Confirmar</span>
                </div>
            </div>

            <form id="booking-form" action="{{ route('public.save_booking') }}" method="POST">
                @csrf
                <input type="hidden" name="service_id" id="service_id">
                <input type="hidden" name="employee_id" id="employee_id">
                <input type="hidden" name="date" id="selected_date">
                <input type="hidden" name="time_slot" id="selected_time_slot">

                <!-- Paso 1: Selección de Servicio -->
                <div class="booking-step" id="booking-step-1" role="group" aria-labelledby="step1-title">
                    <h4 id="step1-title" class="text-2xl font-bold text-gray-900 mb-6" tabindex="-1">
                        {{ $compact ? 'Elige tu tratamiento' : 'Selecciona tu Tratamiento' }}
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        @foreach($services as $service)
                        <div class="service-card border-2 border-gray-200 rounded-xl p-6 cursor-pointer hover:border-emerald-500 hover:shadow-lg transition-all" 
                             role="button" 
                             tabindex="0" 
                             aria-label="Seleccionar tratamiento: {{ $service->name }}" 
                             data-service-id="{{ $service->id }}" 
                             data-service-duration="{{ $service->duration }}">
                            <h5 class="text-xl font-bold text-gray-900 mb-2">{{ $service->name }}</h5>
                            @if(!empty($service->description))
                                <p class="text-gray-600 mb-4 {{ $compact ? 'text-sm' : '' }}">
                                    {{ $compact ? Str::limit($service->description, 80) : $service->description }}
                                </p>
                            @endif
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">
                                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $service->duration }} min
                                </span>
                                <span class="text-xl font-bold text-emerald-600">{{ number_format($service->price, 2) }} €</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="px-8 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-all next-step disabled:opacity-50 disabled:cursor-not-allowed" data-next="2" disabled>
                            Continuar
                        </button>
                    </div>
                </div>

                <!-- Paso 2: Selección de Profesional -->
                <div class="booking-step hidden" id="booking-step-2" role="group" aria-labelledby="step2-title">
                    <h4 id="step2-title" class="text-2xl font-bold text-gray-900 mb-6" tabindex="-1">
                        {{ $compact ? 'Elige tu fisioterapeuta' : 'Selecciona tu Fisioterapeuta' }}
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6" id="employees-container">
                        <!-- Los empleados se cargarán dinámicamente aquí -->
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="px-8 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-all prev-step" data-prev="1">
                            Volver
                        </button>
                        <button type="button" class="px-8 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-all next-step disabled:opacity-50 disabled:cursor-not-allowed" data-next="3" disabled>
                            Continuar
                        </button>
                    </div>
                </div>

                <!-- Paso 3: Selección de Fecha y Hora -->
                <div class="booking-step hidden" id="booking-step-3" role="group" aria-labelledby="step3-title">
                    <h4 id="step3-title" class="text-2xl font-bold text-gray-900 mb-6" tabindex="-1">Seleccione Fecha y Hora</h4>
                    
                    <!-- Calendario -->
                    <div class="bg-white rounded-xl border border-gray-200 mb-6">
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <button type="button" class="p-2 hover:bg-gray-100 rounded-lg transition-all" id="prev-month" aria-label="Mes anterior">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <h5 class="text-xl font-bold text-gray-900" id="current-month-year"></h5>
                                <button type="button" class="p-2 hover:bg-gray-100 rounded-lg transition-all" id="next-month" aria-label="Mes siguiente">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <p id="calendar-instructions" class="sr-only">Usa los botones anterior y siguiente para cambiar de mes. Selecciona un día disponible del calendario.</p>
                            <div class="overflow-x-auto" aria-describedby="calendar-instructions">
                                <table class="w-full text-center">
                                    <thead>
                                        <tr class="text-sm font-semibold text-gray-600">
                                            <th class="py-2">Dom</th>
                                            <th class="py-2">Lun</th>
                                            <th class="py-2">Mar</th>
                                            <th class="py-2">Mié</th>
                                            <th class="py-2">Jue</th>
                                            <th class="py-2">Vie</th>
                                            <th class="py-2">Sáb</th>
                                        </tr>
                                    </thead>
                                    <tbody id="calendar-body">
                                        <!-- El calendario se generará dinámicamente aquí -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Horarios Disponibles -->
                    <div class="bg-white rounded-xl border border-gray-200">
                        <div class="p-4 border-b border-gray-200">
                            <h5 class="text-xl font-bold text-gray-900">Horarios Disponibles</h5>
                        </div>
                        <div class="p-4">
                            <div id="time-slots-container" aria-live="polite">
                                <p class="text-center text-gray-500">Seleccione una fecha para ver los horarios disponibles</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between mt-6">
                        <button type="button" class="px-8 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-all prev-step" data-prev="2">
                            Volver
                        </button>
                        <button type="button" class="px-8 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-all next-step disabled:opacity-50 disabled:cursor-not-allowed" data-next="4" disabled>
                            Continuar
                        </button>
                    </div>
                </div>

                <!-- Paso 4: Información del Cliente y Confirmación -->
                <div class="booking-step hidden" id="booking-step-4" role="group" aria-labelledby="step4-title">
                    <h4 id="step4-title" class="text-2xl font-bold text-gray-900 mb-6" tabindex="-1">Complete sus Datos</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre Completo</label>
                                <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" id="name" name="name" autocomplete="name" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                                <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" id="email" name="email" autocomplete="email" required>
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                                <input type="tel" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" id="phone" name="phone" inputmode="tel" autocomplete="tel" required>
                            </div>
                            <div>
                                <label for="comments" class="block text-sm font-medium text-gray-700 mb-2">Motivo de consulta / Síntomas</label>
                                <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" id="comments" name="comments" rows="4" aria-describedby="comments-help" placeholder="Describe brevemente tu dolencia o motivo de consulta"></textarea>
                                <small id="comments-help" class="text-sm text-gray-500 sr-only">Describe tu dolencia para que podamos preparar mejor la sesión.</small>
                            </div>
                        </div>
                        <div>
                            <div class="bg-gray-50 rounded-xl border border-gray-200 p-6">
                                <h5 class="text-xl font-bold text-gray-900 mb-4">Resumen de la Reserva</h5>
                                <div class="space-y-4">
                                    <div>
                                        <strong class="text-sm text-gray-600">Servicio:</strong>
                                        <p id="summary-service" class="text-gray-900 font-medium"></p>
                                    </div>
                                    <div>
                                        <strong class="text-sm text-gray-600">Profesional:</strong>
                                        <p id="summary-employee" class="text-gray-900 font-medium"></p>
                                    </div>
                                    <div>
                                        <strong class="text-sm text-gray-600">Fecha:</strong>
                                        <p id="summary-date" class="text-gray-900 font-medium"></p>
                                    </div>
                                    <div>
                                        <strong class="text-sm text-gray-600">Hora:</strong>
                                        <p id="summary-time" class="text-gray-900 font-medium"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-6">
                        <button type="button" class="px-8 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-all prev-step" data-prev="3">
                            Volver
                        </button>
                        <button type="submit" class="px-8 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-all transform hover:scale-105 shadow-lg">
                            Confirmar Reserva
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>