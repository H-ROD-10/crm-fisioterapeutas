@extends('landing.layouts.app')

@section('title', 'Sistema de Facturación Inteligente para Fisioterapia | CRM Fisio')
@section('meta_description', 'Automatiza la facturación de tu clínica con recordatorios de pago, análisis financiero y cumplimiento normativo.')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 md:py-32 overflow-hidden bg-linear-to-br from-amber-50 via-white to-orange-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-up">
                    <div class="inline-block px-4 py-2 bg-amber-100 text-amber-700 rounded-full text-sm font-semibold mb-4">
                        Característica principal
                    </div>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="px-3 py-1 bg-linear-to-r from-amber-500 to-orange-500 text-white rounded-full text-xs font-semibold">
                            Automatización Total
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Facturación Inteligente para tu Clínica
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Sistema automatizado de facturación con recordatorios de pago, análisis financiero en tiempo real y cumplimiento normativo garantizado.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-amber-600 mb-2">50%</div>
                            <div class="text-sm text-gray-600">Menos tiempo en facturación</div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-amber-600 mb-2">95%</div>
                            <div class="text-sm text-gray-600">Cobros a tiempo</div>
                        </div>
                    </div>
                    
                    <a href="{{ route('landing.demo') }}" class="inline-flex items-center px-8 py-4 bg-amber-600 text-white font-semibold rounded-lg hover:bg-amber-700 transition-all transform hover:scale-105 shadow-lg">
                        Ver Demo
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>

                <div data-aos="fade-left">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-200">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-900">Factura #2025-0123</h3>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">Pagada</span>
                        </div>
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Paciente:</span>
                                <span class="font-semibold text-gray-900">Ana García</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Fecha:</span>
                                <span class="font-semibold text-gray-900">22/10/2025</span>
                            </div>
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-700">Rehabilitación de rodilla</span>
                                    <span class="font-semibold text-gray-900">60€</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-700">Terapia manual</span>
                                    <span class="font-semibold text-gray-900">45€</span>
                                </div>
                            </div>
                            <div class="border-t-2 border-gray-300 pt-4">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold text-gray-900">Total</span>
                                    <span class="text-2xl font-bold text-amber-600">105€</span>
                                </div>
                            </div>
                        </div>
                        <button class="w-full px-6 py-3 bg-amber-600 text-white font-semibold rounded-lg hover:bg-amber-700 transition-all">
                            Descargar PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-feature.benefits />
    <x-feature.navigation />
    <x-feature.cta />
@endsection