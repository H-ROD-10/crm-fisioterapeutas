@extends('landing.layouts.app')

@section('title', 'Transcripción Inteligente de Consultas | CRM Fisio')
@section('meta_description', 'Transcribe automáticamente tus consultas con IA y genera notas clínicas estructuradas en segundos.')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 md:py-32 overflow-hidden bg-linear-to-br from-cyan-50 via-white to-blue-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-up">
                    <div class="inline-block px-4 py-2 bg-cyan-100 text-cyan-700 rounded-full text-sm font-semibold mb-4">
                        Característica principal
                    </div>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="px-3 py-1 bg-linear-to-r from-cyan-500 to-blue-500 text-white rounded-full text-xs font-semibold">
                            IA Médica
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Transcripción Inteligente de Consultas
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Transcribe automáticamente tus consultas con IA especializada en terminología médica y genera notas clínicas estructuradas en segundos.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-cyan-600 mb-2">75%</div>
                            <div class="text-sm text-gray-600">Menos tiempo en documentación</div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-cyan-600 mb-2">98%</div>
                            <div class="text-sm text-gray-600">Precisión en transcripción</div>
                        </div>
                    </div>
                    
                    <a href="{{ route('landing.demo') }}" class="inline-flex items-center px-8 py-4 bg-cyan-600 text-white font-semibold rounded-lg hover:bg-cyan-700 transition-all transform hover:scale-105 shadow-lg">
                        Ver Demo
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>

                <div data-aos="fade-left">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-200">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-900">Transcripción en Vivo</h3>
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                                <span class="text-sm text-gray-600">Grabando</span>
                            </div>
                        </div>
                        <div class="space-y-4 mb-6">
                            <div class="p-4 bg-cyan-50 rounded-lg">
                                <p class="text-sm text-gray-600 mb-1">Paciente:</p>
                                <p class="text-gray-900">"Me duele mucho la rodilla derecha cuando subo escaleras..."</p>
                            </div>
                            <div class="p-4 bg-blue-50 rounded-lg">
                                <p class="text-sm text-gray-600 mb-1">Fisioterapeuta:</p>
                                <p class="text-gray-900">"¿Desde cuándo tiene el dolor? ¿Ha tenido alguna lesión previa?"</p>
                            </div>
                            <div class="p-4 bg-cyan-50 rounded-lg">
                                <p class="text-sm text-gray-600 mb-1">Paciente:</p>
                                <p class="text-gray-900">"Desde hace dos semanas, después de correr..."</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <p class="text-sm text-gray-600 mb-2">Nota clínica generada automáticamente:</p>
                            <div class="p-4 bg-gray-50 rounded-lg text-sm text-gray-700">
                                <strong>Motivo consulta:</strong> Dolor rodilla derecha al subir escaleras<br>
                                <strong>Inicio:</strong> Hace 2 semanas<br>
                                <strong>Desencadenante:</strong> Actividad deportiva (correr)
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