<section id="faq" class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-block px-4 py-2 bg-amber-100 text-amber-700 rounded-full text-sm font-semibold mb-4" data-aos="fade-up">
                Preguntas frecuentes
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-4" data-aos="fade-up" data-aos-delay="100">
                ¿Tienes dudas?
            </h2>
            <p class="text-xl text-gray-600" data-aos="fade-up" data-aos-delay="200">
                Resolvemos las preguntas más comunes sobre CRM Fisio Inteligente
            </p>
        </div>
        
        <!-- FAQ Accordion -->
        <div class="max-w-4xl mx-auto space-y-4" data-aos="fade-up">
            <!-- FAQ Item 1 -->
            <div x-data="{ open: false }" class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-colors">
                <button @click="open = !open" class="w-full px-6 py-5 flex items-center justify-between text-left">
                    <span class="text-lg font-semibold text-gray-900">¿Qué incluye la licencia CRM de 39€/mes?</span>
                    <svg class="w-6 h-6 text-emerald-600 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-5">
                    <div class="text-gray-600 space-y-3">
                        <p>La licencia CRM incluye:</p>
                        <ul class="list-disc pl-5 space-y-2">
                            <li><strong>Usuarios ilimitados</strong> para tu equipo</li>
                            <li><strong>Gestión completa de pacientes</strong> con historial clínico</li>
                            <li><strong>Sistema de citas</strong> con calendario inteligente</li>
                            <li><strong>Facturación electrónica</strong> y control de pagos</li>
                            <li><strong>Informes y estadísticas</strong> en tiempo real</li>
                            <li><strong>Almacenamiento seguro</strong> en la nube</li>
                            <li><strong>Soporte técnico</strong> prioritario</li>
                        </ul>
                        <p class="text-sm text-emerald-600 font-semibold mt-3">Los servicios de IA se contratan aparte según tu consumo.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div x-data="{ open: false }" class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-colors">
                <button @click="open = !open" class="w-full px-6 py-5 flex items-center justify-between text-left">
                    <span class="text-lg font-semibold text-gray-900">¿Cómo funcionan los planes de IA?</span>
                    <svg class="w-6 h-6 text-emerald-600 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-5">
                    <div class="text-gray-600 space-y-3">
                        <p>Los planes de IA son <strong>paquetes de consumo mensual</strong> que incluyen:</p>
                        <ul class="list-disc pl-5 space-y-2">
                            <li><strong>Minutos de IA</strong>: Para llamadas telefónicas automatizadas</li>
                            <li><strong>Recordatorios automáticos</strong>: SMS/Email/WhatsApp</li>
                            <li><strong>Conversaciones WhatsApp</strong>: Chatbot inteligente</li>
                        </ul>
                        <p class="mt-3">Si superas tu plan, solo pagas por el consumo adicional a una tarifa reducida. <strong>Sin sorpresas ni cargos ocultos.</strong></p>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div x-data="{ open: false }" class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-colors">
                <button @click="open = !open" class="w-full px-6 py-5 flex items-center justify-between text-left">
                    <span class="text-lg font-semibold text-gray-900">¿Puedo cambiar de plan en cualquier momento?</span>
                    <svg class="w-6 h-6 text-emerald-600 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-5">
                    <div class="text-gray-600">
                        <p><strong>Sí, absolutamente.</strong> Puedes actualizar o reducir tu plan de IA en cualquier momento desde tu panel de control. Los cambios se aplican en el siguiente ciclo de facturación.</p>
                        <p class="mt-3">Además, <strong>no hay permanencia</strong>. Puedes cancelar cuando quieras sin penalizaciones.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div x-data="{ open: false }" class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-colors">
                <button @click="open = !open" class="w-full px-6 py-5 flex items-center justify-between text-left">
                    <span class="text-lg font-semibold text-gray-900">¿Es seguro almacenar datos de pacientes en la nube?</span>
                    <svg class="w-6 h-6 text-emerald-600 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-5">
                    <div class="text-gray-600 space-y-3">
                        <p><strong>Totalmente seguro.</strong> Cumplimos con todas las normativas:</p>
                        <ul class="list-disc pl-5 space-y-2">
                            <li><strong>RGPD</strong>: Reglamento General de Protección de Datos</li>
                            <li><strong>LOPD</strong>: Ley Orgánica de Protección de Datos</li>
                            <li><strong>Cifrado SSL/TLS</strong>: Todas las comunicaciones encriptadas</li>
                            <li><strong>Backups diarios</strong>: Tus datos siempre protegidos</li>
                            <li><strong>Servidores en Europa</strong>: Cumplimiento normativo garantizado</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 5 -->
            <div x-data="{ open: false }" class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-colors">
                <button @click="open = !open" class="w-full px-6 py-5 flex items-center justify-between text-left">
                    <span class="text-lg font-semibold text-gray-900">¿Qué soporte técnico ofrecen?</span>
                    <svg class="w-6 h-6 text-emerald-600 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-5">
                    <div class="text-gray-600 space-y-3">
                        <p>Ofrecemos <strong>soporte completo</strong> para todos nuestros clientes:</p>
                        <ul class="list-disc pl-5 space-y-2">
                            <li><strong>Chat en vivo</strong>: Lunes a viernes de 9:00 a 18:00</li>
                            <li><strong>Email</strong>: Respuesta en menos de 24 horas</li>
                            <li><strong>Teléfono</strong>: Asistencia directa para urgencias</li>
                            <li><strong>Base de conocimiento</strong>: Tutoriales y guías</li>
                            <li><strong>Formación inicial</strong>: Onboarding personalizado incluido</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 6 -->
            <div x-data="{ open: false }" class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-colors">
                <button @click="open = !open" class="w-full px-6 py-5 flex items-center justify-between text-left">
                    <span class="text-lg font-semibold text-gray-900">¿Puedo probar el sistema antes de contratar?</span>
                    <svg class="w-6 h-6 text-emerald-600 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-5">
                    <div class="text-gray-600">
                        <p><strong>¡Por supuesto!</strong> Ofrecemos una <strong>demo gratuita de 14 días</strong> sin necesidad de tarjeta de crédito.</p>
                        <p class="mt-3">Durante la prueba tendrás acceso completo a todas las funcionalidades del CRM y un paquete de IA de prueba para que experimentes el poder de la automatización.</p>
                        <a href="{{ route('landing.demo') }}" class="inline-flex items-center text-emerald-600 font-semibold hover:text-emerald-700 mt-3">
                            Solicitar demo gratuita
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
