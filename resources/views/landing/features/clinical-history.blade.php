@extends('landing.layouts.app')

@section('title', 'Historial Clínico Digital para Fisioterapia | CRM Fisio')
@section('meta_description', 'Gestiona expedientes digitales completos con búsqueda inteligente, análisis de datos y acceso seguro desde cualquier dispositivo.')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 md:py-32 overflow-hidden bg-linear-to-br from-blue-50 via-white to-indigo-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-up">
                    <div class="inline-block px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold mb-4">
                        Característica principal
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Historial Clínico Digital Inteligente
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Gestiona expedientes completos de tus pacientes con búsqueda inteligente, análisis de datos y acceso seguro desde cualquier dispositivo.
                    </p>
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-blue-600 mb-2">100%</div>
                            <div class="text-sm text-gray-600">Digital y seguro</div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-blue-600 mb-2">80%</div>
                            <div class="text-sm text-gray-600">Menos tiempo en búsqueda</div>
                        </div>
                    </div>
                    <a href="{{ route('landing.demo') }}" class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all transform hover:scale-105 shadow-lg">
                        Ver Demo
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
                <div data-aos="fade-left">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Expediente del Paciente</h3>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4 p-4 bg-blue-50 rounded-lg">
                                <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">AG</div>
                                <div>
                                    <h4 class="font-bold text-gray-900">Ana García</h4>
                                    <p class="text-sm text-gray-600">ID: 00123 · Última visita: 15/10/2025</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <p class="text-sm text-gray-600 mb-1">Edad</p>
                                    <p class="font-bold text-gray-900">34 años</p>
                                </div>
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <p class="text-sm text-gray-600 mb-1">Visitas</p>
                                    <p class="font-bold text-gray-900">12 sesiones</p>
                                </div>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-600 mb-2">Diagnóstico actual</p>
                                <p class="text-gray-900">Rehabilitación de rodilla post-operatoria</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-feature.benefits />
    <x-feature.navigation />
    <x-feature.cta />
@endsection