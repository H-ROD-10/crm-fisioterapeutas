@php
  $reviews = [
    ['name' => 'Ana García', 'text' => 'Mi experiencia fue excelente. Me hicieron sentir cómoda durante todo el tratamiento y los resultados fueron increíbles.', 'rating' => 5, 'avatar' => 'maria.jpg', 'tag' => 'Paciente de Fisioterapia'],
    ['name' => 'Roberto Jiménez', 'text' => 'Llegué con miedo por una lesión de rodilla, pero el equipo me dio tranquilidad desde el primer momento. Recuperación rápida y sin dolor.', 'rating' => 5, 'avatar' => 'javi.jpg', 'tag' => 'Paciente de Lesión Deportiva'],
    ['name' => 'María López', 'text' => 'Trato amable y cercano. Han convertido algo que suele ser traumático en una experiencia positiva.', 'rating' => 5, 'avatar' => 'lucia.jpg', 'tag' => 'Paciente de Rehabilitación']
  ];
@endphp

<section id="opiniones" class="py-16 md:py-24 bg-linear-to-br from-primary-600 to-primary-700" aria-labelledby="testimonials-title">
  <div class="container mx-auto px-4">
    <div class="text-center mb-12">
      <span class="inline-block px-4 py-2 mb-4 text-xs font-bold uppercase tracking-wider text-white/80 bg-white/10 rounded-full backdrop-blur-sm" aria-hidden="true">
        Testimonios
      </span>
      <h2 id="testimonials-title" class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white mb-4">
        Lo que dicen nuestros <span class="text-accent-300">pacientes</span>
      </h2>
      <p class="text-white/90 text-lg max-w-2xl mx-auto">
        Historias reales de personas que confiaron en nosotros y hoy se sienten mejor.
      </p>
    </div>
    
    <ul class="grid md:grid-cols-3 gap-6" role="list">
      @foreach($reviews as $index => $rev)
      @php
        $avatarRel = 'img/fisioalcoy/clients/' . ($rev['avatar'] ?? '');
        $hasAvatar = $avatarRel && file_exists(public_path($avatarRel));
        $initials = collect(explode(' ', preg_replace('/\s+/', ' ', $rev['name'])))->map(fn($p)=>substr($p,0,1))->take(2)->implode('');
        $rating = $rev['rating'] ?? 5;
      @endphp
      <li role="listitem">
        <div class="bg-white rounded-xl p-6 shadow-lg h-full flex flex-col animate-fade-in-up" data-delay="{{ $index * 80 }}">
          <div class="flex mb-3" aria-hidden="true">
            @for($i=0;$i<5;$i++)
              <i class="fa-solid fa-star text-yellow-400"></i>
            @endfor
          </div>
          <span class="sr-only">Valoración: {{ $rating }} de 5</span>
          
          <p class="text-gray-700 mb-6 flex grow italic">"{{ $rev['text'] }}"</p>
          
          <div class="flex items-center gap-3 mt-auto pt-4 border-t border-gray-100">
            @if($hasAvatar)
              <img src="{{ asset($avatarRel) }}" alt="{{ $rev['name'] }}" class="w-12 h-12 rounded-full object-cover" width="36" height="36" loading="lazy" decoding="async">
            @else
              <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 font-bold" aria-hidden="true">
                {{ $initials }}
              </div>
            @endif
            <div>
              <div class="font-bold text-gray-900">{{ $rev['name'] }}</div>
              <div class="text-sm text-gray-500">{{ $rev['tag'] ?? 'Paciente' }}</div>
            </div>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
  </div>
</section>