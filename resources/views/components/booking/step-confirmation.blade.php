<div class="booking-widget-step hidden" id="booking-widget-step-4">
    <h5 class="text-xl font-bold text-gray-900 mb-6">Completa tus datos:</h5>
    
    <div class="space-y-4 mb-6">
        <div>
            <label for="widget-name" class="block text-sm font-medium text-gray-700 mb-2">Nombre Completo</label>
            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" id="widget-name" name="name" required>
        </div>
        <div>
            <label for="widget-email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" id="widget-email" name="email" required>
        </div>
        <div>
            <label for="widget-phone" class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
            <input type="tel" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" id="widget-phone" name="phone" required>
        </div>
        <div>
            <label for="widget-comments" class="block text-sm font-medium text-gray-700 mb-2">Motivo de consulta (opcional)</label>
            <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" id="widget-comments" name="comments" rows="3" placeholder="Describe brevemente tu dolencia"></textarea>
        </div>
    </div>

    <!-- Resumen -->
    <div class="bg-emerald-50 rounded-lg border border-emerald-200 p-4 mb-6">
        <h6 class="font-bold text-gray-900 mb-3">Resumen de tu cita:</h6>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-600">Servicio:</span>
                <span class="font-semibold text-gray-900" id="widget-summary-service"></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Profesional:</span>
                <span class="font-semibold text-gray-900" id="widget-summary-employee"></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Fecha:</span>
                <span class="font-semibold text-gray-900" id="widget-summary-date"></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Hora:</span>
                <span class="font-semibold text-gray-900" id="widget-summary-time"></span>
            </div>
        </div>
    </div>

    <div class="flex justify-between">
        <button type="button" class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-all widget-prev-step" data-prev="3">
            Volver
        </button>
        <button type="submit" class="px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-all transform hover:scale-105 shadow-lg">
            Confirmar Reserva
        </button>
    </div>
</div>