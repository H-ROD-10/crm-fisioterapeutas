@extends('landing.layouts.app')

@section('title', 'Política de Privacidad | CRM Fisio')
@section('meta_description', 'Política de privacidad y protección de datos de CRM Fisio Inteligente.')

@section('content')
<div class="bg-gray-50 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Política de Privacidad</h1>
            <p class="text-gray-600 mb-8">Última actualización: {{ date('d/m/Y') }}</p>

            <div class="prose prose-lg max-w-none">
                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Información que Recopilamos</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        En <strong>CRM Fisio Inteligente</strong>, recopilamos la siguiente información:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li><strong>Datos de identificación:</strong> Nombre completo, DNI/NIE, fecha de nacimiento</li>
                        <li><strong>Datos de contacto:</strong> Dirección de correo electrónico, número de teléfono, dirección postal</li>
                        <li><strong>Datos de salud:</strong> Historial clínico, diagnósticos, tratamientos, notas médicas</li>
                        <li><strong>Datos de navegación:</strong> Dirección IP, cookies, datos de uso de la plataforma</li>
                        <li><strong>Datos de pago:</strong> Información de facturación (procesada por terceros seguros)</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Base Legal del Tratamiento</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Tratamos sus datos personales bajo las siguientes bases legales:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li><strong>Consentimiento:</strong> Para el envío de comunicaciones comerciales</li>
                        <li><strong>Ejecución de contrato:</strong> Para la prestación de servicios de fisioterapia</li>
                        <li><strong>Obligación legal:</strong> Para cumplir con normativas sanitarias y fiscales</li>
                        <li><strong>Interés legítimo:</strong> Para mejorar nuestros servicios y seguridad</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Uso de la Información</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Utilizamos su información para:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Gestionar citas y tratamientos de fisioterapia</li>
                        <li>Mantener su historial clínico actualizado</li>
                        <li>Enviar recordatorios de citas y seguimientos</li>
                        <li>Procesar pagos y emitir facturas</li>
                        <li>Mejorar nuestros servicios mediante análisis de datos anonimizados</li>
                        <li>Cumplir con obligaciones legales y regulatorias</li>
                        <li>Enviar comunicaciones comerciales (con su consentimiento previo)</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Protección de Datos de Salud</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Los datos de salud son especialmente protegidos según el RGPD. Implementamos medidas de seguridad técnicas y organizativas:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Cifrado de datos en tránsito y en reposo (SSL/TLS, AES-256)</li>
                        <li>Control de acceso basado en roles con autenticación multifactor</li>
                        <li>Auditorías de seguridad periódicas</li>
                        <li>Copias de seguridad automáticas diarias</li>
                        <li>Servidores ubicados en la Unión Europea</li>
                        <li>Personal formado en protección de datos sanitarios</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Compartir Información</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        No vendemos ni alquilamos sus datos personales. Podemos compartir información con:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li><strong>Profesionales sanitarios:</strong> Otros fisioterapeutas o médicos con su consentimiento</li>
                        <li><strong>Proveedores de servicios:</strong> Procesadores de pago, servicios de hosting (con acuerdos de confidencialidad)</li>
                        <li><strong>Autoridades:</strong> Cuando sea requerido por ley</li>
                        <li><strong>Compañías de seguros:</strong> Para tramitación de reembolsos (con su autorización)</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Sus Derechos</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Bajo el RGPD, usted tiene los siguientes derechos:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li><strong>Acceso:</strong> Solicitar una copia de sus datos personales</li>
                        <li><strong>Rectificación:</strong> Corregir datos inexactos o incompletos</li>
                        <li><strong>Supresión:</strong> Solicitar la eliminación de sus datos ("derecho al olvido")</li>
                        <li><strong>Limitación:</strong> Restringir el tratamiento de sus datos</li>
                        <li><strong>Portabilidad:</strong> Recibir sus datos en formato estructurado</li>
                        <li><strong>Oposición:</strong> Oponerse al tratamiento de sus datos</li>
                        <li><strong>Revocación:</strong> Retirar el consentimiento en cualquier momento</li>
                    </ul>
                    <p class="text-gray-700 leading-relaxed mt-4">
                        Para ejercer sus derechos, contacte con nuestro Delegado de Protección de Datos en: 
                        <a href="mailto:dpo@crmfisio.com" class="text-emerald-600 hover:text-emerald-700 font-semibold">dpo@crmfisio.com</a>
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Retención de Datos</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Conservamos sus datos personales durante:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li><strong>Datos clínicos:</strong> Mínimo 5 años desde la última asistencia (según normativa sanitaria)</li>
                        <li><strong>Datos de facturación:</strong> 4 años (según normativa fiscal)</li>
                        <li><strong>Datos de marketing:</strong> Hasta que retire su consentimiento</li>
                        <li><strong>Datos de navegación:</strong> Máximo 2 años</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Cookies</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Utilizamos cookies para mejorar su experiencia. Consulte nuestra 
                        <a href="{{ route('legal.cookies') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">Política de Cookies</a> 
                        para más información.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Transferencias Internacionales</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Sus datos se almacenan en servidores ubicados en la Unión Europea. En caso de transferencias internacionales, 
                        garantizamos el cumplimiento de las cláusulas contractuales tipo aprobadas por la Comisión Europea.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Menores de Edad</h2>
                    <p class="text-gray-700 leading-relaxed">
                        No recopilamos intencionadamente datos de menores de 14 años sin el consentimiento de sus padres o tutores legales.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Cambios en esta Política</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Nos reservamos el derecho de actualizar esta política. Le notificaremos cualquier cambio significativo por correo electrónico 
                        o mediante un aviso destacado en nuestra plataforma.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">12. Contacto</h2>
                    <div class="bg-emerald-50 border-l-4 border-emerald-600 p-6 rounded-lg">
                        <p class="text-gray-700 leading-relaxed mb-2">
                            <strong>Responsable del Tratamiento:</strong> CRM Fisio Inteligente S.L.
                        </p>
                        <p class="text-gray-700 leading-relaxed mb-2">
                            <strong>Delegado de Protección de Datos:</strong> 
                            <a href="mailto:dpo@crmfisio.com" class="text-emerald-600 hover:text-emerald-700 font-semibold">dpo@crmfisio.com</a>
                        </p>
                        <p class="text-gray-700 leading-relaxed mb-2">
                            <strong>Dirección:</strong> Calle Ejemplo, 123, 28001 Madrid, España
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            <strong>Autoridad de Control:</strong> Agencia Española de Protección de Datos (AEPD) - 
                            <a href="https://www.aepd.es" target="_blank" rel="noopener" class="text-emerald-600 hover:text-emerald-700 font-semibold">www.aepd.es</a>
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
@endsection