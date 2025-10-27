<div class="flex items-center justify-center h-full">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden">
        <!-- WhatsApp Header -->
        <div class="bg-[#075E54] p-4 text-white flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-8 h-8">
                </div>
                <div>
                    <h3 class="font-semibold text-sm">FisioAlcoy</h3>
                    <p class="text-xs text-emerald-100">En línea ahora</p>
                </div>
            </div>
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
            </svg>
        </div>
        
        <!-- WhatsApp Messages -->
        <div class="bg-[#ECE5DD] p-4 h-[500px] overflow-y-auto space-y-3">
            <div class="text-center">
                <span class="inline-block px-3 py-1 bg-white/80 rounded-lg text-xs text-gray-600">Hoy</span>
            </div>
            
            <!-- Mensaje del bot -->
            <div class="flex justify-start">
                <div class="bg-white rounded-lg rounded-tl-none p-3 max-w-[80%] shadow-sm">
                    <p class="text-sm text-gray-800">
                        Hola Ana, te recordamos que tienes una cita mañana a las 10:00h con el Fisio. Martínez para revisión fisioterapéutica. ¿Podrás asistir?
                    </p>
                    <span class="text-xs text-gray-500 mt-1 block text-right">10:03</span>
                </div>
            </div>
            
            <!-- Mensaje del usuario -->
            <div class="flex justify-end">
                <div class="bg-[#DCF8C6] rounded-lg rounded-tr-none p-3 max-w-[80%] shadow-sm">
                    <p class="text-sm text-gray-800">
                        Hola, sí podré asistir. Gracias por el recordatorio.
                    </p>
                    <span class="text-xs text-gray-500 mt-1 block text-right">10:05</span>
                </div>
            </div>
            
            <!-- Mensaje del bot -->
            <div class="flex justify-start">
                <div class="bg-white rounded-lg rounded-tl-none p-3 max-w-[80%] shadow-sm">
                    <p class="text-sm text-gray-800">
                        ¡Perfecto Ana! Tu cita ha sido confirmada. Le esperamos mañana a las 10:00h. Recuerde llegar 10 minutos antes para completar el registro.
                    </p>
                    <span class="text-xs text-gray-500 mt-1 block text-right">10:06</span>
                </div>
            </div>
            
            <!-- Mensaje del usuario -->
            <div class="flex justify-end">
                <div class="bg-[#DCF8C6] rounded-lg rounded-tr-none p-3 max-w-[80%] shadow-sm">
                    <p class="text-sm text-gray-800">
                        Perfecto, ahí estaré. ¿Debo llevar algo especial?
                    </p>
                    <span class="text-xs text-gray-500 mt-1 block text-right">10:07</span>
                </div>
            </div>
            
            <!-- Mensaje del bot -->
            <div class="flex justify-start">
                <div class="bg-white rounded-lg rounded-tl-none p-3 max-w-[80%] shadow-sm">
                    <p class="text-sm text-gray-800">
                        Solo traiga ropa cómoda para la sesión. Si tiene informes médicos o pruebas de imagen recientes, también puede traerlos. ¿Necesita algo más?
                    </p>
                    <span class="text-xs text-gray-500 mt-1 block text-right">10:08</span>
                </div>
            </div>
        </div>
        
        <!-- WhatsApp Input -->
        <div class="bg-[#F0F0F0] p-3 flex items-center space-x-2">
            <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"/>
            </svg>
            <input type="text" placeholder="Escribe un mensaje..." class="flex-1 bg-white rounded-full px-4 py-2 text-sm focus:outline-none">
            <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z" clip-rule="evenodd"/>
            </svg>
        </div>
    </div>
</div>