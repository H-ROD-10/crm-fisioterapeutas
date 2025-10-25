<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Metatags Optimizados -->
    <title>@yield('title', 'Software de Gestión con IA para Clínicas de Fisioterapia')</title>
    <meta name="description" content="@yield('meta_description', 'CRM Fisioterapia Inteligente: Optimiza la atención al cliente con IA, facturación, seguimiento y marketing en una sola plataforma.')">
    
    <meta name="keywords" content="CRM fisioterapia, software clínicas fisioterapia, gestión fisioterapia, IA fisioterapia, facturación fisioterapia, marketing fisioterapia">
    <meta name="author" content="APPYWEB SL">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo.svg') }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'CRM Fisioterapia Inteligente | Software de Gestión con IA')">
    <meta property="og:description" content="@yield('meta_description', 'Optimiza la gestión de tu clínica de fisioterapia con nuestro CRM con inteligencia artificial.')">
    <meta property="og:image" content="{{ asset('images/logo.svg') }}">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'CRM Fisioterapia Inteligente')">
    <meta property="twitter:description" content="@yield('meta_description', 'Software de gestión con IA para clínicas de fisioterapia')">
    <meta property="twitter:image" content="{{ asset('images/logo.svg') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
    @livewireStyles
    
    @php
    $schemaData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => url('/') . '#organization',
                'name' => 'APPYWEB SL',
                'url' => url('/'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.svg'),
                    'width' => '180',
                    'height' => '60'
                ],
                'legalName' => 'APPYWEB SL',
                'vatID' => 'B02720803',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'Calle Mestre Laporta, N 2, 1 piso, puerta 2',
                    'addressLocality' => 'Alcoy',
                    'addressRegion' => 'Alicante',
                    'postalCode' => '03801',
                    'addressCountry' => 'ES'
                ],
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'contactType' => 'customer service',
                    'email' => 'info@crmfisios.com',
                    'telephone' => '+34966266048'
                ],
                'sameAs' => [
                    'https://www.facebook.com/crmfisios',
                    'https://twitter.com/crmfisios',
                    'https://www.linkedin.com/company/crmfisios'
                ]
            ],
            [
                '@type' => 'WebSite',
                '@id' => url('/') . '#website',
                'url' => url('/'),
                'name' => 'CRM Fisioterapia Inteligente',
                'description' => 'Software de gestión con inteligencia artificial para clínicas de fisioterapia',
                'publisher' => [
                    '@id' => url('/') . '#organization'
                ]
            ],
            [
                '@type' => 'SoftwareApplication',
                'name' => 'CRM Fisioterapia Inteligente',
                'applicationCategory' => 'BusinessApplication',
                'operatingSystem' => 'Web',
                'offers' => [
                    '@type' => 'Offer',
                    'price' => '49.99',
                    'priceCurrency' => 'EUR'
                ],
                'aggregateRating' => [
                    '@type' => 'AggregateRating',
                    'ratingValue' => '4.8',
                    'ratingCount' => '127'
                ],
                'featureList' => 'Gestión de citas, Evaluación física, Facturación inteligente, Marketing automatizado, Asistente virtual IA'
            ]
        ]
    ];
    @endphp
    
    <!-- Schema.org JSON-LD Datos Estructurados -->
    <script type="application/ld+json">
        {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
</head>
<body class="antialiased bg-white dark:bg-gray-900 font-sans">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200 transition-all duration-300" x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = window.scrollY > 50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('landing.home') }}" class="flex shrink-0">
                    <x-branding.logo size="md" />
                </a>
                
                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('landing.home') }}#features" class="text-gray-700 hover:text-emerald-600 font-medium transition-colors">Características</a>
                    <a href="{{ route('landing.home') }}#benefits" class="text-gray-700 hover:text-emerald-600 font-medium transition-colors">Beneficios</a>
                    <a href="{{ route('landing.home') }}#pricing" class="text-gray-700 hover:text-emerald-600 font-medium transition-colors">Planes</a>
                    <a href="{{ route('landing.demo') }}" class="inline-flex items-center px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-colors shadow-sm">
                        Ver Demo
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <button @click="open = !open" class="lg:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Navigation -->
            <div x-show="open" x-transition class="lg:hidden pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('landing.home') }}#features" class="text-gray-700 hover:text-emerald-600 font-medium py-2 transition-colors">Características</a>
                    <a href="{{ route('landing.home') }}#benefits" class="text-gray-700 hover:text-emerald-600 font-medium py-2 transition-colors">Beneficios</a>
                    <a href="{{ route('landing.home') }}#pricing" class="text-gray-700 hover:text-emerald-600 font-medium py-2 transition-colors">Planes</a>
                    <a href="{{ route('landing.demo') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-colors">Ver Demo</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <x-landing.footer />

    <!-- Scripts -->
    @livewireScripts
    @stack('scripts')
    <!-- Cookie Consent Banner -->
    <x-cookies.cookie-banner />
</body>
</html>
