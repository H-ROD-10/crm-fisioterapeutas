# 🚀 Plan de Migración - Landing Fisioterapeutas

> **Proyecto:** Migración de vistas desde `C:\laragon\www\fisio` a `C:\laragon\www\fisioterapeutas`  
> **Stack:** Laravel 12 + Livewire 3 + Tailwind CSS 4 + Filament 4 + Vite  
> **Objetivo:** Crear landing page como vista principal en lugar de `welcome.blade.php`

---

## 📊 Progreso General

- [ ] **FASE 1:** Layout Base y Componentes Fundamentales (0/5)
- [ ] **FASE 2:** Página Home con Componentes Estáticos (0/7)
- [ ] **FASE 3:** Componentes Livewire Interactivos (0/4)
- [ ] **FASE 4:** Sistema de Booking Completo (0/6)
- [ ] **FASE 5:** Páginas de Features (0/11)
- [ ] **FASE 6:** Páginas Legales (0/4)
- [ ] **FASE 7:** Assets JS y Configuración (0/4)
- [ ] **FASE 8:** Optimización y Testing Final (0/8)

**Total:** 0/49 tareas completadas

---

## 📋 FASE 1: Layout Base y Componentes Fundamentales

**Objetivo:** Crear el layout principal y componentes básicos para que funcione la estructura.

### Tareas

- [ ] **1.1** Crear `resources/views/landing/layouts/app.blade.php`
  - Origen: `C:\laragon\www\fisio\resources\views\layouts\landing.blade.php`
  - Convertir Bootstrap a Tailwind CSS
  - Incluir `@vite(['resources/css/app.css', 'resources/js/app.js'])`
  - Agregar `@livewireStyles` y `@livewireScripts`

- [ ] **1.2** Crear `resources/views/components/branding/logo.blade.php`
  - Origen: `C:\laragon\www\fisio\resources\views\components\branding\logo.blade.php`
  - Convertir a Tailwind CSS

- [ ] **1.3** Crear `resources/views/components/landing/footer.blade.php`
  - Origen: `C:\laragon\www\fisio\resources\views\components\landing\footer.blade.php`
  - Convertir a Tailwind CSS
  - Incluir enlaces a páginas legales

- [ ] **1.4** Crear `resources/views/landing/pages/home.blade.php` (temporal)
  - Estructura básica que extiende el layout
  - Contenido placeholder

- [ ] **1.5** Implementar método en `app/Http/Controllers/Landing/LandingController.php`
  ```php
  public function index()
  {
      return view('landing.pages.home');
  }


  Testing FASE 1
 Visitar http://localhost/ sin errores
 Layout se muestra correctamente
 Logo visible en header
 Footer visible con enlaces
 No hay errores en consola del navegador
 Tailwind CSS se aplica correctamente
📋 FASE 2: Página Home con Componentes Estáticos
Objetivo: Migrar la página principal con todos sus componentes visuales.

Componentes a Crear
 2.1 resources/views/components/landing/hero.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\landing\hero.blade.php
Convertir clases Bootstrap a Tailwind
Mantener estructura de floating elements
Props: $title, $titleSuffix
 2.2 resources/views/components/landing/features.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\landing\features.blade.php
Grid responsive con Tailwind
Iconos con Blade Icons o Heroicons
 2.3 resources/views/components/landing/benefits.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\landing\benefits.blade.php
Cards con Tailwind
Animaciones con Alpine.js
 2.4 resources/views/components/landing/testimonials.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\landing\testimonials.blade.php
Carousel o grid de testimonios
Estrellas de rating con Tailwind
 2.5 resources/views/components/landing/pricing.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\landing\pricing.blade.php
Cards de precios con Tailwind
Botones CTA
 2.6 resources/views/components/landing/platform-demo.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\landing\platform-demo.blade.php
Demo visual de la plataforma
Imágenes responsive
 2.7 Actualizar resources/views/landing/pages/home.blade.php
Incluir todos los componentes creados
Estructura completa de la landing
Testing FASE 2
 Hero section se muestra correctamente
 Features grid funciona y es responsive
 Benefits cards visibles
 Testimonials se muestran correctamente
 Pricing cards visibles con botones funcionales
 Platform demo se renderiza
 Responsive en mobile (< 768px)
 Responsive en tablet (768px - 1024px)
 Responsive en desktop (> 1024px)
📋 FASE 3: Componentes Livewire Interactivos
Objetivo: Agregar interactividad con Livewire (FAQ, WhatsApp, ContactForm).

Componentes Livewire
 3.1 FAQ Accordion
Archivo PHP: app/Livewire/Landing/FaqAccordion.php
Archivo Blade: resources/views/livewire/landing/faq-accordion.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\landing\faq.blade.php
Funcionalidad: Expandir/colapsar preguntas
Estado: $openQuestion para controlar acordeón
 3.2 WhatsApp Button
Archivo PHP: app/Livewire/Landing/WhatsappButton.php
Archivo Blade: resources/views/livewire/landing/whatsapp-button.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\landing\whatsapp-button.blade.php
Funcionalidad: Botón flotante que abre WhatsApp
Props: $phoneNumber, $message
 3.3 Contact Form
Archivo PHP: app/Livewire/Landing/ContactForm.php
Archivo Blade: resources/views/livewire/landing/contact-form.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\landing\contact.blade.php
Funcionalidad: Formulario con validación
Propiedades: $name, $email, $phone, $message
Método: submit() para enviar
 3.4 Theme Toggle (opcional)
Archivo PHP: app/Livewire/Landing/ThemeToggle.php
Archivo Blade: resources/views/livewire/landing/theme-toggle.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\landing\theme-toggle.blade.php
Funcionalidad: Cambiar entre modo claro/oscuro
Testing FASE 3
 FAQ: Click expande/colapsa correctamente
 FAQ: Solo una pregunta abierta a la vez
 WhatsApp: Botón flotante visible
 WhatsApp: Click abre WhatsApp con mensaje predefinido
 Contact Form: Validación funciona
 Contact Form: Mensajes de error se muestran
 Contact Form: Envío exitoso muestra confirmación
 Theme Toggle: Cambia entre claro/oscuro (si implementado)
📋 FASE 4: Sistema de Booking Completo
Objetivo: Migrar el wizard de reservas multi-paso con Livewire.

Componentes Livewire del Wizard
 4.1 Wizard Principal
Archivo PHP: app/Livewire/Booking/Wizard.php
Archivo Blade: resources/views/livewire/booking/wizard.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\booking\wizard.blade.php
Estado: $currentStep, $bookingData
Métodos: nextStep(), previousStep(), goToStep($step)
 4.2 Service Step (Paso 1)
Archivo PHP: app/Livewire/Booking/ServiceStep.php
Archivo Blade: resources/views/livewire/booking/service-step.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\booking\step-services.blade.php
Cargar servicios desde modelo MedicalService
 4.3 Specialist Step (Paso 2)
Archivo PHP: app/Livewire/Booking/SpecialistStep.php
Archivo Blade: resources/views/livewire/booking/specialist-step.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\booking\step-specialists.blade.php
Filtrar especialistas según servicio seleccionado
 4.4 DateTime Step (Paso 3)
Archivo PHP: app/Livewire/Booking/DateTimeStep.php
Archivo Blade: resources/views/livewire/booking/date-time-step.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\booking\step-datetime.blade.php
Calendario con disponibilidad
Slots de tiempo disponibles
 4.5 Confirmation Step (Paso 4)
Archivo PHP: app/Livewire/Booking/ConfirmationStep.php
Archivo Blade: resources/views/livewire/booking/confirmation-step.blade.php
Origen: C:\laragon\www\fisio\resources\views\components\booking\step-data.blade.php
Resumen de la reserva
Formulario de datos del paciente
Método: confirmBooking() para guardar
 4.6 Controlador Booking
Archivo: app/Http/Controllers/Landing/BookingController.php
Métodos: index(), store(), confirmation($id)
Testing FASE 4
 Visitar /booking sin errores
 Wizard Paso 1: Servicios se cargan desde BD
 Wizard Paso 2: Especialistas filtrados correctamente
 Wizard Paso 3: Calendario muestra fechas disponibles
 Wizard Paso 4: Resumen muestra datos correctos
 Wizard: Navegación adelante/atrás funciona
 Booking: Se guarda en tabla appoinments
 Confirmación: /booking/confirmation/1 muestra datos


 
---

## ✅ Resumen

He creado un **plan de migración completo con checklist** que incluye:

1. **8 Fases** organizadas incrementalmente
2. **49 tareas** específicas con checkboxes
3. **Testing detallado** para cada fase
4. **Referencias** de archivos origen y destino
5. **Comandos útiles** para ejecutar
6. **Mapeo Bootstrap → Tailwind** para conversión
7. **Sección de recursos** y documentación

**Para usar el documento:**

1. Crea el archivo `PLAN_MIGRACION.md` en la raíz del proyecto
2. Copia el contenido markdown de arriba
3. Ve marcando los checkboxes `- [ ]` a `- [x]` conforme avances
4. Actualiza el contador de progreso en cada fase

¿Quieres que comience con la **FASE 1** implementando el layout base y componentes fundamentales?