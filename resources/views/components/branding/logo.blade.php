@props(['size' => 'md', 'class' => '', 'isDark' => false])

@php
    $sizes = [
        'sm' => 'max-w-[140px]',
        'md' => 'max-w-[200px]',
        'lg' => 'max-w-[250px]',
    ];
    
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $subtitleColor = $isDark ? 'rgba(255,255,255,0.85)' : '#3a556a';
    $strokeColor = $isDark ? '#ffffff' : '#00b8a9';
    $gradientId = 'physioGradient' . uniqid();
@endphp

<div class="crm-logo {{ $class }}">
    <div class="logo-container {{ $sizeClass }}">
        <div class="flex items-center">
            <!-- Icono de fisioterapia -->
            <div class="physio-icon mr-2">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                    <defs>
                        <linearGradient id="{{ $gradientId }}" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#1ABC9C" />
                            <stop offset="100%" stop-color="#00b8a9" />
                        </linearGradient>
                    </defs>
                    
                    <!-- Figura humana simplificada -->
                    <circle cx="12" cy="6" r="3" fill="url(#{{ $gradientId }})" />
                    
                    <!-- Torso y extremidades -->
                    <path d="M12,9 L12,14 M9,21 L9,14 L15,14 L15,21 M7,12 L17,12" 
                        stroke="{{ $strokeColor }}" stroke-width="1.4" stroke-linecap="round" />
                        
                    <!-- Manos terapéuticas -->
                    <path d="M6,11 C3,13 5,16 7,15" stroke="{{ $strokeColor }}" stroke-width="1.1" stroke-linecap="round" fill="none" />
                    <path d="M18,11 C21,13 19,16 17,15" stroke="{{ $strokeColor }}" stroke-width="1.1" stroke-linecap="round" fill="none" />
                    
                    <!-- Brillos para efecto profesional -->
                    <circle cx="11" cy="5" r="0.7" fill="white" fill-opacity="0.8" />
                </svg>
            </div>
            
            <div class="logo-text">
                <!-- Primera línea -->
                <div class="logo-line-1 font-bold text-base leading-tight tracking-tight text-emerald-600">
                    CRM
                </div>
                
                <!-- Segunda línea -->
                <div class="logo-line-2 font-bold text-base leading-tight tracking-tight">
                    <span>Fisio </span>
                    <span class="bg-linear-to-r from-emerald-500 to-teal-600 bg-clip-text text-transparent">Inteligente</span>
                </div>
                
                <!-- Tercera línea (subtítulo) -->
                <span class="logo-subtitle text-xs leading-tight tracking-wide font-normal" style="color: {{ $subtitleColor }};">El futuro de tu centro</span>
            </div>
        </div>
    </div>
</div>