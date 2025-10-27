@extends('landing.layouts.app')

@section('title', 'Asistente de Llamadas con IA para Fisioterapia | CRM Fisio')
@section('meta_description', 'Gestión automática de llamadas con reconocimiento de voz y procesamiento de lenguaje natural. Atiende a tus pacientes 24/7.')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 md:py-32 overflow-hidden bg-linear-to-br from-purple-50 via-white to-indigo-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-up">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                        Asistente de Llamadas con IA
                    </h1>
                    <p class="text-xl text-gray-600 mb-8">
                        Sistema de IA que responde llamadas telefónicas con voz natural.
                    </p>
                    <a href="{{ route('landing.demo') }}" class="inline-flex items-center px-8 py-4 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700">
                        Ver Demo
                    </a>
                </div>
                <div data-aos="fade-left">
                    <x-feature.phone-call-demo />
                </div>
            </div>
        </div>
    </section>

    <x-feature.benefits />
    <x-feature.navigation exclude="ai-phone" />
    <x-feature.cta />
@endsection