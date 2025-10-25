@props(['items' => []])
@php
  $defaultItems = [
    ['q' => '¿Necesito receta médica para acudir a fisioterapia?', 'a' => 'No es necesario. Puedes reservar cita directamente. Si ya tienes diagnóstico médico, mejor, pero no es obligatorio.'],
    ['q' => '¿Cuánto dura una sesión?', 'a' => 'Las sesiones suelen durar entre 45 y 60 minutos según la valoración y tratamiento.'],
    ['q' => '¿Tratáis lesión deportiva y dolor de espalda?', 'a' => 'Sí, trabajamos con lesiones deportivas, dolor cervical y lumbar, hombro, rodilla y rehabilitación postquirúrgica.'],
    ['q' => '¿Ofrecéis tratamiento manual y ejercicio terapéutico?', 'a' => 'Combinamos terapia manual, neuromodulación del dolor y un plan de ejercicios personalizado.'],
    ['q' => '¿Puedo cancelar o cambiar mi cita?', 'a' => 'Sí, avísanos con antelación y reprogramamos sin problema.'],
    ['q' => '¿Atendéis mutuas?', 'a' => 'Trabajamos principalmente con pacientes privados. Si tu mutua reembolsa fisioterapia, te daremos factura.'],
    ['q' => '¿Hay parking o fácil acceso?', 'a' => 'Sí, estamos a pie de calle y hay aparcamiento cercano. Te indicamos la mejor ruta al reservar.'],
    ['q' => '¿Qué debo llevar a mi primera cita?', 'a' => 'Ropa cómoda, informes o pruebas si tienes, y ganas de empezar tu recuperación.'],
  ];
  $faqs = count($items) ? $items : $defaultItems;
@endphp

<div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
  <h3 id="faq-title" class="text-2xl font-extrabold text-white mb-6">Preguntas frecuentes</h3>
  <div class="space-y-3" role="list">
    @foreach($faqs as $idx => $item)
      <details class="group bg-white/10 backdrop-blur-sm rounded-lg overflow-hidden transition-all duration-300 hover:bg-white/15" role="listitem">
        <summary class="flex items-center justify-between cursor-pointer p-4 text-white font-semibold list-none">
          <span class="pr-4">{{ $item['q'] }}</span>
          <i class="fa-solid fa-chevron-down text-accent-300 transition-transform duration-300 group-open:rotate-180"></i>
        </summary>
        <div class="px-4 pb-4 text-white/90 text-sm leading-relaxed">
          {{ $item['a'] }}
        </div>
      </details>
    @endforeach
  </div>
</div>