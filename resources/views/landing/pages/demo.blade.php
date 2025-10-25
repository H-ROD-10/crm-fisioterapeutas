@extends('landing.layouts.app')

@section('title', 'Solicita una Demo Gratuita | CRM Fisioterapia Inteligente')
@section('meta_description', 'Solicita una demo gratuita de 14 días de nuestro CRM para clínicas de fisioterapia. Sin tarjeta de crédito. Prueba todas las funcionalidades.')

@section('content')
    <!-- Hero Section -->
    <section class="py-20 bg-linear-to-br from-emerald-50 to-teal-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-block px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold mb-6" data-aos="fade-up">
                    Demo Gratuita
                </div>
                <h1 class="text-5xl font-bold text-gray-900 mb-6" data-aos="fade-up" data-aos-delay="100">
                    Prueba CRM Fisio <span class="text-emerald-600">sin compromiso</span>
                </h1>
                <p class="text-xl text-gray-600 mb-8" data-aos="fade-up" data-aos-delay="200">
                    14 días de acceso completo • Sin tarjeta de crédito • Configuración personalizada incluida
                </p>
                
                <!-- Trust Badges -->
                <div class="flex flex-wrap items-center justify-center gap-8 mb-12" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700 font-medium">Sin permanencia</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700 font-medium">Soporte incluido</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700 font-medium">Datos seguros</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Form & Video Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Left: Video Demo -->
                    <div data-aos="fade-right">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Ve CRM Fisio en acción</h2>
                        <p class="text-gray-600 mb-8">
                            Descubre cómo nuestro CRM puede transformar la gestión de tu clínica de fisioterapia en solo 3 minutos.
                        </p>
                        
                        <!-- Video Placeholder -->
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-gray-900 aspect-video group cursor-pointer">
                            <div class="absolute inset-0 flex items-center justify-center z-10">
                                <button class="w-20 h-20 bg-white/90 hover:bg-white rounded-full flex items-center justify-center transition-all transform group-hover:scale-110 shadow-xl">
                                    <svg class="w-10 h-10 text-emerald-600 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                    </svg>
                                </button>
                            </div>
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-linear-to-t from-gray-900/80 via-gray-900/40 to-transparent z-0"></div>
                            <!-- Imagen de fondo -->
                            <img src="{{ asset('images/fisioterapia8.jpeg') }}" alt="Demo CRM Fisioterapia" class="w-full h-full object-cover">
                            <!-- Badge de video -->
                            <div class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center space-x-1 z-10">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                </svg>
                                <span>3:24</span>
                            </div>
                        </div>
                        
                        <!-- Features List -->
                        <div class="mt-8 space-y-4">
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-emerald-600 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Configuración en 10 minutos</h4>
                                    <p class="text-sm text-gray-600">Te ayudamos a configurar tu cuenta y migrar tus datos</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-emerald-600 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Formación personalizada</h4>
                                    <p class="text-sm text-gray-600">Sesión de onboarding para tu equipo incluida</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-emerald-600 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Soporte prioritario</h4>
                                    <p class="text-sm text-gray-600">Asistencia directa durante tu periodo de prueba</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Demo Form -->
                    <div data-aos="fade-left">
                        @livewire('landing.contact-form')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Carousel Section -->
    <section class="py-20 bg-linear-to-br from-teal-50 to-emerald-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4" data-aos="fade-up">
                        Explora nuestra plataforma
                        ¿Qué incluye tu demo gratuita?
                    </h2>
                    <p class="text-xl text-gray-600" data-aos="fade-up" data-aos-delay="100">
                        Acceso completo a todas las funcionalidades durante 14 días
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up">
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">CRM Completo</h3>
                        <p class="text-gray-600 text-sm">Gestión de pacientes, citas, historial clínico y facturación</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">IA Telefónica</h3>
                        <p class="text-gray-600 text-sm">100 minutos de llamadas automáticas para probar</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Recordatorios</h3>
                        <p class="text-gray-600 text-sm">200 recordatorios automáticos por SMS/Email/WhatsApp</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">WhatsApp Bot</h3>
                        <p class="text-gray-600 text-sm">100 conversaciones con chatbot inteligente</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="400">
                        <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Formación</h3>
                        <p class="text-gray-600 text-sm">Sesión de onboarding personalizada para tu equipo</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="500">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Soporte 24/7</h3>
                        <p class="text-gray-600 text-sm">Asistencia prioritaria durante todo el periodo de prueba</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    @livewire('landing.faq-accordion')

    <!-- WhatsApp Button -->
    @livewire('landing.whatsapp-button')
@endsection