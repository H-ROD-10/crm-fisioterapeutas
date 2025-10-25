@props(['services' => collect(), 'bg' => null, 'video' => null, 'showWizard' => true])

<section id="inicio" class="relative min-h-screen flex items-center {{ $bg && !$video ? 'bg-cover bg-center' : '' }} {{ !$showWizard ? 'justify-center' : '' }}" @if($bg && !$video) style="background-image: url('{{ asset($bg) }}');" @endif>
  @if($video)
    @php
      $videoSrc = (is_string($video) && \Illuminate\Support\Str::startsWith($video, ['http://','https://','//'])) ? $video : asset($video);
    @endphp
    <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
      <video class="w-full h-full object-cover" autoplay muted loop playsinline preload="metadata">
        <source src="{{ $videoSrc }}" type="video/mp4">
      </video>
      <div class="absolute inset-0 bg-linear-to-br from-primary-900/80 via-primary-800/70 to-primary-900/80"></div>
    </div>
  @endif
  
  <!-- Floating decorative elements -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="absolute top-20 left-10 w-16 h-16 bg-white/10 rounded-full animate-float-slow"></div>
    <div class="absolute top-40 right-20 w-24 h-24 bg-white/5 rounded-full animate-float-medium"></div>
    <div class="absolute bottom-32 left-1/4 w-32 h-32 bg-white/10 rounded-full animate-float-slow"></div>
    <div class="absolute bottom-20 right-10 w-20 h-20 bg-white/5 rounded-full animate-float-fast"></div>
    <div class="absolute top-1/2 right-1/3 w-28 h-28 bg-white/5 rounded-full animate-float-medium"></div>
  </div>

  <div class="container mx-auto px-4 relative z-10 py-20">
    <div class="grid lg:grid-cols-2 gap-8 items-center">
      <div class="{{ !$showWizard ? 'text-center mx-auto max-w-3xl' : '' }}">
        <span class="inline-flex items-center justify-center px-4 py-2 mb-4 text-xs font-bold uppercase tracking-wider text-primary-700 bg-primary-50 rounded-full animate-fade-in-up" data-delay="0">
          Clínica de fisioterapia en Alcoy
        </span>
        
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 text-white leading-tight animate-fade-in-up" data-delay="60">
          <span class="text-accent-400">Cada paciente es único</span>, cada lesión necesita un cuidado diferente
        </h2>
        
        <div class="flex flex-wrap gap-3 mb-6 animate-fade-in-up {{ !$showWizard ? 'justify-center' : '' }}" data-delay="160">
          <a href="#reserva" class="inline-flex items-center px-6 py-3 bg-accent-500 hover:bg-accent-600 text-white font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
            <i class="fa-regular fa-calendar mr-2"></i> Reservar Cita
          </a>
          <a href="#servicios" class="inline-flex items-center px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-lg transition-all duration-300 backdrop-blur-sm border border-white/20">
            Nuestros Servicios
          </a>
        </div>
        
        <ul class="space-y-2 text-white/90 animate-fade-in-up" data-delay="260">
          <li class="flex items-center {{ !$showWizard ? 'justify-center' : '' }}">
            <i class="fa-solid fa-check mr-3 text-accent-400"></i> Tecnología avanzada
          </li>
          <li class="flex items-center {{ !$showWizard ? 'justify-center' : '' }}">
            <i class="fa-solid fa-check mr-3 text-accent-400"></i> Profesionales certificados
          </li>
        </ul>
      </div>
      
      @if($showWizard)
      <div class="animate-fade-in-right" data-delay="120" id="reserva">
        <div class="animate-float-slow">
          <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="bg-linear-to-r from-primary-500 to-primary-600 px-6 py-4 text-center">
              <h5 class="text-xl font-bold text-white mb-0">Reserva tu Cita</h5>
            </div>
            
            <div class="p-6 text-center">
              <div class="flex justify-center mb-4">
                <x-branding.logo size="md" />
              </div>
              
              <h6 class="text-lg font-semibold mb-4 text-gray-800">¿Necesitas fisioterapia?</h6>
              
              <ul class="text-left mx-auto text-sm text-gray-600 mb-6 space-y-2 max-w-xs">
                <li class="flex items-center">
                  <i class="fa-solid fa-circle text-primary-500 mr-2" style="font-size:8px"></i>
                  <span>Reserva en <strong>menos de un minuto</strong></span>
                </li>
                <li class="flex items-center">
                  <i class="fa-solid fa-circle text-primary-500 mr-2" style="font-size:8px"></i>
                  <span>Te atendemos lo antes posible</span>
                </li>
                <li class="flex items-center">
                  <i class="fa-solid fa-circle text-primary-500 mr-2" style="font-size:8px"></i>
                  <span>Sin compromiso y 100% gratuito</span>
                </li>
              </ul>
              
              <p id="wizard-helper" class="sr-only">Al pulsar, se abrirá el asistente de reserva con 4 pasos: tratamiento, profesional, fecha y hora, y confirmación.</p>
              
              <button type="button" class="w-full px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl js-start-booking" aria-controls="hero-wizard-wrap" aria-expanded="false" aria-describedby="wizard-helper">
                Reservar ahora
              </button>
            </div>
          </div>
        </div>
        
        <div id="hero-wizard-wrap" class="hidden mt-6" aria-hidden="true">
          <x-booking.wizard :services="$services" :compact="true" />
        </div>
      </div>
      @endif
    </div>
  </div>
</section>