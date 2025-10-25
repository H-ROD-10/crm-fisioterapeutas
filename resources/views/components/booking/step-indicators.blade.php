@props(['currentStep' => 1])

<div class="flex justify-center items-center space-x-4 mb-8">
    <div class="flex flex-col items-center">
        <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold mb-2 transition-all
            {{ $currentStep >= 1 ? 'bg-emerald-600 text-white' : 'bg-gray-200 text-gray-500' }}" 
            id="widget-step1">
            1
        </div>
        <div class="text-sm font-medium transition-all {{ $currentStep >= 1 ? 'text-gray-900' : 'text-gray-500' }}">
            Tratamiento
        </div>
    </div>
    
    <div class="w-12 h-1 {{ $currentStep >= 2 ? 'bg-emerald-600' : 'bg-gray-200' }} transition-all"></div>
    
    <div class="flex flex-col items-center">
        <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold mb-2 transition-all
            {{ $currentStep >= 2 ? 'bg-emerald-600 text-white' : 'bg-gray-200 text-gray-500' }}" 
            id="widget-step2">
            2
        </div>
        <div class="text-sm font-medium transition-all {{ $currentStep >= 2 ? 'text-gray-900' : 'text-gray-500' }}">
            Especialista
        </div>
    </div>
    
    <div class="w-12 h-1 {{ $currentStep >= 3 ? 'bg-emerald-600' : 'bg-gray-200' }} transition-all"></div>
    
    <div class="flex flex-col items-center">
        <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold mb-2 transition-all
            {{ $currentStep >= 3 ? 'bg-emerald-600 text-white' : 'bg-gray-200 text-gray-500' }}" 
            id="widget-step3">
            3
        </div>
        <div class="text-sm font-medium transition-all {{ $currentStep >= 3 ? 'text-gray-900' : 'text-gray-500' }}">
            Fecha/Hora
        </div>
    </div>
    
    <div class="w-12 h-1 {{ $currentStep >= 4 ? 'bg-emerald-600' : 'bg-gray-200' }} transition-all"></div>
    
    <div class="flex flex-col items-center">
        <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold mb-2 transition-all
            {{ $currentStep >= 4 ? 'bg-emerald-600 text-white' : 'bg-gray-200 text-gray-500' }}" 
            id="widget-step4">
            4
        </div>
        <div class="text-sm font-medium transition-all {{ $currentStep >= 4 ? 'text-gray-900' : 'text-gray-500' }}">
            Datos
        </div>
    </div>
</div>