<div class="booking-widget-step hidden" id="booking-widget-step-3">
    <h5 class="text-xl font-bold text-gray-900 mb-6">Selecciona fecha y hora:</h5>
    
    <!-- Mini Calendario -->
    <div class="bg-white rounded-lg border border-gray-200 mb-6">
        <div class="p-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <button type="button" class="p-2 hover:bg-gray-100 rounded transition-all" id="widget-prev-month">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <h6 class="font-bold text-gray-900" id="widget-current-month-year"></h6>
                <button type="button" class="p-2 hover:bg-gray-100 rounded transition-all" id="widget-next-month">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-4">
            <table class="w-full text-center text-sm">
                <thead>
                    <tr class="text-xs font-semibold text-gray-600">
                        <th class="py-1">D</th>
                        <th class="py-1">L</th>
                        <th class="py-1">M</th>
                        <th class="py-1">X</th>
                        <th class="py-1">J</th>
                        <th class="py-1">V</th>
                        <th class="py-1">S</th>
                    </tr>
                </thead>
                <tbody id="widget-calendar-body">
                    <!-- El calendario se generará dinámicamente aquí -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Horarios Disponibles -->
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-4 border-b border-gray-200">
            <h6 class="font-bold text-gray-900">Horarios Disponibles</h6>
        </div>
        <div class="p-4">
            <div id="widget-time-slots-container">
                <p class="text-center text-gray-500 text-sm">Seleccione una fecha</p>
            </div>
        </div>
    </div>

    <div class="flex justify-between mt-6">
        <button type="button" class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-all widget-prev-step" data-prev="2">
            Volver
        </button>
        <button type="button" class="px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-all widget-next-step disabled:opacity-50 disabled:cursor-not-allowed" data-next="4" disabled>
            Continuar
        </button>
    </div>
</div>