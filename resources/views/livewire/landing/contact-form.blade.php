<section id="contact" class="py-20 bg-linear-to-br from-gray-50 to-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Left Column: Info -->
                <div data-aos="fade-right">
                    <div class="inline-block px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold mb-4">
                        Contacto
                    </div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">
                        ¿Listo para empezar?
                    </h2>
                    <p class="text-xl text-gray-600 mb-8">
                        Solicita una demo personalizada y descubre cómo CRM Fisio puede transformar tu clínica
                    </p>

                    <!-- Contact Info Cards -->
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4 p-4 bg-white rounded-xl shadow-sm">
                            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Email</h4>
                                <p class="text-gray-600">info@crmfisio.com</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 p-4 bg-white rounded-xl shadow-sm">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Teléfono</h4>
                                <p class="text-gray-600">+34 600 000 000</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 p-4 bg-white rounded-xl shadow-sm">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Oficina</h4>
                                <p class="text-gray-600">Madrid, España</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Form -->
                <div data-aos="fade-left">
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <form x-data="contactForm()" @submit.prevent="submitForm" class="space-y-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Nombre completo *</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    x-model="formData.name"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                                    placeholder="Juan Pérez"
                                >
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">Email *</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    x-model="formData.email"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                                    placeholder="juan@clinica.com"
                                >
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-900 mb-2">Teléfono *</label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    x-model="formData.phone"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                                    placeholder="+34 600 000 000"
                                >
                            </div>

                            <!-- Clinic Name -->
                            <div>
                                <label for="clinic" class="block text-sm font-semibold text-gray-900 mb-2">Nombre de la clínica</label>
                                <input 
                                    type="text" 
                                    id="clinic" 
                                    x-model="formData.clinic"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                                    placeholder="Fisioterapia Salud"
                                >
                            </div>

                            <!-- Message -->
                            <div>
                                <label for="message" class="block text-sm font-semibold text-gray-900 mb-2">Mensaje</label>
                                <textarea 
                                    id="message" 
                                    x-model="formData.message"
                                    rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors resize-none"
                                    placeholder="Cuéntanos sobre tu clínica y tus necesidades..."
                                ></textarea>
                            </div>

                            <!-- Privacy Policy -->
                            <div class="flex items-start">
                                <input 
                                    type="checkbox" 
                                    id="privacy" 
                                    x-model="formData.privacy"
                                    required
                                    class="mt-1 w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500"
                                >
                                <label for="privacy" class="ml-2 text-sm text-gray-600">
                                    Acepto la <a href="#" class="text-emerald-600 hover:text-emerald-700 font-semibold">política de privacidad</a> y el tratamiento de mis datos *
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button 
                                type="submit"
                                :disabled="loading"
                                :class="{ 'opacity-50 cursor-not-allowed': loading }"
                                class="w-full px-8 py-4 bg-linear-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold rounded-lg transition-all shadow-lg hover:shadow-xl flex items-center justify-center">
                                <span x-show="!loading">Solicitar Demo Gratuita</span>
                                <span x-show="loading" class="flex items-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Enviando...
                                </span>
                            </button>

                            <!-- Success Message -->
                            <div x-show="success" x-transition class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                                <p class="font-semibold">¡Mensaje enviado con éxito!</p>
                                <p class="text-sm">Nos pondremos en contacto contigo pronto.</p>
                            </div>

                            <!-- Error Message -->
                            <div x-show="error" x-transition class="p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                <p class="font-semibold">Error al enviar el mensaje</p>
                                <p class="text-sm">Por favor, inténtalo de nuevo más tarde.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function contactForm() {
    return {
        formData: {
            name: '',
            email: '',
            phone: '',
            clinic: '',
            message: '',
            privacy: false
        },
        loading: false,
        success: false,
        error: false,
        
        submitForm() {
            this.loading = true;
            this.success = false;
            this.error = false;
            
            // Simulate API call
            setTimeout(() => {
                // Here you would make an actual API call to your backend
                // Example: fetch('/api/contact', { method: 'POST', body: JSON.stringify(this.formData) })
                
                // Simulate success (90% success rate)
                if (Math.random() > 0.1) {
                    this.success = true;
                    this.loading = false;
                    
                    // Reset form after 3 seconds
                    setTimeout(() => {
                        this.formData = {
                            name: '',
                            email: '',
                            phone: '',
                            clinic: '',
                            message: '',
                            privacy: false
                        };
                        this.success = false;
                    }, 3000);
                } else {
                    this.error = true;
                    this.loading = false;
                    
                    // Hide error after 5 seconds
                    setTimeout(() => {
                        this.error = false;
                    }, 5000);
                }
            }, 2000);
        }
    }
}
</script>
