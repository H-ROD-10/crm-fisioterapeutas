@extends('landing.layouts.fisioalcoy')

@section('title', 'Clínica de fisioterapia en Alcoy | Demo CRM')

@section('content')
  <x-fisioalcoy.hero :services="$services" :showWizard="true" video="https://demo.awaikenthemes.com/assets/videos/physiocare-video.mp4" />
  <x-fisioalcoy.highlights />
  <x-fisioalcoy.about /> 
  <x-fisioalcoy.gallery-marquee :images="[
    asset('images/fisioterapia1.jpeg'),
    asset('images/fisioterapia2.jpeg'),
    asset('images/fisioterapia3.jpeg'),
    asset('images/fisioterapia4.jpeg'),
    asset('images/fisioterapia5.jpeg'),
    asset('images/fisioterapia6.jpeg'),
    asset('images/fisioterapia7.jpeg'),
    asset('images/fisioterapia8.jpeg'),
    asset('images/fisioterapia9.jpeg'),
    asset('images/fisioterapia10.jpeg'),
    asset('images/fisioterapia11.jpeg'),
    asset('images/fisioterapia12.jpeg'),
    asset('images/fisioterapia13.jpeg'),
  ]" />
  <x-fisioalcoy.services-showcase />
  <x-fisioalcoy.testimonials />
  <x-fisioalcoy.team />
  
  <!-- Mapa y Dirección -->
  <section class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
      <div class="grid md:grid-cols-2 gap-8 items-start">
        <!-- Información de contacto -->
        <div>
          <h2 class="text-3xl font-bold text-gray-900 mb-6">Visítanos</h2>
          <div class="space-y-4 flex justify-center flex-col">
            <div class="flex justify-between items-center">
                <div class="flex items-start">
                    <i class="fa-solid fa-location-dot text-primary-600 text-xl mr-4 mt-1"></i>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Dirección</h3>
                        <p class="text-gray-600">Carrer de Sant Nicolau, 17</p>
                        <p class="text-gray-600">03801 Alcoy, Alicante</p>
                    </div>
                </div>
            
                <div class="flex items-center pr-20">
                    <i class="fa-solid fa-phone text-primary-600 text-xl mr-4 mt-1"></i>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Teléfono</h3>
                        <a href="tel:+34865760828" class="text-gray-600 hover:text-primary-600 transition-colors">+34 865 760 828</a>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-between items-center">
                <div class="flex items-start ">
                    <i class="fa-brands fa-whatsapp text-green-600 text-xl mr-4 mt-1"></i>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">WhatsApp</h3>
                        <a href="https://wa.me/34659743061" target="_blank" class="text-gray-600 hover:text-primary-600 transition-colors">+34 659 743 061</a>
                    </div>
                </div>
            
                <div class="flex items-start">
                    <i class="fa-solid fa-clock text-primary-600 text-xl mr-4 mt-1"></i>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Horario</h3>
                        <p class="text-gray-600">
                        Lunes - Viernes: 9:00 - 20:00<br>
                        Sábados: 9:00 - 14:00<br>
                        Domingos: Cerrado
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="pt-4">
              <a href="https://www.google.com/maps/dir//Carrer+de+Sant+Nicolau,+17,+03801+Alcoy,+Alicante" target="_blank" class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition-all duration-300">
                <i class="fa-solid fa-directions mr-2"></i>
                Cómo llegar
              </a>
            </div>
          </div>
        </div>
        
        <!-- Mapa -->
        <div class="h-96 md:h-full min-h-[400px] rounded-xl overflow-hidden shadow-lg">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3110.8!2d-0.4747!3d38.6972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6228e7e7e7e7e7%3A0x7e7e7e7e7e7e7e7!2sCarrer%20de%20Sant%20Nicolau%2C%2017%2C%2003801%20Alcoy%2C%20Alicante!5e0!3m2!1ses!2ses!4v1234567890" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            title="Ubicación de FisioAlcoy en Google Maps">
          </iframe>
        </div>
      </div>
    </div>
  </section>
  
  <x-fisioalcoy.cta />
  
  <x-fisioalcoy.booking-modal :services="$services" />
  
  <!-- Agente de Reservas IA -->
  @livewire('landing.whatsapp-button')
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const startBookingBtns = document.querySelectorAll('.js-start-booking');
      const wizardWrap = document.getElementById('hero-wizard-wrap');
      
      startBookingBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          if (wizardWrap) {
            wizardWrap.classList.remove('hidden');
            wizardWrap.setAttribute('aria-hidden', 'false');
            this.setAttribute('aria-expanded', 'true');
          }
        });
      });
    });
  </script>
@endsection