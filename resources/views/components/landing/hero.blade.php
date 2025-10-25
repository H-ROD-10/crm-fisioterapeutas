@props(['title' => 'Software para Clínicas de', 'titleSuffix' => 'Fisioterapia'])

<section id="hero" class="relative py-20 lg:py-32 overflow-hidden bg-linear-to-br from-emerald-50 via-white to-teal-50">
    <!-- Floating Elements Background -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-20 left-10 w-16 h-16 text-emerald-400 opacity-20 animate-float">
            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z"/>
            </svg>
        </div>
        <div class="absolute top-40 right-20 w-20 h-20 text-teal-400 opacity-20 animate-float-delayed">
            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                <path d="M10.5 13H8v-3h2.5V7.5h3V10H16v3h-2.5v2.5h-3V13zM12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91 4.59-1.15 8-5.86 8-10.91V5l-8-3z"/>
            </svg>
        </div>
        <div class="absolute bottom-32 left-1/4 w-12 h-12 text-emerald-300 opacity-20 animate-float">
            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
        </div>
        <div class="absolute bottom-20 right-1/3 w-14 h-14 text-teal-300 opacity-20 animate-float-delayed">
            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
            </svg>
        </div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Column: Content -->
            <div class="space-y-6" data-aos="fade-up" data-aos-delay="100">
                <!-- Trend Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold">
                    <span class="mr-2">🚀</span>
                    La #1 solución para clínicas de fisioterapia
                </div>
                
                <!-- Main Title -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                    <span class="bg-linear-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">{{ $title }}</span>
                    @if($titleSuffix)
                        <br>
                        <span class="text-gray-900">{{ $titleSuffix }}</span>
                    @endif
                </h1>
                
                <!-- Subtitle -->
                <p class="text-lg md:text-xl text-gray-600 leading-relaxed">
                    Gestiona citas, evalua tratamientos, comunica resultados y mejora la comunicación con tus pacientes con nuestro 
                    <span class="font-semibold text-emerald-600">sistema completo con IA</span> 
                    para profesionales de la fisioterapia.
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('landing.demo') }}" class="inline-flex items-center justify-center px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Ver Demo
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="#pricing" class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-50 text-emerald-600 font-semibold rounded-lg transition-all duration-300 border-2 border-emerald-600 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Ver Planes
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-8">
                    <!-- Rating Stat -->
                    <div class="space-y-2">
                        <div class="flex items-center space-x-1 text-yellow-400">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" opacity="0.5"/></svg>
                            <span class="ml-2 text-gray-900 font-bold">4.8/5</span>
                        </div>
                        <p class="text-sm text-gray-600">120+ opiniones verificadas</p>
                    </div>
                    
                    <!-- Clinics Stat -->
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 6h-4V5h4v4zm-6-4v4H8V5h4zM8 11h4v4H8v-4zm6 4v-4h4v4h-4z"/>
                                </svg>
                            </div>
                            <span class="text-3xl font-bold text-gray-900">250+</span>
                        </div>
                        <p class="text-sm text-gray-600">Centros de fisioterapia confían en nosotros</p>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: CRM Dashboard -->
            <div class="relative" data-aos="fade-up" data-aos-delay="200">
                <div class="relative">
                    <div class="bg-white rounded-2xl shadow-2xl p-6 space-y-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                CRM
                            </div>
                            <span class="text-lg font-bold text-gray-900">Nombre de tu Clínica</span>
                        </div>
                        <div class="flex items-center space-x-3 text-gray-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                        </div>
                    </div>
                    
                    <!-- Metrics Cards -->
                    <div class="grid grid-cols-3 gap-4">
                        <!-- Citas -->
                        <div class="bg-gray-50 rounded-xl p-4 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Citas</span>
                                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10z"/></svg>
                                </div>
                            </div>
                            <div class="text-3xl font-bold text-gray-900">8</div>
                            <div class="text-xs text-green-600 font-semibold">+20% vs semana anterior</div>
                        </div>
                        
                        <!-- Pacientes -->
                        <div class="bg-gray-50 rounded-xl p-4 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Pacientes</span>
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                                </div>
                            </div>
                            <div class="text-3xl font-bold text-gray-900">248</div>
                            <div class="text-xs text-green-600 font-semibold">↑ 12%</div>
                        </div>
                        
                        <!-- Ingresos -->
                        <div class="bg-gray-50 rounded-xl p-4 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Ingresos</span>
                                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
                                </div>
                            </div>
                            <div class="text-3xl font-bold text-gray-900">18.450€</div>
                            <div class="flex items-center space-x-1">
                                <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-500" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Próximas Citas -->
                    <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-gray-900">Próximas citas</h3>
                            <button class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center text-white hover:bg-emerald-700 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                            </button>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-900">09:30</div>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Marta R.</div>
                                    <div class="text-sm text-gray-500">Valoración</div>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Pendiente</span>
                        </div>
                    </div>
                </div>
                
                <!-- Floating Card 1 -->
                <div class="absolute -left-4 top-4/4 bg-white rounded-xl shadow-xl p-4 items-center space-x-3 animate-float hidden lg:flex">
                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-900">Sesiones optimizadas</span>
                </div>
                
                <!-- Floating Card 2 -->
                <div class="absolute -right-4 bottom-1/4 bg-white rounded-xl shadow-xl p-4 items-center space-x-3 animate-float-delayed hidden lg:flex">
                    <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11 2v20c-5.07-.5-9-4.79-9-10s3.93-9.5 9-10zm2.03 0v8.99H22c-.47-4.74-4.24-8.52-8.97-8.99zm0 11.01V22c4.74-.47 8.5-4.25 8.97-8.99h-8.97z"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-900">+40% recuperación</span>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    @keyframes float-delayed {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-float-delayed {
        animation: float-delayed 8s ease-in-out infinite;
    }
</style>
@endpush