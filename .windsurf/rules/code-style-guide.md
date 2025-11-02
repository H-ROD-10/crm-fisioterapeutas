---
trigger: always_on
---

Eres experto en PHP, Laravel version 12, Filament version 4, livewire version 3, and Tailwind version 4.

1. Normas de codificacion
  - Utiliza las características de PHP mayor a v8.3.
  - Siga las reglas de codificación de pint.json.
  - Aplicar tipos y formas de matriz estrictos mediante PHPStan.
  - Usa inyección de dependencias en todos los controladores y servicios.
  - Siempre utiliza el compando php artisan para crea cualquier componente de Filament, Livewire u otro.
2. Estructura y arquitectura del proyecto
  - Arquitectura por Capas:
	a. Separa claramente Controllers, Request Actions, Services, Models, Repositories, Middleware y Resources en carpetas contextuales. 
	b. Utiliza el patrón Action para lógica de casos de uso específicos.
	c. Usa Services para lógica de negocio reutilizable.
	d. Organiza los componentes Blade en carpetas contextuales (resources/views/components).
3. Patrones Adaptados
  - Uso del patron SOLID:
	a. S: Cada clase debe tener una única responsabilidad.
	b. O: Extiende el comportamiento usando nuevas clases o estrategias, no modificando las existentes.
	c. L: Asegura que las clases hijas puedan sustituir a las clases base sin errores.
	d. I: Segmenta interfaces grandes en partes coherentes para evitar clases obligadas a implementar métodos innecesarios.
	e. D: Depende de abstracciones (interfaces o DTOs), no de clases concretas.
4. Controllers:
  - Los controller no debe incluir ninguna validación manual ni lógica de negocio, debe delegar lógica a Actions o Services.
5. Validación y Rules:
  - Usa Form Request para todas las validaciones.
  - Nombres con CreateRequest, UpdateRequest, DeleteRequest dentro de carpetas segun contexto (por ejemplo app/Http/Requests/Blog/CreatePost).
  - Define reglas reutilizables (rules) para validaciones comunes (por ejemplo, email único, formatos personalizados).
  - Usa custom Rules (app/Rules) para validaciones específicas y reutilizables.
6. Vistas:
  - Los archivo Blade no debe superar 150 líneas.
  - Si contiene más de 5 bloques lógicos distintos, divídelo en componentes Blade (resources/views/components/<contexto>/).
  - Usa <x-*> para vistas dinámicas reutilizables.
  - Usa @include o @each para vistas estáticas o parciales pequeñas.
  - No repitas estructuras HTML, siempre evalúa si puede convertirse en un componente.
7. Modelos:
  - Use las nuevas mejoras del generador de consultas de base de datos para mejorar el rendimiento.
  - Uso de observadores en modelos para la gestión de eventos complejos.
  - Utilice las nuevas mejoras de carga de relaciones para mejorar el rendimiento.
8. Calidad y pruebas
  - Usar estilos y reglas de nombrado de distinto elementos que emplea Laravel y usar el ingles como lenguaje para nombrarlos.
  - Utilice Pest PHP para todas las pruebas.
  - Todo el código debe ser probado.
  - Genere un {Model}Factory con cada modelo.
  - Genere test unitarios y de integracion.
  - Implementación de pruebas paralelas con las nuevas mejoras de pruebas
9. Seguridad
  - Usar las nuevas mejoras de hash de contraseñas.
  - Implementación de las nuevas mejoras de protección CSRF.
  - Utilice las nuevas funciones de protección XSS.
  - Usar las nuevas mejoras de saneamiento de entradas.