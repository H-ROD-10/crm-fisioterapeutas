<div class="booking-widget-step" id="booking-widget-step-1">
    <h5 class="text-xl font-bold text-gray-900 mb-6">Selecciona el tratamiento que necesitas:</h5>
    <div class="grid grid-cols-2 gap-3">
        @php
            $services = \App\Models\MedicalService::all();
        @endphp
        
        @foreach($services as $service)
        <div class="service-select-item border-2 border-gray-200 rounded-lg p-4 cursor-pointer hover:border-emerald-500 hover:shadow-md transition-all" 
             data-service-id="{{ $service->id }}"
             data-service-name="{{ $service->name }}">
            <div class="flex justify-between items-center">
                <span class="font-bold text-gray-900 text-sm truncate mr-2">{{ $service->name }}</span>
                <span class="bg-emerald-600 text-white text-xs font-semibold px-2 py-1 rounded-full whitespace-nowrap">
                    {{ number_format($service->price ?? 60, 2) }} €
                </span>
            </div>
        </div>
        @endforeach
    </div>

    <div class="flex justify-end mt-6">
        <button type="button" 
                class="px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-all widget-next-step disabled:opacity-50 disabled:cursor-not-allowed" 
                data-next="2" 
                disabled>
            Continuar
        </button>
    </div>
</div>