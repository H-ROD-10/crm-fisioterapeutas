@extends('landing.layouts.app')

@section('title', 'Términos y Condiciones | CRM Fisio')
@section('meta_description', 'Términos y condiciones de uso de CRM Fisio Inteligente.')

@section('content')
<div class="bg-gray-50 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Términos y Condiciones</h1>
            <p class="text-gray-600 mb-8">Última actualización: {{ date('d/m/Y') }}</p>

            <div class="prose prose-lg max-w-none">
                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Aceptación de los Términos</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Al acceder y utilizar <strong>CRM Fisio Inteligente</strong> (en adelante, "la Plataforma"), usted acepta estar sujeto a estos Términos y Condiciones. 
                        Si no está de acuerdo con alguna parte de estos términos, no debe utilizar nuestros servicios.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Descripción del Servicio</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        CRM Fisio Inteligente es una plataforma de gestión integral para clínicas de fisioterapia que ofrece:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Sistema de gestión de citas y agenda</li>
                        <li>Historial clínico digital</li>
                        <li>Facturación y gestión de pagos</li>
                        <li>Asistente virtual con IA</li>
                        <li>Recordatorios automáticos</li>
                        <li>Herramientas de marketing</li>
                        <li>Análisis y reportes</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Registro y Cuenta de Usuario</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Para utilizar la Plataforma, debe:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Ser mayor de 18 años o contar con autorización de un tutor legal</li>
                        <li>Proporcionar información veraz, precisa y actualizada</li>
                        <li>Mantener la confidencialidad de sus credenciales de acceso</li>
                        <li>Notificar inmediatamente cualquier uso no autorizado de su cuenta</li>
                        <li>Ser responsable de todas las actividades realizadas bajo su cuenta</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Uso Aceptable</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Usted se compromete a NO:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Utilizar la Plataforma para fines ilegales o no autorizados</li>
                        <li>Intentar acceder a áreas restringidas del sistema</li>
                        <li>Interferir con el funcionamiento de la Plataforma</li>
                        <li>Transmitir virus, malware o código malicioso</li>
                        <li>Recopilar datos de otros usuarios sin autorización</li>
                        <li>Suplantar la identidad de otra persona o entidad</li>
                        <li>Realizar ingeniería inversa del software</li>
                        <li>Revender o redistribuir el acceso a la Plataforma</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Planes y Pagos</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        <strong>5.1 Planes de Suscripción:</strong> Ofrecemos diferentes planes de suscripción con características y precios variables.
                    </p>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        <strong>5.2 Facturación:</strong> Los pagos se procesan de forma recurrente según el plan seleccionado (mensual o anual).
                    </p>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        <strong>5.3 Renovación Automática:</strong> Su suscripción se renovará automáticamente a menos que cancele antes del período de renovación.
                    </p>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        <strong>5.4 Cambios de Precio:</strong> Nos reservamos el derecho de modificar los precios con un aviso previo de 30 días.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        <strong>5.5 Reembolsos:</strong> Ofrecemos garantía de devolución de 14 días para nuevos clientes.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Cancelación y Suspensión</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        <strong>6.1 Cancelación por el Usuario:</strong> Puede cancelar su suscripción en cualquier momento desde su panel de control.
                    </p>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        <strong>6.2 Suspensión por Impago:</strong> Podemos suspender su cuenta si no se procesa el pago correspondiente.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        <strong>6.3 Terminación por Incumplimiento:</strong> Nos reservamos el derecho de suspender o terminar su cuenta si viola estos términos.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Propiedad Intelectual</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Todos los derechos de propiedad intelectual sobre la Plataforma, incluyendo pero no limitado a:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Código fuente y software</li>
                        <li>Diseño y elementos visuales</li>
                        <li>Contenido y documentación</li>
                        <li>Marcas comerciales y logotipos</li>
                        <li>Algoritmos de IA y modelos de aprendizaje automático</li>
                    </ul>
                    <p class="text-gray-700 leading-relaxed mt-4">
                        Son propiedad exclusiva de CRM Fisio Inteligente S.L. o sus licenciantes.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Datos del Usuario</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        <strong>8.1 Propiedad de los Datos:</strong> Usted mantiene la propiedad de todos los datos que introduce en la Plataforma.
                    </p>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        <strong>8.2 Licencia de Uso:</strong> Nos otorga una licencia limitada para procesar sus datos con el fin de proporcionar el servicio.
                    </p>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        <strong>8.3 Exportación de Datos:</strong> Puede exportar sus datos en cualquier momento en formatos estándar.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        <strong>8.4 Eliminación de Datos:</strong> Al cancelar su cuenta, sus datos serán eliminados según nuestra política de retención.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Disponibilidad del Servicio</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        <strong>9.1 Tiempo de Actividad:</strong> Nos esforzamos por mantener una disponibilidad del 99.9%, pero no garantizamos un servicio ininterrumpido.
                    </p>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        <strong>9.2 Mantenimiento:</strong> Podemos realizar mantenimientos programados con aviso previo.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        <strong>9.3 Actualizaciones:</strong> Nos reservamos el derecho de actualizar y modificar la Plataforma.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Limitación de Responsabilidad</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        En la máxima medida permitida por la ley:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>La Plataforma se proporciona "tal cual" sin garantías de ningún tipo</li>
                        <li>No somos responsables de pérdidas de datos, beneficios o daños indirectos</li>
                        <li>Nuestra responsabilidad máxima está limitada al importe pagado en los últimos 12 meses</li>
                        <li>No garantizamos resultados específicos del uso de la Plataforma</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Indemnización</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Usted acepta indemnizar y eximir de responsabilidad a CRM Fisio Inteligente de cualquier reclamación derivada de:
                        su uso de la Plataforma, violación de estos términos, o infracción de derechos de terceros.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">12. Modificaciones de los Términos</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Nos reservamos el derecho de modificar estos términos en cualquier momento. Los cambios significativos serán notificados 
                        con 30 días de antelación. El uso continuado de la Plataforma después de los cambios constituye su aceptación.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">13. Ley Aplicable y Jurisdicción</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Estos términos se rigen por la legislación española. Cualquier disputa se someterá a la jurisdicción exclusiva 
                        de los tribunales de Madrid, España.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">14. Contacto</h2>
                    <div class="bg-emerald-50 border-l-4 border-emerald-600 p-6 rounded-lg">
                        <p class="text-gray-700 leading-relaxed mb-2">
                            <strong>Empresa:</strong> CRM Fisio Inteligente S.L.
                        </p>
                        <p class="text-gray-700 leading-relaxed mb-2">
                            <strong>CIF:</strong> B-12345678
                        </p>
                        <p class="text-gray-700 leading-relaxed mb-2">
                            <strong>Email:</strong> 
                            <a href="mailto:legal@crmfisio.com" class="text-emerald-600 hover:text-emerald-700 font-semibold">legal@crmfisio.com</a>
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            <strong>Dirección:</strong> Calle Ejemplo, 123, 28001 Madrid, España
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