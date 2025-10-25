@extends('landing.layouts.app')

@section('title', 'Asistente Virtual con IA para Fisioterapia | CRM Fisio')
@section('meta_description', 'Chatbot inteligente para atención 24/7, reservas automáticas y resolución de consultas por WhatsApp, web y redes sociales.')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 md:py-32 overflow-hidden bg-linear-to-br from-green-50 via-white to-emerald-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-up">
                    <div class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold mb-4">
                        Característica principal
                    </div>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="px-3 py-1 bg-linear-to-r from-green-500 to-emerald-500 text-white rounded-full text-xs font-semibold">
                            IA Conversacional
                        </span>
                        <span class="px-3 py-1 bg-linear-to-r from-emerald-500 to-teal-500 text-white rounded-full text-xs font-semibold">
                            WhatsApp Integrado
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Asistente Virtual con IA para tu Clínica
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Chatbot inteligente que atiende a tus pacientes 24/7 por WhatsApp, web y redes sociales. Reserva citas, responde consultas y deriva casos complejos automáticamente.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-green-600 mb-2">24/7</div>
                            <div class="text-sm text-gray-600">Atención continua</div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-green-600 mb-2">90%</div>
                            <div class="text-sm text-gray-600">Consultas resueltas</div>
                        </div>
                    </div>
                    
                    <a href="{{ route('landing.demo') }}" class="inline-flex items-center px-8 py-4 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all transform hover:scale-105 shadow-lg">
                        Ver Demo
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>

                <div data-aos="fade-left">
                    <x-feature.whatsapp-demo />
                </div>
            </div>
        </div>
    </section>

    <x-feature.benefits />
    <x-feature.navigation />
    <x-feature.cta />
@endsection