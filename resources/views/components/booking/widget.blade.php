@props(['compact' => true])

<div id="booking-widget" class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
    <h3 class="text-2xl font-bold text-gray-900 mb-6">Reserva tu Cita</h3>
    
    <x-booking.step-indicators :currentStep="1" />
    
    <form id="booking-widget-form" action="{{ route('public.save_booking') }}" method="POST">
        @csrf
        <input type="hidden" name="service_id" id="widget-service-id">
        <input type="hidden" name="employee_id" id="widget-employee-id">
        <input type="hidden" name="date" id="widget-selected-date">
        <input type="hidden" name="time_slot" id="widget-selected-time-slot">
        
        <x-booking.step-services />
        <x-booking.step-employees />
        <x-booking.step-datetime />
        <x-booking.step-confirmation />
    </form>
</div>