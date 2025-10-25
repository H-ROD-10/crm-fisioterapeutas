@extends('landing.layouts.app')

@section('title', 'CRM Fisioterapia Inteligente - Gestión con IA para Clínicas')

@section('meta_description', 'Software de gestión inteligente para clínicas de fisioterapia con IA. Optimiza citas, facturación y marketing en una sola plataforma.')

@section('content')
    <!-- Hero Section -->
    <x-landing.hero 
        title="Software para Clínicas de" 
        titleSuffix="Fisioterapia" 
    />

    <!-- Features Section -->
    <x-landing.features />

    <!-- Benefits Section -->
    <x-landing.benefits />

    <!-- Testimonials Section -->
    <x-landing.testimonials />

    <!-- Pricing Section -->
    <x-landing.pricing />

    <!-- FAQ Section -->
    @livewire('landing.faq-accordion')

    <!-- Contact Form Section -->
    @livewire('landing.contact-form')

    <!-- WhatsApp Floating Button -->
    @livewire('landing.whatsapp-button')

    <!-- Final CTA Section -->
    <section class="py-20 bg-linear-to-br from-emerald-600 to-teal-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">¿Listo para transformar tu clínica?</h2>
            <p class="text-xl mb-8 opacity-90">Únete a más de 250 clínicas que ya confían en nosotros</p>
            <a href="{{ route('landing.demo') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-100 text-emerald-600 font-semibold rounded-lg transition-colors shadow-lg">
                Solicitar Demo Gratuita
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </section>
@endsection
