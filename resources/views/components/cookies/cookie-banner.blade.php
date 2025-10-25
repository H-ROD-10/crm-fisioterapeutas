<div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-white border-t-2 border-gray-200 shadow-2xl z-50 transform translate-y-full transition-transform duration-500" style="display: none;">
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex-1">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-emerald-600 shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Utilizamos cookies</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Utilizamos cookies propias y de terceros para mejorar nuestros servicios, personalizar su experiencia y mostrar publicidad relevante. 
                            Al hacer clic en "Aceptar todas", acepta el uso de todas las cookies. Puede gestionar sus preferencias en 
                            <a href="{{ route('legal.cookies') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold underline">Configuración de cookies</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <button onclick="openCookieSettings()" class="px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg border-2 border-gray-300 hover:bg-gray-50 transition-all whitespace-nowrap">
                    Configurar
                </button>
                <button onclick="rejectCookies()" class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-all whitespace-nowrap">
                    Rechazar
                </button>
                <button onclick="acceptAllCookies()" class="px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-all whitespace-nowrap">
                    Aceptar todas
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Cookie Settings Modal -->
<div id="cookie-settings-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4" style="display: none;">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 p-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Configuración de Cookies</h2>
            <button onclick="closeCookieSettings()" class="p-2 hover:bg-gray-100 rounded-lg transition-all">
                <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        
        <div class="p-6 space-y-6">
            <p class="text-gray-600 leading-relaxed">
                Utilizamos diferentes tipos de cookies para optimizar su experiencia en nuestro sitio web. 
                Puede elegir qué categorías de cookies desea permitir.
            </p>

            <!-- Cookies Necesarias -->
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Cookies Estrictamente Necesarias</h3>
                        <p class="text-sm text-gray-600">
                            Estas cookies son esenciales para el funcionamiento del sitio web y no se pueden desactivar.
                        </p>
                    </div>
                    <div class="ml-4">
                        <div class="w-12 h-6 bg-gray-300 rounded-full relative cursor-not-allowed opacity-50">
                            <div class="absolute right-1 top-1 w-4 h-4 bg-white rounded-full"></div>
                        </div>
                        <span class="text-xs text-gray-500 mt-1 block">Siempre activas</span>
                    </div>
                </div>
            </div>

            <!-- Cookies de Rendimiento -->
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Cookies de Rendimiento</h3>
                        <p class="text-sm text-gray-600">
                            Nos ayudan a entender cómo los visitantes interactúan con nuestro sitio web mediante análisis anónimos.
                        </p>
                    </div>
                    <div class="ml-4">
                        <label class="relative inline-block w-12 h-6 cursor-pointer">
                            <input type="checkbox" id="cookie-performance" class="sr-only peer" checked>
                            <div class="w-12 h-6 bg-gray-300 peer-checked:bg-emerald-600 rounded-full peer transition-all"></div>
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full peer-checked:translate-x-6 transition-transform"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Cookies de Funcionalidad -->
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Cookies de Funcionalidad</h3>
                        <p class="text-sm text-gray-600">
                            Permiten recordar sus preferencias para proporcionar funcionalidades mejoradas y personalizadas.
                        </p>
                    </div>
                    <div class="ml-4">
                        <label class="relative inline-block w-12 h-6 cursor-pointer">
                            <input type="checkbox" id="cookie-functionality" class="sr-only peer" checked>
                            <div class="w-12 h-6 bg-gray-300 peer-checked:bg-emerald-600 rounded-full peer transition-all"></div>
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full peer-checked:translate-x-6 transition-transform"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Cookies de Marketing -->
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Cookies de Marketing</h3>
                        <p class="text-sm text-gray-600">
                            Se utilizan para mostrar anuncios relevantes y medir la efectividad de nuestras campañas publicitarias.
                        </p>
                    </div>
                    <div class="ml-4">
                        <label class="relative inline-block w-12 h-6 cursor-pointer">
                            <input type="checkbox" id="cookie-marketing" class="sr-only peer">
                            <div class="w-12 h-6 bg-gray-300 peer-checked:bg-emerald-600 rounded-full peer transition-all"></div>
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full peer-checked:translate-x-6 transition-transform"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded-lg">
                <p class="text-sm text-gray-700">
                    <strong>Nota:</strong> Para más información sobre cómo utilizamos las cookies, consulte nuestra 
                    <a href="{{ route('legal.cookies') }}" class="text-blue-600 hover:text-blue-700 font-semibold underline">Política de Cookies</a>.
                </p>
            </div>
        </div>

        <div class="sticky bottom-0 bg-gray-50 border-t border-gray-200 p-6 flex flex-col sm:flex-row gap-3">
            <button onclick="saveCustomCookies()" class="flex-1 px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-all">
                Guardar Preferencias
            </button>
            <button onclick="acceptAllCookiesFromModal()" class="flex-1 px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-all">
                Aceptar Todas
            </button>
        </div>
    </div>
</div>

<script>
// Cookie Consent Management
(function() {
    'use strict';
    
    const COOKIE_NAME = 'cookie_consent';
    const COOKIE_EXPIRY_DAYS = 365;
    
    // Check if consent already given
    function hasConsent() {
        return getCookie(COOKIE_NAME) !== null;
    }
    
    // Get cookie value
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }
    
    // Set cookie
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${date.toUTCString()}`;
        document.cookie = `${name}=${value};${expires};path=/;SameSite=Lax`;
    }
    
    // Show banner
    function showBanner() {
        const banner = document.getElementById('cookie-banner');
        if (banner) {
            banner.style.display = 'block';
            setTimeout(() => {
                banner.style.transform = 'translateY(0)';
            }, 100);
        }
    }
    
    // Hide banner
    function hideBanner() {
        const banner = document.getElementById('cookie-banner');
        if (banner) {
            banner.style.transform = 'translateY(100%)';
            setTimeout(() => {
                banner.style.display = 'none';
            }, 500);
        }
    }
    
    // Accept all cookies
    window.acceptAllCookies = function() {
        const consent = {
            necessary: true,
            performance: true,
            functionality: true,
            marketing: true,
            timestamp: new Date().toISOString()
        };
        setCookie(COOKIE_NAME, JSON.stringify(consent), COOKIE_EXPIRY_DAYS);
        hideBanner();
        loadAnalytics();
    };
    
    // Reject cookies
    window.rejectCookies = function() {
        const consent = {
            necessary: true,
            performance: false,
            functionality: false,
            marketing: false,
            timestamp: new Date().toISOString()
        };
        setCookie(COOKIE_NAME, JSON.stringify(consent), COOKIE_EXPIRY_DAYS);
        hideBanner();
    };
    
    // Open settings modal
    window.openCookieSettings = function() {
        document.getElementById('cookie-settings-modal').style.display = 'flex';
        
        // Load current preferences
        const consentStr = getCookie(COOKIE_NAME);
        if (consentStr) {
            try {
                const consent = JSON.parse(consentStr);
                document.getElementById('cookie-performance').checked = consent.performance || false;
                document.getElementById('cookie-functionality').checked = consent.functionality || false;
                document.getElementById('cookie-marketing').checked = consent.marketing || false;
            } catch (e) {
                console.error('Error parsing cookie consent:', e);
            }
        }
    };
    
    // Close settings modal
    window.closeCookieSettings = function() {
        document.getElementById('cookie-settings-modal').style.display = 'none';
    };
    
    // Save custom cookies
    window.saveCustomCookies = function() {
        const consent = {
            necessary: true,
            performance: document.getElementById('cookie-performance').checked,
            functionality: document.getElementById('cookie-functionality').checked,
            marketing: document.getElementById('cookie-marketing').checked,
            timestamp: new Date().toISOString()
        };
        setCookie(COOKIE_NAME, JSON.stringify(consent), COOKIE_EXPIRY_DAYS);
        closeCookieSettings();
        hideBanner();
        
        if (consent.performance) {
            loadAnalytics();
        }
    };
    
    // Accept all from modal
    window.acceptAllCookiesFromModal = function() {
        document.getElementById('cookie-performance').checked = true;
        document.getElementById('cookie-functionality').checked = true;
        document.getElementById('cookie-marketing').checked = true;
        saveCustomCookies();
    };
    
    // Load analytics if consented
    function loadAnalytics() {
        const consentStr = getCookie(COOKIE_NAME);
        if (!consentStr) return;
        
        try {
            const consent = JSON.parse(consentStr);
            
            // Load Google Analytics if performance cookies accepted
            if (consent.performance && typeof gtag !== 'undefined') {
                gtag('consent', 'update', {
                    'analytics_storage': 'granted'
                });
            }
            
            // Load marketing scripts if marketing cookies accepted
            if (consent.marketing) {
                // Add your marketing scripts here
            }
        } catch (e) {
            console.error('Error loading analytics:', e);
        }
    }
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        if (!hasConsent()) {
            setTimeout(showBanner, 1000);
        } else {
            loadAnalytics();
        }
    });
    
    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCookieSettings();
        }
    });
})();
</script>