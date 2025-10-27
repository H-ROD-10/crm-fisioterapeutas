@extends('landing.layouts.app')

@section('title', 'Transcripción Inteligente de Consultas | CRM Fisio')
@section('meta_description', 'Transcribe automáticamente tus consultas con IA y genera notas clínicas estructuradas en segundos.')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 md:py-32 overflow-hidden bg-linear-to-br from-cyan-50 via-white to-blue-50">
        <!-- Elementos flotantes decorativos -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-32 h-32 bg-cyan-200/30 rounded-full blur-3xl animate-float"></div>
            <div class="absolute top-40 right-20 w-48 h-48 bg-blue-200/30 rounded-full blur-3xl animate-float-delayed"></div>
            <div class="absolute bottom-20 left-1/4 w-64 h-64 bg-cyan-300/20 rounded-full blur-3xl animate-float-slow"></div>
            <div class="absolute bottom-40 right-1/3 w-40 h-40 bg-blue-300/20 rounded-full blur-3xl animate-float"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-up">
                    <div class="inline-block px-4 py-2 bg-cyan-100 text-cyan-700 rounded-full text-sm font-semibold mb-4">
                        IA avanzada
                    </div>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="px-3 py-1 bg-linear-to-r from-cyan-500 to-blue-500 text-white rounded-full text-xs font-semibold">
                            IA Integrada
                        </span>
                        <span class="px-3 py-1 bg-linear-to-r from-purple-500 to-pink-500 text-white rounded-full text-xs font-semibold">
                            Exclusivo
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                        Transcripción Inteligente
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Convierte notas de voz en informes médicos estructurados en segundos. Nuestra IA especializada en terminología fisioterapéutica captura todos los detalles importantes automáticamente.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-cyan-600 mb-2">85%</div>
                            <div class="text-sm text-gray-600">Ahorro de tiempo</div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-cyan-600 mb-2">98%</div>
                            <div class="text-sm text-gray-600">Precisión clínica</div>
                        </div>
                    </div>
                    
                    <a href="{{ route('landing.demo') }}" class="inline-flex items-center px-8 py-4 bg-cyan-600 text-white font-semibold rounded-lg hover:bg-cyan-700 transition-all transform hover:scale-105 shadow-lg">
                        Solicitar demo
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>

                <div data-aos="fade-left">
                    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                        <!-- Interface de grabación -->
                        <div class="bg-linear-to-r from-gray-100 to-gray-200 p-6 text-black">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-black">Consulta: Marina López</h3>
                                    <p class="text-gray-600 text-sm">ID: 8547 · Fecha: 22/07/2025</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 bg-white rounded-full animate-spin"></div>
                                    <span class="text-sm text-black">IA procesando…</span>
                                </div>
                            </div>
 　　　　　　　　　　　　
                            <!-- Visualizador de ondas de voz -->
                            <div class="flex items-center justify-center space-x-1 mb-4">
                                <div class="w-1 bg-cyan-400/60 rounded-full animate-pulse" style="height: 20px;"></div>
                                <div class="w-1 bg-cyan-500/80 rounded-full animate-pulse" style="height: 35px; animation-delay: 0.1s;"></div>
                                <div class="w-1 bg-cyan-600 rounded-full animate-pulse" style="height: 45px; animation-delay: 0.2s;"></div>
                                <div class="w-1 bg-cyan-500/80 rounded-full animate-pulse" style="height: 30px; animation-delay: 0.3s;"></div>
                                <div class="w-1 bg-cyan-400/60 rounded-full animate-pulse" style="height: 25px; animation-delay: 0.4s;"></div>
                                <div class="w-1 bg-cyan-600 rounded-full animate-pulse" style="height: 40px; animation-delay: 0.5s;"></div>
                                <div class="w-1 bg-cyan-500/80 rounded-full animate-pulse" style="height: 35px; animation-delay: 0.6s;"></div>
                                <div class="w-1 bg-cyan-400/60 rounded-full animate-pulse" style="height: 20px; animation-delay: 0.7s;"></div>
                            </div>
 　　　　　　　　　　　　
                            <div class="text-center text-lg font-mono mb-4">01:42</div>
 　　　　　　　　　　　　
                            <div class="flex items-center justify-center space-x-4">
                                <button class="w-12 h-12 bg-red-500 hover:bg-red-600 rounded-full flex items-center justify-center transition">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <button class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 012 0v6a1 1 0 11-2 0V7zM12 7a1 1 0 012 0v6a1 1 0 11-2 0V7z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <button class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
 　　　　　　　　　　
                        <!-- Resultado de transcripción -->
                        <div class="p-6">
                            <h4 class="text-lg font-bold text-gray-900 mb-4">Transcripción en tiempo real</h4>
                            <div class="space-y-3 mb-6">
                                <p><strong>Motivo consulta:</strong> Revisión semestral y sensibilidad en molar inferior derecho.</p>
                                <p><strong>Diagnóstico:</strong> Caries incipiente en cara oclusal del 46. Sin otras patologías visibles.</p>
                                <p><strong>Plan tratamiento:</strong> Programar obturación para próxima semana. Reforzar técnica de cepillado.</p>
                                <p><strong>Notas adicionales:</strong> Paciente refiere molestia con bebidas frías en último mes...
                                    <span class="inline-flex space-x-1 ml-2">
                                        <span class="w-1 h-1 bg-gray-400 rounded-full animate-bounce"></span>
                                        <span class="w-1 h-1 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s;"></span>
                                        <span class="w-1 h-1 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s;"></span>
                                    </span>
                                </p>
                            </div>
 　　　　　　　　　　　　
                            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                                <div class="flex items-center space-x-2 mb-2">
                                    <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-amber-800 font-semibold text-sm">Sugerencias IA</span>
                                </div>
                                <div class="text-amber-700 text-sm space-y-1">
                                    <p>- Revisar historial de alergias</p>
                                    <p>- Verificar última radiografía del 46</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Beneficios -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center mb-16">
                <div class="inline-block px-4 py-2 bg-cyan-100 text-cyan-700 rounded-full text-sm font-semibold mb-4" data-aos="fade-up">
                    Ventajas principales
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6" data-aos="fade-up" data-aos-delay="100">
                    Beneficios de la Transcripción Inteligente
                </h2>
                <p class="text-xl text-gray-600" data-aos="fade-up" data-aos-delay="200">
                    Optimiza tu tiempo y mejora la calidad de tus registros clínicos
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Beneficio 1: Ahorro de tiempo -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all" data-aos="fade-up">
                    <div class="w-16 h-16 bg-linear-to-br from-teal-400 to-teal-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Ahorro de tiempo</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Reduce hasta un 85% el tiempo dedicado a documentación. Enfócate en tus pacientes mientras la IA hace el trabajo pesado.
                    </p>
                </div>
                
                <!-- Beneficio 2: Precisión especializada -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-linear-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Precisión especializada</h3>
                    <p class="text-gray-600 leading-relaxed">
                        IA entrenada con terminología fisioterapéutica específica que reconoce procedimientos, medicamentos y diagnósticos fisioterapéuticos.
                    </p>
                </div>
                
                <!-- Beneficio 3: Estructuración automática -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-linear-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Estructuración automática</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Organiza la información en secciones relevantes del historial clínico sin intervención manual.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <x-feature.navigation exclude="smart-transcription" />
    <x-feature.cta />
@endsection

@push('styles')
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

/* Animaciones adicionales para elementos interactivos */
@keyframes wave {
    0%, 100% { height: 20px; }
    50% { height: 45px; }
}

@keyframes typing {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0; }
}

.wave-animation {
    animation: wave 0.8s ease-in-out infinite;
}

.typing-animation {
    animation: typing 1s ease-in-out infinite;
}

/* Efectos hover mejorados */
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

/* Gradientes personalizados para Tailwind 4 */
.bg-linear-to-br {
    background: linear-gradient(to bottom right, var(--tw-gradient-stops));
}

.bg-linear-to-r {
    background: linear-gradient(to right, var(--tw-gradient-stops));
}
</style>
@endpush