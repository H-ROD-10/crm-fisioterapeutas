@props(['services' => collect()])

<div class="fixed inset-0 z-50 hidden" id="bookingModal" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <!-- Backdrop -->
  <div class="absolute inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity"></div>
  
  <!-- Modal -->
  <div class="relative flex items-center justify-center min-h-screen p-4">
    <div class="relative bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
      <!-- Header -->
      <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-linear-to-r from-primary-500 to-primary-600">
        <h5 class="text-xl font-bold text-white" id="bookingModalLabel">Reserva tu cita</h5>
        <button type="button" class="text-white/80 hover:text-white transition-colors duration-300" data-dismiss="modal" aria-label="Cerrar">
          <i class="fa-solid fa-times text-2xl"></i>
        </button>
      </div>
      
      <!-- Body -->
      <div class="p-6 overflow-y-auto max-h-[calc(90vh-80px)]">
        <x-booking.wizard :services="$services" />
      </div>
    </div>
  </div>
</div>