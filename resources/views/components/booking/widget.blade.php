@props(['compact' => true])

<div id="booking-widget" class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
    <h3 class="text-2xl font-bold text-gray-900 mb-6">Reserva tu Cita</h3>
    
    <x-booking.step-indicators :currentStep="1" />
    
    <form id="booking-widget-form" action="{{ route('public.save_booking') }}" method="POST">
        @csrf
        <input type="hidden" name="service_id" id="widget-service-id">
        <input type="hidden" name="employee_id" id="widget-employee-id">
        <input type="hidden" name="date" id="widget-selected-date">
        <input type="hidden" name="time_slot" id="widget-selected-time-slot">
        
        <x-booking.step-services />
        <x-booking.step-employees />
        <x-booking.sstep-datetime />
        <x-booking.step-confirmation />
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Widget cargado');
        const form = document.getElementById('booking-widget-form');
        const stepEls = Array.from(document.querySelectorAll('.booking-widget-step'));
        const serviceInput = document.getElementById('widget-service-id');
        const employeeInput = document.getElementById('widget-employee-id');
        
        console.log('Elementos encontrados:');
        console.log('- Form:', !!form);
        console.log('- Steps:', stepEls.length);
        console.log('- Service input:', !!serviceInput);
        console.log('- Employee input:', !!employeeInput);
        console.log('- Service items:', document.querySelectorAll('.service-select-item').length);

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
        }

        // Usar delegación de eventos en el contenedor principal
        const widget = document.getElementById('booking-widget');
        widget.addEventListener('click', async function (e) {
            const serviceItem = e.target.closest('.service-select-item');
            if (serviceItem) {
                console.log('Servicio seleccionado:', serviceItem.dataset.serviceId);
                
                // Remover selección previa
                document.querySelectorAll('.service-select-item').forEach(el => {
                    el.classList.remove('border-emerald-500');
                    el.classList.add('border-gray-200');
                });
                
                // Seleccionar actual
                serviceItem.classList.remove('border-gray-200');
                serviceItem.classList.add('border-emerald-500');
                
                // Actualizar input oculto
                if (serviceInput) {
                    serviceInput.value = serviceItem.dataset.serviceId;
                    console.log('Input actualizado:', serviceInput.value);
                }
                
                // Habilitar botón continuar
                const btn = document.querySelector('#booking-widget-step-1 .widget-next-step');
                if (btn) {
                    btn.disabled = false;
                    btn.removeAttribute('disabled');
                    console.log('Botón habilitado');
                }
                return;
            }

            const employeeItem = e.target.closest('.employee-select-item');
            if (employeeItem) {
                document.querySelectorAll('.employee-select-item').forEach(el => el.classList.remove('border-emerald-500'));
                employeeItem.classList.add('border-emerald-500');
                employeeInput.value = employeeItem.dataset.employeeId;
                const btn = document.querySelector('#booking-widget-step-2 .widget-next-step');
                if (btn) btn.removeAttribute('disabled');
                return;
            }

            const nextBtn = e.target.closest('.widget-next-step');
            if (nextBtn && !nextBtn.disabled) {
                const next = parseInt(nextBtn.dataset.next, 10);
                console.log('Avanzando al paso:', next);
                
                if (next === 2) {
                    await loadEmployees();
                }
                showStep(next);
                return;
            }
            
            const prevBtn = e.target.closest('.widget-prev-step');
            if (prevBtn) {
                const prev = parseInt(prevBtn.dataset.prev, 10);
                console.log('Retrocediendo al paso:', prev);
                showStep(prev);
                return;
            }
        });

        async function loadEmployees() {
            const container = document.getElementById('employees-list');
            if (!container) return;
            container.innerHTML = '<div class="text-sm text-gray-500">Cargando...</div>';
            const sid = serviceInput.value;
            if (!sid) { container.innerHTML = '<div class="text-sm text-red-500">Selecciona un servicio primero</div>'; return; }
            try {
                const res = await fetch(`/api/public/employees-by-service/${sid}`);
                const data = await res.json();
                if (!Array.isArray(data) || data.length === 0) {
                    container.innerHTML = '<div class="text-sm text-gray-500">Sin profesionales disponibles</div>';
                    return;
                }
                container.innerHTML = data.map(u => `
                    <div class="employee-select-item border-2 border-gray-200 rounded-lg p-3 cursor-pointer hover:border-emerald-500 transition-all" data-employee-id="${u.id}" data-employee-name="${u.name}">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-gray-900 text-sm truncate mr-2">${u.name}</span>
                            <span class="text-xs text-gray-500">${u.email ?? ''}</span>
                        </div>
                    </div>
                `).join('');
            } catch (e) {
                container.innerHTML = '<div class="text-sm text-red-500">Error cargando profesionales</div>';
            }
        }

        showStep(1);
    });
    </script>
</div>