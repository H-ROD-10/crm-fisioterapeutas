<section class="relative py-20 md:py-32 overflow-hidden bg-linear-to-br from-emerald-50 via-white to-teal-50">
    <!-- Elementos flotantes decorativos -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-32 h-32 bg-emerald-200/30 rounded-full blur-3xl animate-float"></div>
        <div class="absolute top-40 right-20 w-48 h-48 bg-teal-200/30 rounded-full blur-3xl animate-float-delayed"></div>
        <div class="absolute bottom-20 left-1/4 w-64 h-64 bg-emerald-300/20 rounded-full blur-3xl animate-float-slow"></div>
        <div class="absolute bottom-40 right-1/3 w-40 h-40 bg-teal-300/20 rounded-full blur-3xl animate-float"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Contenido -->
            <div data-aos="fade-up">
                <div class="inline-block px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold mb-4">
                    Característica principal
                </div>
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="px-3 py-1 bg-linear-to-r from-purple-500 to-pink-500 text-white rounded-full text-xs font-semibold">
                        IA Integrada
                    </span>
                    <span class="px-3 py-1 bg-linear-to-r from-emerald-500 to-teal-500 text-white rounded-full text-xs font-semibold">
                        Optimización Avanzada
                    </span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    Software de Gestión de Citas para Clínicas de Fisioterapia
                </h1>
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    Sistema inteligente impulsado por IA que optimiza la programación y seguimiento de citas en tu clínica de fisioterapia, 
                    permitiendo gestión por voz, chat y WhatsApp sin intervención humana.
                </p>
                
                <!-- Estadísticas -->
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="text-4xl font-bold text-emerald-600 mb-2">30%</div>
                        <div class="text-sm text-gray-600">Menos cancelaciones</div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="text-4xl font-bold text-emerald-600 mb-2">45%</div>
                        <div class="text-sm text-gray-600">Más productividad</div>
                    </div>
                </div>
                
                <a href="{{ route('landing.demo') }}" class="inline-flex items-center px-8 py-4 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-all transform hover:scale-105 shadow-lg">
                    Ver Demo
                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>

            <!-- Demo de Calendario -->
            <div data-aos="fade-left" class="relative">
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                    <!-- Header del Calendario -->
                    <div class="bg-linear-to-r from-emerald-600 to-teal-600 p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-2xl font-bold">Agenda de Citas</h3>
                                <p class="text-emerald-100">Julio 2025</p>
                            </div>
                            <div class="flex space-x-2">
                                <button class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <button class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Días de la semana -->
                        <div class="grid grid-cols-7 gap-2 text-center text-sm font-medium text-emerald-100">
                            <div>Lun</div>
                            <div>Mar</div>
                            <div>Mié</div>
                            <div>Jue</div>
                            <div>Vie</div>
                            <div>Sáb</div>
                            <div>Dom</div>
                        </div>
                    </div>
                    
                    <!-- Días del mes -->
                    <div class="p-6">
                        <div class="grid grid-cols-7 gap-2 mb-6">
                            <div class="aspect-square"></div>
                            @for($i = 1; $i <= 31; $i++)
                                <div class="aspect-square flex items-center justify-center text-sm rounded-lg
                                    {{ $i == 21 ? 'bg-emerald-600 text-white font-bold' : '' }}
                                    {{ in_array($i, [9, 12, 16, 22, 24]) ? 'bg-emerald-100 text-emerald-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}
                                    cursor-pointer transition">
                                    {{ $i }}
                                </div>
                            @endfor
                        </div>
                        
                        <!-- Citas del día -->
                        <div class="border-t border-gray-200 pt-6">
                            <h4 class="font-bold text-gray-900 mb-4">Citas para hoy - 22 de Julio</h4>
                            <div class="space-y-3">
                                <!-- Cita 1 -->
                                <div class="flex items-center space-x-4 p-3 bg-emerald-50 rounded-lg border border-emerald-200">
                                    <div class="text-emerald-600 font-bold text-sm">09:00</div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-900 text-sm">Ana García</div>
                                        <div class="text-xs text-gray-600">Rehabilitación de rodilla</div>
                                    </div>
                                    <span class="px-2 py-1 bg-emerald-600 text-white text-xs rounded-full">Confirmada</span>
                                </div>
                                
                                <!-- Cita 2 -->
                                <div class="flex items-center space-x-4 p-3 bg-amber-50 rounded-lg border border-amber-200">
                                    <div class="text-amber-600 font-bold text-sm">11:30</div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-900 text-sm">Carlos Ruiz</div>
                                        <div class="text-xs text-gray-600">Fisioterapia de espalda</div>
                                    </div>
                                    <span class="px-2 py-1 bg-amber-500 text-white text-xs rounded-full">Pendiente</span>
                                </div>
                                
                                <!-- Cita 3 -->
                                <div class="flex items-center space-x-4 p-3 bg-emerald-50 rounded-lg border border-emerald-200">
                                    <div class="text-emerald-600 font-bold text-sm">16:15</div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-900 text-sm">María Sánchez</div>
                                        <div class="text-xs text-gray-600">Terapia manual</div>
                                    </div>
                                    <span class="px-2 py-1 bg-emerald-600 text-white text-xs rounded-full">Confirmada</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}
@keyframes float-delayed {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-30px); }
}
@keyframes float-slow {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}
.animate-float { animation: float 6s ease-in-out infinite; }
.animate-float-delayed { animation: float-delayed 8s ease-in-out infinite; }
.animate-float-slow { animation: float-slow 10s ease-in-out infinite; }
</style>