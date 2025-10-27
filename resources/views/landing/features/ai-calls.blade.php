@extends('landing.layouts.app')

@section('title', 'Asistente de Llamadas con IA para Fisioterapia | CRM Fisio')
@section('meta_description', 'Gestión automática de llamadas con reconocimiento de voz y procesamiento de lenguaje natural. Atiende a tus pacientes 24/7.')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 md:py-32 overflow-hidden bg-linear-to-br from-purple-50 via-white to-indigo-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-up">
                    <div class="inline-block px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold mb-4">
                        Característica principal
                    </div>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="px-3 py-1 bg-linear-to-r from-purple-500 to-pink-500 text-white rounded-full text-xs font-semibold">
                            Voz Natural IA
                        </span>
                        <span class="px-3 py-1 bg-linear-to-r from-indigo-500 to-purple-500 text-white rounded-full text-xs font-semibold">
                            Reconocimiento Avanzado
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Asistente de Llamadas con IA
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Sistema de IA que responde llamadas telefónicas con voz natural, gestiona citas, responde consultas y deriva casos complejos al personal cuando es necesario.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-purple-600 mb-2">24/7</div>
                            <div class="text-sm text-gray-600">Disponibilidad total</div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-purple-600 mb-2">85%</div>
                            <div class="text-sm text-gray-600">Resolución autónoma</div>
                        </div>
                    </div>
                    
                    <a href="{{ route('landing.demo') }}" class="inline-flex items-center px-8 py-4 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition-all transform hover:scale-105 shadow-lg">
                        Ver Demo
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>

                <div data-aos="fade-left">
                    <x-feature.phone-call-demo />
                </div>
            </div>
        </div>
    </section>

    <x-feature.benefits />
    <x-feature.navigation exclude="ai-calls" />
    <x-feature.cta />
@endsection