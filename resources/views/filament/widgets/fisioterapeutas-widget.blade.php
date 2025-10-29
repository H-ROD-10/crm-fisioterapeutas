<x-filament-widgets::widget>
    <x-filament::section class="h-[650px] overflow-y-auto overscroll-contain pr-2">
        <x-slot name="heading">
            Fisioterapeutas
        </x-slot>
        
        <x-slot name="description">
            {{ $fisioterapeutas->count() }} {{ $fisioterapeutas->count() === 1 ? 'profesional' : 'profesionales' }}
        </x-slot>

        @if($fisioterapeutas->isEmpty())
            <!-- Estado vacío -->
            <div class="flex flex-col items-center justify-center py-12 text-center">
                <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 text-sm">
                    No hay fisioterapeutas registrados
                </p>
            </div>
        @else
            <!-- Grid de fisioterapeutas -->
            <div class="flex flex-col gap-4">
                    @foreach($fisioterapeutas as $fisioterapeuta)
                        <div class="w-full group relative bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700 p-5 hover:shadow-lg hover:border-primary-500 dark:hover:border-primary-500 transition-all duration-200">
                            <!-- Avatar y nombre -->
                            <div class="flex items-start gap-4 mb-4">
                                <div class="flex shrink-0">
                                    <div class="w-12 h-12 rounded-full bg-linear-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center light:text-white dark:text-gray-900 font-semibold text-lg shadow-md">
                                        {{ strtoupper(substr($fisioterapeuta->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-white truncate">
                                        {{ $fisioterapeuta->name }}
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                        {{ $fisioterapeuta->email }}
                                    </p>
                                </div>
                            </div>

                            <!-- Estadísticas -->
                            <div class="grid grid-cols-3 gap-3">
                                <!-- Pacientes -->
                                <div class="text-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                    <div class="text-2xl font-bold text-primary-600 dark:text-primary-400">
                                        {{ $fisioterapeuta->patients_count ?? 0 }}
                                    </div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                        Pacientes
                                    </div>
                                </div>

                                <!-- Citas -->
                                <div class="text-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                    <div class="text-2xl font-bold text-success-600 dark:text-success-400">
                                        {{ $fisioterapeuta->appointments_count ?? 0 }}
                                    </div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                        Citas
                                    </div>
                                </div>

                                <!-- Tratamientos -->
                                <div class="text-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                    <div class="text-2xl font-bold text-warning-600 dark:text-warning-400">
                                        {{ $fisioterapeuta->treatments_count ?? 0 }}
                                    </div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                        Tratamientos
                                    </div>
                                </div>
                            </div>

                            <!-- Indicador de hover -->
                            <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <div class="w-2 h-2 rounded-full bg-primary-500"></div>
                            </div>
                        </div>
                    @endforeach
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
