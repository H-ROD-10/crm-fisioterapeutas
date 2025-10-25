@extends('landing.layouts.app')

@section('title', 'Política de Cookies | CRM Fisio')
@section('meta_description', 'Política de cookies de CRM Fisio Inteligente.')

@section('content')
<div class="bg-gray-50 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Política de Cookies</h1>
            <p class="text-gray-600 mb-8">Última actualización: {{ date('d/m/Y') }}</p>

            <div class="prose prose-lg max-w-none">
                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">1. ¿Qué son las Cookies?</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Las cookies son pequeños archivos de texto que se almacenan en su dispositivo cuando visita un sitio web. 
                        Se utilizan ampliamente para hacer que los sitios web funcionen de manera más eficiente y proporcionar información a los propietarios del sitio.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Tipos de Cookies que Utilizamos</h2>
                    
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">2.1 Cookies Estrictamente Necesarias</h3>
                            <p class="text-gray-700 leading-relaxed mb-3">
                                Estas cookies son esenciales para el funcionamiento del sitio web y no se pueden desactivar.
                            </p>
                            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                <li><strong>Sesión de usuario:</strong> Mantiene su sesión activa</li>
                                <li><strong>Seguridad:</strong> Protege contra ataques CSRF</li>
                                <li><strong>Preferencias de cookies:</strong> Recuerda sus elecciones de cookies</li>
                            </ul>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">2.2 Cookies de Rendimiento</h3>
                            <p class="text-gray-700 leading-relaxed mb-3">
                                Nos ayudan a entender cómo los visitantes interactúan con nuestro sitio web.
                            </p>
                            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                <li><strong>Google Analytics:</strong> Análisis de tráfico y comportamiento</li>
                                <li><strong>Hotjar:</strong> Mapas de calor y grabaciones de sesión</li>
                                <li><strong>Duración:</strong> Hasta 2 años</li>
                            </ul>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">2.3 Cookies de Funcionalidad</h3>
                            <p class="text-gray-700 leading-relaxed mb-3">
                                Permiten que el sitio web recuerde sus elecciones para proporcionar funcionalidades mejoradas.
                            </p>
                            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                <li><strong>Preferencias de idioma:</strong> Recuerda su idioma preferido</li>
                                <li><strong>Tema visual:</strong> Modo claro/oscuro</li>
                                <li><strong>Duración:</strong> Hasta 1 año</li>
                            </ul>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">2.4 Cookies de Marketing</h3>
                            <p class="text-gray-700 leading-relaxed mb-3">
                                Se utilizan para mostrar anuncios relevantes y medir la efectividad de nuestras campañas.
                            </p>
                            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                <li><strong>Google Ads:</strong> Publicidad dirigida</li>
                                <li><strong>Facebook Pixel:</strong> Seguimiento de conversiones</li>
                                <li><strong>LinkedIn Insight:</strong> Análisis de audiencia B2B</li>
                                <li><strong>Duración:</strong> Hasta 2 años</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Cookies de Terceros</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Utilizamos servicios de terceros que pueden establecer sus propias cookies:
                    </p>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-bold text-gray-900">Servicio</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-bold text-gray-900">Propósito</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-bold text-gray-900">Duración</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border border-gray-300 px-4 py-3 text-gray-700">Google Analytics</td>
                                    <td class="border border-gray-300 px-4 py-3 text-gray-700">Análisis de tráfico</td>
                                    <td class="border border-gray-300 px-4 py-3 text-gray-700">2 años</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-3 text-gray-700">Google Ads</td>
                                    <td class="border border-gray-300 px-4 py-3 text-gray-700">Publicidad</td>
                                    <td class="border border-gray-300 px-4 py-3 text-gray-700">90 días</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-4 py-3 text-gray-700">Facebook Pixel</td>
                                    <td class="border border-gray-300 px-4 py-3 text-gray-700">Conversiones</td>
                                    <td class="border border-gray-300 px-4 py-3 text-gray-700">180 días</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-3 text-gray-700">Hotjar</td>
                                    <td class="border border-gray-300 px-4 py-3 text-gray-700">UX Analysis</td>
                                    <td class="border border-gray-300 px-4 py-3 text-gray-700">365 días</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Gestión de Cookies</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Puede gestionar sus preferencias de cookies de las siguientes maneras:
                    </p>
                    
                    <div class="bg-emerald-50 border-l-4 border-emerald-600 p-6 rounded-lg mb-6">
                        <h3 class="font-bold text-gray-900 mb-3">Panel de Configuración de Cookies</h3>
                        <p class="text-gray-700 mb-4">
                            Utilice nuestro panel de configuración para activar o desactivar categorías específicas de cookies.
                        </p>
                        <button onclick="openCookieSettings()" class="px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-all">
                            Configurar Cookies
                        </button>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3">Configuración del Navegador</h3>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        También puede gestionar cookies desde la configuración de su navegador:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li><strong>Chrome:</strong> Configuración > Privacidad y seguridad > Cookies</li>
                        <li><strong>Firefox:</strong> Opciones > Privacidad y seguridad > Cookies</li>
                        <li><strong>Safari:</strong> Preferencias > Privacidad > Cookies</li>
                        <li><strong>Edge:</strong> Configuración > Privacidad > Cookies</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Consecuencias de Desactivar Cookies</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Si desactiva ciertas cookies, algunas funcionalidades del sitio pueden verse afectadas:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>No podrá mantener su sesión iniciada</li>
                        <li>Sus preferencias no se guardarán</li>
                        <li>Algunas funciones interactivas pueden no funcionar correctamente</li>
                        <li>La experiencia de usuario puede verse reducida</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Actualizaciones de esta Política</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Podemos actualizar esta política de cookies periódicamente. Le recomendamos revisarla regularmente para estar informado 
                        sobre cómo utilizamos las cookies.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Más Información</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Para más información sobre cookies, visite:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li><a href="https://www.allaboutcookies.org" target="_blank" rel="noopener" class="text-emerald-600 hover:text-emerald-700 font-semibold">All About Cookies</a></li>
                        <li><a href="https://www.youronlinechoices.eu" target="_blank" rel="noopener" class="text-emerald-600 hover:text-emerald-700 font-semibold">Your Online Choices</a></li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Contacto</h2>
                    <div class="bg-emerald-50 border-l-4 border-emerald-600 p-6 rounded-lg">
                        <p class="text-gray-700 leading-relaxed mb-2">
                            Si tiene preguntas sobre nuestra política de cookies, contáctenos en:
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            <strong>Email:</strong> 
                            <a href="mailto:privacy@crmfisio.com" class="text-emerald-600 hover:text-emerald-700 font-semibold">privacy@crmfisio.com</a>
                        </p>
                    </div>
                </section>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-200">
                <a href="{{ route('landing.home') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function openCookieSettings() {
    // Esta función abrirá el modal de configuración de cookies
    // Se implementará en la FASE 6
    alert('Panel de configuración de cookies (se implementará en FASE 6)');
}
</script>
@endsection