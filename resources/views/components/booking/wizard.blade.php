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
            <div class="grid grid-cols-5 gap-2 mb-8">
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
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center font-bold mb-2 step-circle" id="step5">5</div>
                    <span class="text-sm font-medium text-gray-500 step-label">¡Listo!</span>
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
                                <label for="dni" class="block text-sm font-medium text-gray-700 mb-2">DNI / Documento de Identidad</label>
                                <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" id="dni" name="dni" placeholder="12345678A" required>
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
                        <button type="submit" class="px-8 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-all transform hover:scale-105 shadow-lg" id="confirm-booking-btn">
                            <span class="btn-text">Confirmar Reserva</span>
                            <span class="btn-loading hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Procesando...
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Paso 5: Confirmación Exitosa -->
                <div class="booking-step hidden" id="booking-step-5" role="group" aria-labelledby="step5-title">
                    <div class="text-center py-12">
                        <div class="mx-auto flex items-center justify-center w-24 h-24 rounded-full bg-emerald-100 mb-6">
                            <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h4 id="step5-title" class="text-3xl font-bold text-gray-900 mb-4">¡Reserva Confirmada!</h4>
                        <p class="text-lg text-gray-600 mb-8">Tu cita ha sido reservada exitosamente. Recibirás un email de confirmación en breve.</p>
                        
                        <div class="bg-emerald-50 rounded-xl border border-emerald-200 p-6 mb-8 max-w-md mx-auto">
                            <h5 class="text-lg font-bold text-emerald-800 mb-4">Detalles de tu cita</h5>
                            <div class="space-y-3 text-left">
                                <div>
                                    <strong class="text-sm text-emerald-700">Servicio:</strong>
                                    <p id="final-service" class="text-emerald-900 font-medium"></p>
                                </div>
                                <div>
                                    <strong class="text-sm text-emerald-700">Profesional:</strong>
                                    <p id="final-employee" class="text-emerald-900 font-medium"></p>
                                </div>
                                <div>
                                    <strong class="text-sm text-emerald-700">Fecha:</strong>
                                    <p id="final-date" class="text-emerald-900 font-medium"></p>
                                </div>
                                <div>
                                    <strong class="text-sm text-emerald-700">Hora:</strong>
                                    <p id="final-time" class="text-emerald-900 font-medium"></p>
                                </div>
                                <div>
                                    <strong class="text-sm text-emerald-700">ID de Reserva:</strong>
                                    <p id="appointment-id" class="text-emerald-900 font-medium font-mono"></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <button type="button" onclick="window.print()" class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-all mr-4">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                                Imprimir Confirmación
                            </button>
                            <button type="button" onclick="location.reload()" class="px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-all">
                                Hacer Nueva Reserva
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Wizard cargado');
        const form = document.getElementById('booking-form');
        const stepEls = Array.from(document.querySelectorAll('.booking-step'));
        const serviceInput = document.getElementById('service_id');
        const employeeInput = document.getElementById('employee_id');
        
        console.log('Elementos encontrados:');
        console.log('- Form:', !!form);
        console.log('- Steps:', stepEls.length);
        console.log('- Service input:', !!serviceInput);
        console.log('- Employee input:', !!employeeInput);
        console.log('- Service cards:', document.querySelectorAll('.service-card').length);

        function showStep(n) {
            console.log('Mostrando paso:', n);
            stepEls.forEach((el, idx) => {
                if ((idx + 1) === n) {
                    el.classList.remove('hidden');
                    el.style.display = 'block';
                } else {
                    el.classList.add('hidden');
                    el.style.display = 'none';
                }
            });
            
            // Actualizar indicadores de paso
            document.querySelectorAll('.step-circle').forEach((circle, idx) => {
                const stepNum = idx + 1;
                if (stepNum <= n) {
                    circle.classList.remove('bg-gray-200', 'text-gray-500');
                    circle.classList.add('bg-emerald-600', 'text-white');
                } else {
                    circle.classList.remove('bg-emerald-600', 'text-white');
                    circle.classList.add('bg-gray-200', 'text-gray-500');
                }
            });
        }

        // Usar delegación de eventos en el contenedor principal
        const wizard = document.getElementById('booking-wizard');
        wizard.addEventListener('click', async function (e) {
            const serviceCard = e.target.closest('.service-card');
            if (serviceCard) {
                console.log('Servicio seleccionado:', serviceCard.dataset.serviceId);
                
                // Remover selección previa
                document.querySelectorAll('.service-card').forEach(el => {
                    el.classList.remove('border-emerald-500');
                    el.classList.add('border-gray-200');
                });
                
                // Seleccionar actual
                serviceCard.classList.remove('border-gray-200');
                serviceCard.classList.add('border-emerald-500');
                
                // Actualizar input oculto
                if (serviceInput) {
                    serviceInput.value = serviceCard.dataset.serviceId;
                    console.log('Input actualizado:', serviceInput.value);
                }
                
                // Habilitar botón continuar
                const btn = document.querySelector('#booking-step-1 .next-step');
                if (btn) {
                    btn.disabled = false;
                    btn.removeAttribute('disabled');
                    console.log('Botón habilitado');
                }
                
                // Actualizar resumen
                updateSummary();
                return;
            }

            const employeeCard = e.target.closest('.employee-card');
            if (employeeCard) {
                document.querySelectorAll('.employee-card').forEach(el => el.classList.remove('border-emerald-500'));
                employeeCard.classList.add('border-emerald-500');
                employeeInput.value = employeeCard.dataset.employeeId;
                const btn = document.querySelector('#booking-step-2 .next-step');
                if (btn) btn.removeAttribute('disabled');
                
                // Actualizar resumen
                updateSummary();
                return;
            }

            const nextBtn = e.target.closest('.next-step');
            if (nextBtn && !nextBtn.disabled) {
                const next = parseInt(nextBtn.dataset.next, 10);
                console.log('Avanzando al paso:', next);
                
                if (next === 2) {
                    await loadEmployees();
                } else if (next === 4) {
                    // Actualizar resumen antes de mostrar el paso final
                    updateSummary();
                }
                showStep(next);
                return;
            }
            
            const prevBtn = e.target.closest('.prev-step');
            if (prevBtn) {
                const prev = parseInt(prevBtn.dataset.prev, 10);
                console.log('Retrocediendo al paso:', prev);
                showStep(prev);
                return;
            }
        });

        async function loadEmployees() {
            const container = document.getElementById('employees-container');
            if (!container) return;
            container.innerHTML = '<div class="text-center text-gray-500 py-8">Cargando profesionales...</div>';
            const sid = serviceInput.value;
            if (!sid) { 
                container.innerHTML = '<div class="text-center text-red-500 py-8">Selecciona un servicio primero</div>'; 
                return; 
            }
            try {
                const res = await fetch(`/api/public/employees-by-service/${sid}`);
                const data = await res.json();
                if (!Array.isArray(data) || data.length === 0) {
                    container.innerHTML = '<div class="text-center text-gray-500 py-8">Sin profesionales disponibles</div>';
                    return;
                }
                container.innerHTML = data.map(u => `
                    <div class="employee-card border-2 border-gray-200 rounded-xl p-6 cursor-pointer hover:border-emerald-500 hover:shadow-lg transition-all" data-employee-id="${u.id}" data-employee-name="${u.name}">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center">
                                <span class="text-emerald-600 font-bold text-lg">${u.name.charAt(0).toUpperCase()}</span>
                            </div>
                            <div>
                                <h5 class="text-lg font-bold text-gray-900">${u.name}</h5>
                                <p class="text-gray-600 text-sm">${u.email || 'Fisioterapeuta'}</p>
                            </div>
                        </div>
                    </div>
                `).join('');
            } catch (e) {
                container.innerHTML = '<div class="text-center text-red-500 py-8">Error cargando profesionales</div>';
            }
        }

        // Funcionalidad del calendario
        let currentDate = new Date();
        let selectedDate = null;
        
        function generateCalendar(year, month) {
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const startDate = new Date(firstDay);
            startDate.setDate(startDate.getDate() - firstDay.getDay());
            
            const monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            
            document.getElementById('current-month-year').textContent = `${monthNames[month]} ${year}`;
            
            const calendarBody = document.getElementById('calendar-body');
            calendarBody.innerHTML = '';
            
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            for (let week = 0; week < 6; week++) {
                const row = document.createElement('tr');
                
                for (let day = 0; day < 7; day++) {
                    const cellDate = new Date(startDate);
                    cellDate.setDate(startDate.getDate() + (week * 7) + day);
                    
                    const cell = document.createElement('td');
                    cell.className = 'py-2 px-1';
                    
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.textContent = cellDate.getDate();
                    button.className = 'w-8 h-8 rounded-full text-sm font-medium transition-all';
                    
                    // Estilos según el estado del día
                    if (cellDate.getMonth() !== month) {
                        // Días de otros meses
                        button.className += ' text-gray-300 cursor-not-allowed';
                        button.disabled = true;
                    } else if (cellDate < today) {
                        // Días pasados
                        button.className += ' text-gray-400 cursor-not-allowed';
                        button.disabled = true;
                    } else {
                        // Días disponibles
                        button.className += ' text-gray-700 hover:bg-emerald-100 hover:text-emerald-600 cursor-pointer';
                        button.onclick = () => selectDate(cellDate);
                    }
                    
                    // Marcar día seleccionado
                    if (selectedDate && cellDate.toDateString() === selectedDate.toDateString()) {
                        button.className = button.className.replace('text-gray-700', 'bg-emerald-600 text-white');
                    }
                    
                    cell.appendChild(button);
                    row.appendChild(cell);
                }
                
                calendarBody.appendChild(row);
                
                // Si todos los días de la semana son del mes siguiente, parar
                if (startDate.getDate() + (week * 7) + 6 > lastDay.getDate() && week > 3) {
                    break;
                }
            }
        }
        
        function selectDate(date) {
            selectedDate = date;
            console.log('Fecha seleccionada:', date.toISOString().split('T')[0]);
            
            // Actualizar input oculto
            const dateInput = document.getElementById('selected_date');
            if (dateInput) {
                dateInput.value = date.toISOString().split('T')[0];
            }
            
            // Regenerar calendario para mostrar selección
            generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
            
            // Cargar horarios disponibles
            loadTimeSlots(date);
            
            // Actualizar resumen
            updateSummary();
        }
        
        async function loadTimeSlots(date) {
            const container = document.getElementById('time-slots-container');
            if (!container) return;
            
            container.innerHTML = '<div class="text-center text-gray-500 py-4">Cargando horarios disponibles...</div>';
            
            const employeeId = employeeInput.value;
            const serviceId = serviceInput.value;
            const dateStr = date.toISOString().split('T')[0];
            
            if (!employeeId || !serviceId) {
                container.innerHTML = '<div class="text-center text-red-500 py-4">Selecciona un profesional y servicio primero</div>';
                return;
            }
            
            try {
                const url = `/api/public/available-time-slots?employee_id=${employeeId}&service_id=${serviceId}&date=${dateStr}`;
                const response = await fetch(url);
                const data = await response.json();
                
                if (!response.ok || !data.success) {
                    container.innerHTML = `<div class="text-center text-red-500 py-4">${data.message || 'Error al cargar horarios'}</div>`;
                    return;
                }
                
                const timeSlots = data.slots || [];
                
                if (timeSlots.length === 0) {
                    container.innerHTML = `
                        <div class="text-center text-gray-500 py-8">
                            <div class="mb-4">
                                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-lg font-medium">No hay horarios disponibles</p>
                            <p class="text-sm">Intenta con otra fecha o fisioterapeuta</p>
                        </div>
                    `;
                    return;
                }
                
                container.innerHTML = `
                    <div class="mb-4 text-sm text-gray-600">
                        <strong>Horarios disponibles para ${data.employee}</strong> - ${data.service}
                    </div>
                    <div class="grid grid-cols-3 md:grid-cols-4 gap-3">
                        ${timeSlots.map(slot => `
                            <button type="button" 
                                    class="time-slot px-4 py-2 text-sm font-medium rounded-lg border-2 transition-all border-gray-200 text-gray-700 hover:border-emerald-500 hover:bg-emerald-50 cursor-pointer" 
                                    data-time="${slot.time}"
                                    ${!slot.available ? 'disabled' : ''}>
                                ${slot.time}
                            </button>
                        `).join('')}
                    </div>
                `;
                
            } catch (e) {
                container.innerHTML = '<div class="text-center text-red-500 py-4">Error cargando horarios</div>';
            }
        }
        
        // Manejar selección de horario
        document.addEventListener('click', function(e) {
            const timeSlot = e.target.closest('.time-slot');
            if (timeSlot && !timeSlot.disabled) {
                // Remover selección previa
                document.querySelectorAll('.time-slot').forEach(slot => {
                    slot.classList.remove('border-emerald-500', 'bg-emerald-500', 'text-white');
                    slot.classList.add('border-gray-200', 'text-gray-700');
                });
                
                // Seleccionar actual
                timeSlot.classList.remove('border-gray-200', 'text-gray-700');
                timeSlot.classList.add('border-emerald-500', 'bg-emerald-500', 'text-white');
                
                // Actualizar input oculto
                const timeInput = document.getElementById('selected_time_slot');
                if (timeInput) {
                    timeInput.value = timeSlot.dataset.time;
                }
                
                // Habilitar botón continuar
                const btn = document.querySelector('#booking-step-3 .next-step');
                if (btn) {
                    btn.disabled = false;
                    btn.removeAttribute('disabled');
                }
                
                // Actualizar resumen
                updateSummary();
                
                console.log('Horario seleccionado:', timeSlot.dataset.time);
            }
        });
        
        // Navegación del calendario
        document.getElementById('prev-month').addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
        });
        
        document.getElementById('next-month').addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
        });
        
        // Función para actualizar el resumen
        function updateSummary() {
            const serviceId = serviceInput.value;
            const employeeId = employeeInput.value;
            const selectedDateValue = document.getElementById('selected_date').value;
            const selectedTimeValue = document.getElementById('selected_time_slot').value;
            
            // Actualizar servicio
            const selectedServiceCard = document.querySelector('.service-card.border-emerald-500');
            if (selectedServiceCard) {
                const serviceName = selectedServiceCard.querySelector('h5').textContent;
                document.getElementById('summary-service').textContent = serviceName;
            }
            
            // Actualizar empleado
            const selectedEmployeeCard = document.querySelector('.employee-card.border-emerald-500');
            if (selectedEmployeeCard) {
                const employeeName = selectedEmployeeCard.dataset.employeeName;
                document.getElementById('summary-employee').textContent = employeeName;
            }
            
            // Actualizar fecha
            if (selectedDateValue) {
                const date = new Date(selectedDateValue);
                const options = { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                };
                document.getElementById('summary-date').textContent = date.toLocaleDateString('es-ES', options);
            }
            
            // Actualizar hora
            if (selectedTimeValue) {
                document.getElementById('summary-time').textContent = selectedTimeValue;
            }
        }
        
        // Generar calendario inicial
        generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
        
        showStep(1);
        
        // Interceptar envío del formulario
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('confirm-booking-btn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');
            
            // Mostrar loading
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            submitBtn.disabled = true;
            
            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Actualizar datos finales
                    document.getElementById('final-service').textContent = document.getElementById('summary-service').textContent;
                    document.getElementById('final-employee').textContent = document.getElementById('summary-employee').textContent;
                    document.getElementById('final-date').textContent = document.getElementById('summary-date').textContent;
                    document.getElementById('final-time').textContent = document.getElementById('summary-time').textContent;
                    document.getElementById('appointment-id').textContent = '#' + result.appointment_id;
                    
                    // Mostrar paso 5
                    showStep(5);
                } else {
                    // Manejar errores específicos
                    if (response.status === 409) {
                        // Conflicto de horario
                        let message = result.message || 'El horario seleccionado ya no está disponible.';
                        if (result.conflicts && result.conflicts.length > 0) {
                            message += '\n\nCitas existentes:';
                            result.conflicts.forEach(conflict => {
                                message += `\n• ${conflict.start_time} - ${conflict.end_time}: ${conflict.patient} (${conflict.service})`;
                            });
                        }
                        alert(message);
                        
                        // Volver al paso 3 para seleccionar otro horario
                        showStep(3);
                        if (selectedDate) {
                            loadTimeSlots(selectedDate);
                        }
                    } else if (response.status === 422) {
                        // Errores de validación
                        let message = 'Error de validación:\n';
                        if (result.errors) {
                            Object.keys(result.errors).forEach(field => {
                                message += `\n• ${result.errors[field].join(', ')}`;
                            });
                        } else {
                            message += result.message || 'Datos inválidos';
                        }
                        alert(message);
                    } else {
                        alert('Error: ' + (result.message || 'No se pudo procesar la reserva'));
                    }
                    
                    // Restaurar botón
                    btnText.classList.remove('hidden');
                    btnLoading.classList.add('hidden');
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error de conexión. Por favor, inténtalo de nuevo.');
                // Restaurar botón
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
                submitBtn.disabled = false;
            }
        });
    });
    </script>
</div>