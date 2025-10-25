@props(['images' => []])

@php
  $defaultImages = [
    'https://demo.awaikenthemes.com/physiocare/wp-content/uploads/2024/07/gallery-1.jpg',
    'https://demo.awaikenthemes.com/physiocare/wp-content/uploads/2024/07/gallery-2.jpg',
    'https://demo.awaikenthemes.com/physiocare/wp-content/uploads/2024/07/gallery-3.jpg',
    'https://demo.awaikenthemes.com/physiocare/wp-content/uploads/2024/07/gallery-4.jpg',
    'https://demo.awaikenthemes.com/physiocare/wp-content/uploads/2024/07/gallery-5.jpg',
    'https://demo.awaikenthemes.com/physiocare/wp-content/uploads/2024/07/gallery-6.jpg',
  ];
  $imgs = count($images) ? $images : $defaultImages;
  $row1 = $imgs;
@endphp

<section class="py-8 overflow-hidden bg-gray-50" aria-label="Galería de tratamientos y clínica">
  <div class="relative">
    <div class="flex animate-marquee space-x-4">
      <div class="flex space-x-4 min-w-full">
        @foreach ($row1 as $src)
          <div class="flex shrink-0 w-80 h-64">
            <img src="{{ $src }}" alt="Galería FisioAlcoy" class="w-full h-full object-cover rounded-xl shadow-md" loading="lazy">
          </div>
        @endforeach
      </div>
      <div class="flex space-x-4 min-w-full" aria-hidden="true">
        @foreach ($row1 as $src)
          <div class="flex shrink-0 w-80 h-64">
            <img src="{{ $src }}" alt="" class="w-full h-full object-cover rounded-xl shadow-md" loading="lazy">
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<style>
@keyframes marquee {
  0% { transform: translateX(0); }
  100% { transform: translateX(-100%); }
}
.animate-marquee {
  animation: marquee 28s linear infinite;
}
.animate-marquee:hover {
  animation-play-state: paused;
}
</style>