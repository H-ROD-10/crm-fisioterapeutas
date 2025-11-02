<!-- Agente de Reservas IA -->
<div x-data="bookingAgent()" 
     x-init="init()"
     class="fixed bottom-6 right-6 z-50">
    
    <!-- Chat Widget -->
    <div x-show="showChat" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 transform translate-y-4 scale-95"
         class="absolute bottom-20 right-0 bg-white rounded-2xl shadow-2xl w-96 h-[500px] flex flex-col border border-gray-200"
    >
        
        <!-- Header -->
        <div class="bg-linear-to-r from-emerald-500 to-emerald-600 text-white p-4 rounded-t-2xl flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg">FisioGEM</h3>
                    <p class="text-emerald-100 text-sm">Asistente de Reservas</p>
                </div>
            </div>
            <button @click="showChat = false" class="text-white/80 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Chat Messages -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4" x-ref="chatContainer">
            <!-- Welcome Message -->
            <div x-show="messages.length === 0" class="text-center py-8">
                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <h4 class="font-bold text-gray-900 mb-2">¡Hola! Soy FisioGEM</h4>
                <p class="text-gray-600 text-sm">Tu asistente virtual para reservar citas de fisioterapia. ¿En qué puedo ayudarte hoy?</p>
            </div>
            
            <!-- Messages -->
            <template x-for="(message, index) in messages" :key="index">
                <div class="flex" :class="message.role === 'user' ? 'justify-end' : 'justify-start'">
                    <div class="max-w-[80%]" :class="message.role === 'user' ? 'order-2' : 'order-1'">
                        <!-- Avatar -->
                        <div class="flex items-end space-x-2" :class="message.role === 'user' ? 'flex-row-reverse space-x-reverse' : ''">
                            <div class="w-8 h-8 rounded-full flex shrink-0" 
                                 :class="message.role === 'user' ? 'bg-emerald-500' : 'bg-gray-300'">
                                <div class="w-full h-full rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold" 
                                          x-text="message.role === 'user' ? 'Tú' : 'FG'"></span>
                                </div>
                            </div>
                            <!-- Message Bubble -->
                            <div class="rounded-2xl px-4 py-2 max-w-xs" 
                                 :class="message.role === 'user' ? 'bg-emerald-500 text-white' : 'bg-gray-100 text-gray-900'">
                                <p class="text-sm whitespace-pre-wrap" x-text="message.message"></p>
                                <div class="text-xs opacity-70 mt-1" x-text="formatTime(message.timestamp)"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            
            <!-- Typing Indicator -->
            <div x-show="isTyping" class="flex justify-start">
                <div class="flex items-end space-x-2">
                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-white text-xs font-bold">FG</span>
                    </div>
                    <div class="bg-gray-100 rounded-2xl px-4 py-2">
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Success Message -->
        <div x-show="bookingComplete" 
             x-transition
             class="bg-emerald-50 border-t border-emerald-200 p-4">
            <div class="flex items-center space-x-2 text-emerald-800">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-medium">¡Reserva completada con éxito!</span>
            </div>
        </div>
        
        <!-- Input Area -->
        <div class="border-t border-gray-200 p-4">
            <div class="flex space-x-2">
                <input type="text" 
                       x-model="currentMessage"
                       @keydown.enter="sendMessage()"
                       :disabled="isTyping"
                       placeholder="Escribe tu mensaje..."
                       class="flex-1 border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 disabled:opacity-50">
                <button @click="sendMessage()" 
                        :disabled="isTyping || !currentMessage.trim()"
                        class="bg-emerald-500 text-white rounded-full p-2 hover:bg-emerald-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Floating Button -->
    <div class="relative">
        <!-- Notification Badge -->
        <div x-show="!showChat && hasNewMessage" 
             class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-bold z-10">
            !
        </div>
        
        <!-- Main Button -->
        <button @click="toggleChat()" 
                class="w-16 h-16 bg-linear-to-r from-emerald-500 to-emerald-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center group">
            <svg x-show="!showChat" class="w-8 h-8 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <svg x-show="showChat" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    
    <!-- Tooltip -->
    <div x-show="!showChat && showTooltip" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-2"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="absolute bottom-20 right-0 bg-gray-900 text-white px-4 py-2 rounded-lg text-sm whitespace-nowrap">
        ¿Necesitas reservar una cita? ¡Chatea conmigo!
        <div class="absolute top-full right-4 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
    </div>
</div>

<script>
function bookingAgent() {
    return {
        showChat: false,
        showTooltip: false,
        hasNewMessage: false,
        messages: [],
        currentMessage: '',
        isTyping: false,
        bookingComplete: false,
        conversationHistory: [],
        
        init() {
            // Mostrar tooltip después de 3 segundos
            setTimeout(() => {
                this.showTooltip = true;
            }, 3000);
            
            // Ocultar tooltip después de 8 segundos
            setTimeout(() => {
                this.showTooltip = false;
            }, 8000);
        },
        
        toggleChat() {
            this.showChat = !this.showChat;
            this.hasNewMessage = false;
            
            if (this.showChat) {
                this.showTooltip = false;
                // Auto-focus en el input cuando se abre
                this.$nextTick(() => {
                    this.$refs.chatContainer?.scrollTo(0, this.$refs.chatContainer.scrollHeight);
                });
            }
        },
        
        async sendMessage() {
            if (!this.currentMessage.trim() || this.isTyping) return;
            
            const message = this.currentMessage.trim();
            this.currentMessage = '';
            
            // Agregar mensaje del usuario
            this.messages.push({
                role: 'user',
                message: message,
                timestamp: new Date()
            });
            
            this.scrollToBottom();
            this.isTyping = true;
            
            try {
                const response = await fetch('/booking-agent/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        message: message,
                        history: this.conversationHistory
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Agregar respuesta del asistente
                    this.messages.push({
                        role: 'assistant',
                        message: data.reply,
                        timestamp: new Date()
                    });
                    
                    // Actualizar historial
                    this.conversationHistory = data.history || [];
                    
                    // Verificar si se completó la reserva
                    if (data.is_booking_complete) {
                        this.bookingComplete = true;
                        setTimeout(() => {
                            this.bookingComplete = false;
                        }, 5000);
                    }
                    
                    // Mostrar notificación si el chat está cerrado
                    if (!this.showChat) {
                        this.hasNewMessage = true;
                    }
                } else {
                    this.messages.push({
                        role: 'assistant',
                        message: data.reply || 'Lo siento, ha ocurrido un error. Por favor, contacta al 966 52 XX XX.',
                        timestamp: new Date()
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                this.messages.push({
                    role: 'assistant',
                    message: 'Lo siento, ha ocurrido un error de conexión. Por favor, contacta al 966 52 XX XX.',
                    timestamp: new Date()
                });
            } finally {
                this.isTyping = false;
                this.scrollToBottom();
            }
        },
        
        scrollToBottom() {
            this.$nextTick(() => {
                if (this.$refs.chatContainer) {
                    this.$refs.chatContainer.scrollTop = this.$refs.chatContainer.scrollHeight;
                }
            });
        },
        
        formatTime(timestamp) {
            return new Date(timestamp).toLocaleTimeString('es-ES', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
        }
    }
}
</script>
