@php
  $services = [
    ['title' => 'Rehabilitación de lesiones', 'desc' => 'Recupera fuerza, movilidad y confianza tras una lesión con un plan 100% personalizado.', 'icon' => 'fa-bandage', 'highlight' => false],
    ['title' => 'Masaje terapéutico', 'desc' => 'Descarga muscular efectiva para aliviar tensiones y mejorar tu bienestar desde la primera sesión.', 'icon' => 'fa-spa', 'highlight' => false],
    ['title' => 'Fisioterapia deportiva', 'desc' => 'Prevención y recuperación para volver antes, más fuerte y con menor riesgo de recaída.', 'icon' => 'fa-person-running', 'highlight' => false],
    ['title' => 'Espalda y cervicales', 'desc' => 'Tratamiento integral para lumbalgia y cervicalgia: dolor bajo control y mejor postura.', 'icon' => 'fa-person-rays', 'highlight' => false],
    ['title' => 'Terapia manual avanzada', 'desc' => 'Técnicas manuales de alto impacto para liberar restricciones y ganar movilidad.', 'icon' => 'fa-hands', 'highlight' => false],
    ['title' => 'Prevención y recuperación funcional', 'desc' => 'Mejora tu rendimiento diario con ejercicio terapéutico y reeducación del movimiento.', 'icon' => 'fa-heart-pulse', 'highlight' => false],
  ];
@endphp

<section id="servicios" class="py-16 md:py-24 bg-white" aria-labelledby="services-title">
  <div class="container mx-auto px-4">
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between mb-12">
      <div class="lg:w-2/3">
        <span class="inline-block px-4 py-2 mb-4 text-xs font-bold uppercase tracking-wider text-primary-700 bg-primary-50 rounded-full">
          Servicios de Fisioterapia
        </span>
        <h2 id="services-title" class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">
          <span class="text-accent-500">Recupera</span> tu bienestar con nuestros tratamientos
        </h2>
      </div>
      <div class="mt-6 lg:mt-0">
        <a href="#contacto" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold group">
          Ver todos los servicios 
          <span class="ml-2 transform group-hover:translate-x-1 transition-transform duration-300">
            <i class="fa-solid fa-arrow-right"></i>
          </span>
        </a>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($services as $s)
        <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 flex flex-col h-full {{ $s['highlight'] ? 'bg-linear-to-br from-accent-50 to-accent-100 border-2 border-accent-300' : '' }}">
          <div class="w-14 h-14 bg-primary-100 rounded-lg flex items-center justify-center text-primary-600 text-2xl mb-4">
            <i class="fa-solid {{ $s['icon'] }}" aria-hidden="true"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-800">{{ $s['title'] }}</h3>
          <p class="text-gray-600 mb-6 grow">{{ $s['desc'] }}</p>
          <div class="mt-auto">
            <a class="inline-flex items-center text-sm font-semibold text-green-600 hover:text-green-700 transition-colors duration-300" target="_blank" rel="noopener" href="https://wa.me/34659743061?text=Hola%2C%20me%20gustar%C3%ADa%20m%C3%A1s%20informaci%C3%B3n%20sobre%20{{ urlencode($s['title']) }}">
              <i class="fa-brands fa-whatsapp mr-2" aria-hidden="true"></i>
              <span>Solicitar información</span>
            </a>
          </div>
        </div>
      @endforeach

      <!-- Wide CTA card -->
      <div class="md:col-span-2 lg:col-span-2 bg-linear-to-br from-primary-500 to-primary-600 rounded-xl p-8 text-white flex flex-col items-center text-center justify-center">
        <div class="w-16 h-16 bg-white/20 rounded-lg flex items-center justify-center text-white text-3xl mb-4">
          <i class="fa-solid fa-calendar-check"></i>
        </div>
        <h3 class="text-2xl font-bold mb-3">Empieza hoy tu recuperación</h3>
        <p class="mb-6 text-white/90">Agenda tu primera valoración y comienza un plan efectivo y personalizado.</p>
        <a class="inline-flex items-center px-6 py-3 bg-white text-primary-600 hover:bg-gray-100 font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl js-open-booking" href="#reserva">
          Reservar cita 
          <span class="ml-2">
            <i class="fa-solid fa-arrow-right"></i>
          </span>
        </a>
      </div>
    </div>
  </div>
</section>