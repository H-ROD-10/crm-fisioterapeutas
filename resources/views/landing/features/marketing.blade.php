@extends('landing.layouts.app')

@section('title', 'Marketing para Fisioterapia - CRM Fisio Inteligente')
@section('meta_description', 'Campañas personalizadas con inteligencia artificial que optimizan la captación y fidelización de pacientes, maximizando el retorno de inversión.')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 md:py-32 overflow-hidden bg-linear-to-br from-pink-50 via-white to-rose-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-up">
                    <div class="inline-block px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-sm font-semibold mb-4">
                        Característica exclusiva
                    </div>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="px-3 py-1 bg-linear-to-r from-pink-500 to-rose-500 text-white rounded-full text-xs font-semibold">
                            IA Integrada
                        </span>
                        <span class="px-3 py-1 bg-linear-to-r from-rose-500 to-pink-500 text-white rounded-full text-xs font-semibold">
                            Automatización Inteligente
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Marketing para Fisioterapia
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Campañas personalizadas con inteligencia artificial que optimizan la captación y fidelización de pacientes, maximizando el retorno de inversión.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-pink-600 mb-2">86%</div>
                            <div class="text-sm text-gray-600">Más conversión</div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="text-4xl font-bold text-pink-600 mb-2">3.2x</div>
                            <div class="text-sm text-gray-600">ROI promedio</div>
                        </div>
                    </div>
                    
                    <a href="{{ route('landing.demo') }}" class="inline-flex items-center px-8 py-4 bg-pink-600 text-white font-semibold rounded-lg hover:bg-pink-700 transition-all transform hover:scale-105 shadow-lg">
                        Solicitar Demo
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>

                <div data-aos="fade-left">
                    <div class="bg-white rounded-2xl shadow-2xl p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Marketing Dashboard</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center p-4 bg-emerald-50 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600">Nuevos pacientes</p>
                                    <p class="text-2xl font-bold text-gray-900">324</p>
                                </div>
                                <span class="text-green-600 font-semibold">+18%</span>
                            </div>
                            <div class="flex justify-between items-center p-4 bg-blue-50 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600">Ingresos campañas</p>
                                    <p class="text-2xl font-bold text-gray-900">12.450€</p>
                                </div>
                                <span class="text-green-600 font-semibold">+23%</span>
                            </div>
                            <div class="flex justify-between items-center p-4 bg-purple-50 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600">Coste por contacto</p>
                                    <p class="text-2xl font-bold text-gray-900">2.6€</p>
                                </div>
                                <span class="text-red-600 font-semibold">-12%</span>
                                        <span>Recordatorio de revisión - 25/10</span>
                                    </li>
                                    <li class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Newsletter mensual - 01/11</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-feature.benefits />
    <x-feature.navigation exclude="marketing" />
    <x-feature.cta />
@endsection