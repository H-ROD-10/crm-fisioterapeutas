<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Clínica de Fisioterapia en Alcoy | FisioAlcoy')</title>
  <meta name="description" content="@yield('meta_description', 'Fisioterapia avanzada en Alcoy. Tratamientos personalizados, recuperación de lesiones y dolor de espalda. Reserva tu cita online en minutos.')">

  <link rel="icon" href="{{ asset('images/fisioalcoy-logo.svg') }}" type="image/svg+xml">

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @yield('styles')
</head>
<body class="font-sans antialiased bg-white">
  <!-- Nav -->
  <nav class="fixed top-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md shadow-sm">
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-between h-20">
        <a class="flex items-center" href="#inicio">
          <img src="{{ asset('images/fisioalcoy-logo-mint.svg') }}" alt="FisioAlcoy" class="h-10">
        </a>
        
        <button class="lg:hidden text-gray-700 hover:text-primary-600" type="button" id="mobile-menu-button">
          <i class="fa-solid fa-bars text-2xl"></i>
        </button>
        
        <div class="hidden lg:flex items-center space-x-8">
          <a class="text-gray-700 hover:text-primary-600 font-semibold transition-colors duration-300" href="#inicio">Inicio</a>
          <a class="text-gray-700 hover:text-primary-600 font-semibold transition-colors duration-300" href="#servicios">Servicios</a>
          <a class="text-gray-700 hover:text-primary-600 font-semibold transition-colors duration-300" href="#profesionales">Equipo</a>
          <a class="text-gray-700 hover:text-primary-600 font-semibold transition-colors duration-300" href="https://wa.me/34659743061?text=Hola%2C%20me%20gustar%C3%ADa%20informaci%C3%B3n%20y%20reservar%20una%20cita%20de%20fisioterapia" target="_blank" rel="noopener">WhatsApp</a>
          <a class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition-all duration-300" href="tel:+34865760828">
            +34 865760828 <i class="fa-solid fa-phone ml-2"></i>
          </a>
        </div>
      </div>
    </div>
    
    <!-- Mobile menu -->
    <div class="hidden lg:hidden bg-white border-t border-gray-200" id="mobile-menu">
      <div class="container mx-auto px-4 py-4 space-y-3">
        <a class="block text-gray-700 hover:text-primary-600 font-semibold" href="#inicio">Inicio</a>
        <a class="block text-gray-700 hover:text-primary-600 font-semibold" href="#servicios">Servicios</a>
        <a class="block text-gray-700 hover:text-primary-600 font-semibold" href="#profesionales">Equipo</a>
        <a class="block text-gray-700 hover:text-primary-600 font-semibold" href="https://wa.me/34659743061" target="_blank">WhatsApp</a>
        <a class="block px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg text-center" href="tel:+34865760828">
          +34 865760828 <i class="fa-solid fa-phone ml-2"></i>
        </a>
      </div>
    </div>
  </nav>

  <main class="pt-20">
    @yield('content')
  </main>

  <x-fisioalcoy.footer />

  @yield('scripts')
  
 
</body>
</html>