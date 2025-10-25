@php use Illuminate\Support\Str; @endphp
<section id="profesionales" class="py-16 md:py-24 bg-gray-50" aria-labelledby="team-title">
  <div class="container mx-auto px-4">
    <div class="text-center mb-12">
      <span class="inline-block px-4 py-2 mb-4 text-xs font-bold uppercase tracking-wider text-primary-700 bg-primary-50 rounded-full" aria-hidden="true">
        Nuestros especialistas
      </span>
      <h2 id="team-title" class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">
        Tu equipo de confianza
      </h2>
      <p class="text-gray-600 text-lg max-w-2xl mx-auto">
        Contamos con especialistas en todas las áreas de la fisioterapia para ofrecerte un tratamiento integral.
      </p>
    </div>
    
    <ul class="grid md:grid-cols-3 gap-8" role="list">
      @php
        $team = [
          [
            'nombre' => 'Laura Martínez',
            'rol' => 'Fisioterapeuta',
            'especialidad' => 'Dolor de espalda y postura',
            'foto_url' => asset('images/laura-Martinez-Fisio.jpeg'),
            'icon' => 'fa-user-doctor',
            'desc' => 'Especialista en terapia manual y ejercicio terapéutico con enfoque postural.'
          ],
          [
            'nombre' => 'Carlos Ruiz',
            'rol' => 'Readaptador físico',
            'especialidad' => 'Lesiones deportivas',
            'foto_url' => asset('images/Carlos-Ruiz-Fisio.jpeg'),
            'icon' => 'fa-person-running',
            'desc' => 'Experto en recuperación funcional y prevención de recaídas.'
          ],
          [
            'nombre' => 'Ana López',
            'rol' => 'Fisioterapeuta',
            'especialidad' => 'Suelo pélvico y recuperación',
            'foto_url' => asset('images/Ana-Lopez-Fisio.jpeg'),
            'icon' => 'fa-venus',
            'desc' => 'Atención especializada y protocolos basados en evidencia.'
          ],
        ];
      @endphp
      @foreach($team as $index => $pro)
        @php
          $photoUrl = $pro['foto_url'] ?? null;
          $initials = Str::of($pro['nombre'])->explode(' ')->map(fn($p)=>Str::substr($p,0,1))->take(2)->implode('');
        @endphp
        <li role="listitem">
          <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 h-full flex flex-col items-center text-center animate-fade-in-up" data-delay="{{ $index * 80 }}">
            @if($photoUrl)
              <img src="{{ $photoUrl }}" alt="Foto de {{ $pro['nombre'] }} - {{ $pro['rol'] }}" class="w-32 h-32 rounded-full object-cover mb-4 shadow-md" loading="lazy">
            @else
              <div class="w-32 h-32 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 text-4xl mb-4" aria-hidden="true">
                <i class="fa-solid {{ $pro['icon'] ?? 'fa-user' }}" aria-hidden="true"></i>
              </div>
            @endif
            <h3 class="text-xl font-extrabold mb-1 text-gray-900">{{ $pro['nombre'] }}</h3>
            <div class="text-sm text-primary-600 font-semibold mb-3">{{ $pro['rol'] ?? $pro['especialidad'] }}</div>
            <p class="text-sm text-gray-600 mb-4 flex grow">{{ $pro['desc'] ?? $pro['especialidad'] }}</p>
            <div class="flex gap-2 mt-auto" aria-label="Redes sociales de {{ $pro['nombre'] }}">
              <a href="#" class="w-10 h-10 bg-primary-50 hover:bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center transition-colors duration-300" aria-label="LinkedIn de {{ $pro['nombre'] }}">
                <i class="fa-brands fa-linkedin-in" aria-hidden="true"></i>
              </a>
              <a href="#" class="w-10 h-10 bg-primary-50 hover:bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center transition-colors duration-300" aria-label="Facebook de {{ $pro['nombre'] }}">
                <i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</section>