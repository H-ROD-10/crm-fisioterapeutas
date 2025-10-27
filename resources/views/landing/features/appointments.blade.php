@extends('landing.layouts.app')

@section('title', 'Software de Gestión de Citas para Clínicas de Fisioterapia')
@section('meta_description', 'Optimiza tu clínica con nuestro software de gestión de citas para fisioterapeutas. Agenda inteligente, recordatorios automáticos y cero inasistencias.')

@section('content')
    <!-- Hero Feature Section -->
    <x-feature.hero />

    <!-- Feature Benefits Section -->
    <x-feature.benefits />

    <!-- Feature Details Section -->
    <section class="feature-details section-padding">
        <div class="container">
            <x-feature.detail :reverse="true">
                <x-slot name="image">
                    <x-feature.whatsapp-demo />
                </x-slot>
                <x-slot name="content">
                    <x-feature.content.reminders-ia />
                </x-slot>
            </x-feature.detail>

            <x-feature.detail>
                <x-slot name="image">
                    <x-feature.phone-call-demo />
                </x-slot>
                <x-slot name="content">
                    <x-feature.content.voice-ia />
                </x-slot>
            </x-feature.detail>
        </div>
    </section>

    <!-- Feature Navigation Section -->
    <x-feature.navigation exclude="appointments" />

    <!-- CTA Section -->
    <x-feature.cta />
@endsection