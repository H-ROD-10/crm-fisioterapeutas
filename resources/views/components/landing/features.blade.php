<section id="features" class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-block px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold mb-4" data-aos="fade-up">
                Funcionalidades
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-4" data-aos="fade-up" data-aos-delay="100">
                Todo lo que necesitas en un solo lugar
            </h2>
            <p class="text-xl text-gray-600" data-aos="fade-up" data-aos-delay="200">
                Optimiza la gestión de tu clínica de fisioterapia con herramientas poderosas e intuitivas
            </p>
        </div>
        
        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1: Gestión de Citas -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group" data-aos="fade-up">
                <div class="w-16 h-16 bg-linear-to-br from-teal-400 to-teal-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z"/>
                    </svg>
                </div>
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">IA</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Gestión de Citas</h3>
                <p class="text-gray-600 mb-6">
                    Sistema intuitivo para programar, modificar y dar seguimiento a todas las citas de tus pacientes sin conflictos ni superposiciones.
                </p>
                <a href="{{ route('features.appointments') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-semibold group-hover:translate-x-2 transition-transform">
                    Más información
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Feature 2: Historial Clínico -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-linear-to-br from-emerald-400 to-emerald-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z"/>
                    </svg>
                </div>
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">IA</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Historial Clínico</h3>
                <p class="text-gray-600 mb-6">
                    Mantén el historial completo de cada paciente, con acceso instantáneo a todos los tratamientos, diagnósticos y seguimientos.
                </p>
                <a href="{{ route('features.clinical-history') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-semibold group-hover:translate-x-2 transition-transform">
                    Más información
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            
            <!-- Feature 3: Asistente Virtual -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-linear-to-br from-cyan-400 to-cyan-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 9V7c0-1.1-.9-2-2-2h-3c0-1.66-1.34-3-3-3S9 3.34 9 5H6c-1.1 0-2 .9-2 2v2c-1.66 0-3 1.34-3 3s1.34 3 3 3v4c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-4c1.66 0 3-1.34 3-3s-1.34-3-3-3zM7.5 11.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5S9.83 13 9 13s-1.5-.67-1.5-1.5zM16 17H8v-2h8v2zm-1-4c-.83 0-1.5-.67-1.5-1.5S14.17 10 15 10s1.5.67 1.5 1.5S15.83 13 15 13z"/>
                    </svg>
                </div>
                <div class="mb-4 flex items-center space-x-2">
                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">IA</span>
                    <span class="inline-block px-3 py-1 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full">Nuevo</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Asistente Virtual</h3>
                <p class="text-gray-600 mb-6">
                    Automatiza recordatorios y confirmaciones de citas por WhatsApp y atiende llamadas con IA, operando 24/7.
                </p>
                <div class="space-y-2">
                    <a href="{{ route('features.virtual-assistant') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-semibold group-hover:translate-x-2 transition-transform">
                        Más información WhatsApp
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Feature 4: Transcripción Inteligente -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-linear-to-br from-sky-400 to-sky-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 14c1.66 0 2.99-1.34 2.99-3L15 5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3zm5.3-3c0 3-2.54 5.1-5.3 5.1S6.7 14 6.7 11H5c0 3.41 2.72 6.23 6 6.72V21h2v-3.28c3.28-.48 6-3.3 6-6.72h-1.7z"/>
                    </svg>
                </div>
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">IA</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Transcripción Inteligente</h3>
                <p class="text-gray-600 mb-6">
                    Convierte tus notas de voz en informes clínicos estructurados con nuestra tecnología de transcripción con IA.
                </p>
                <a href="#" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-semibold group-hover:translate-x-2 transition-transform">
                    Más información
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            
            <!-- Feature 5: Marketing Especializado -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 bg-linear-to-br from-lime-400 to-lime-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 11v2h4v-2h-4zm-2 6.61c.96.71 2.21 1.65 3.2 2.39.4-.53.8-1.07 1.2-1.6-.99-.74-2.24-1.68-3.2-2.4-.4.54-.8 1.08-1.2 1.61zM20.4 5.6c-.4-.53-.8-1.07-1.2-1.6-.99.74-2.24 1.68-3.2 2.4.4.53.8 1.07 1.2 1.6.96-.72 2.21-1.65 3.2-2.4zM4 9c-1.1 0-2 .9-2 2v2c0 1.1.9 2 2 2h1v4h2v-4h1l5 3V6L8 9H4zm11.5 3c0-1.33-.58-2.53-1.5-3.35v6.69c.92-.81 1.5-2.01 1.5-3.34z"/>
                    </svg>
                </div>
                <div class="mb-4 flex items-center space-x-2">
                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">IA</span>
                    <span class="inline-block px-3 py-1 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full">Nuevo</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Marketing Especializado</h3>
                <p class="text-gray-600 mb-6">
                    Campañas personalizadas que maximizan la captación y fidelización de pacientes, con atención inmediata a nuevos contactos.
                </p>
                <a href="{{ route('features.marketing') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-semibold group-hover:translate-x-2 transition-transform">
                    Más información
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            
            <!-- Feature 6: Facturación Inteligente -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group" data-aos="fade-up" data-aos-delay="500">
                <div class="w-16 h-16 bg-linear-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                    </svg>
                </div>
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">IA</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Facturación Inteligente con Verifactu</h3>
                <p class="text-gray-600 mb-6">
                    Sistema automático de cobro por sesión, con emisión de facturas certificadas, recordatorios de pago y control financiero.
                </p>
                <a href="{{ route('features.billing') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-semibold group-hover:translate-x-2 transition-transform">
                    Más información
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>