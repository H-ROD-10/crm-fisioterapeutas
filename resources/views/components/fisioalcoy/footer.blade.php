<footer class="bg-gray-900 text-white py-12">
  <div class="container mx-auto px-4">
    <div class="grid md:grid-cols-4 gap-8 mb-8">
      <div>
        <img src="{{ asset('img/fisioalcoy-logo-mint.svg') }}" alt="FisioAlcoy" class="h-10 mb-4">
        <p class="text-gray-400 text-sm">
          Fisioterapia avanzada en Alcoy. Tratamientos personalizados para tu recuperación.
        </p>
      </div>
      
      <div>
        <h3 class="text-lg font-bold mb-4">Servicios</h3>
        <ul class="space-y-2 text-sm text-gray-400">
          <li><a href="#servicios" class="hover:text-white transition-colors">Rehabilitación</a></li>
          <li><a href="#servicios" class="hover:text-white transition-colors">Masaje terapéutico</a></li>
          <li><a href="#servicios" class="hover:text-white transition-colors">Fisioterapia deportiva</a></li>
          <li><a href="#servicios" class="hover:text-white transition-colors">Terapia manual</a></li>
        </ul>
      </div>
      
      <div>
        <h3 class="text-lg font-bold mb-4">Contacto</h3>
        <ul class="space-y-2 text-sm text-gray-400">
          <li class="flex items-center">
            <i class="fa-solid fa-phone mr-2 text-primary-400"></i>
            <a href="tel:+34865760828" class="hover:text-white transition-colors">+34 865 760 828</a>
          </li>
          <li class="flex items-center">
            <i class="fa-brands fa-whatsapp mr-2 text-green-400"></i>
            <a href="https://wa.me/34659743061" target="_blank" class="hover:text-white transition-colors">WhatsApp</a>
          </li>
          <li class="flex items-center">
            <i class="fa-solid fa-envelope mr-2 text-primary-400"></i>
            <a href="mailto:info@fisioalcoy.com" class="hover:text-white transition-colors">info@fisioalcoy.com</a>
          </li>
        </ul>
      </div>
      
      <div>
        <h3 class="text-lg font-bold mb-4">Horario</h3>
        <ul class="space-y-2 text-sm text-gray-400">
          <li>Lunes - Viernes: 9:00 - 20:00</li>
          <li>Sábados: 9:00 - 14:00</li>
          <li>Domingos: Cerrado</li>
        </ul>
      </div>
    </div>
    
    <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
      <p class="text-sm text-gray-400 mb-4 md:mb-0">
        © {{ date('Y') }} FisioAlcoy. Todos los derechos reservados.
      </p>
      <div class="flex space-x-4">
        <a href="#" class="text-gray-400 hover:text-white transition-colors">
          <i class="fa-brands fa-facebook-f"></i>
        </a>
        <a href="#" class="text-gray-400 hover:text-white transition-colors">
          <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="#" class="text-gray-400 hover:text-white transition-colors">
          <i class="fa-brands fa-linkedin-in"></i>
        </a>
      </div>
    </div>
  </div>
</footer>