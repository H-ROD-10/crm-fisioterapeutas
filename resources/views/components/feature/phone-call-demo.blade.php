<div class="flex items-center justify-center h-full">
    <div class="relative w-80 h-[600px]">
        <!-- Phone Frame -->
        <div class="absolute inset-0 bg-gray-900 rounded-[3rem] shadow-2xl p-3">
            <!-- Notch -->
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-40 h-7 bg-gray-900 rounded-b-3xl z-10"></div>
            
            <!-- Screen -->
            <div class="relative w-full h-full bg-linear-to-br from-emerald-600 to-teal-700 rounded-[2.5rem] overflow-hidden">
                <!-- Call Interface -->
                <div class="flex flex-col items-center justify-between h-full p-8 text-white">
                    <!-- Header -->
                    <div class="text-center">
                        <span class="text-sm opacity-80">Llamada en curso</span>
                        <span class="block text-2xl font-bold mt-1" id="call-timer">00:42</span>
                    </div>
                    
                    <!-- Avatar -->
                    <div class="flex flex-col items-center">
                        <div class="w-32 h-32 bg-white/20 backdrop-blur-lg rounded-full flex items-center justify-center mb-4 shadow-xl">
                            <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"/>
                                <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-1">Asistente IA</h3>
                        <span class="text-sm opacity-80">Conversando</span>
                    </div>
                    
                    <!-- Voice Visualization -->
                    <div class="flex items-center justify-center space-x-1 h-16">
                        <div class="w-1 bg-white rounded-full animate-voice-wave" style="animation-delay: 0s; height: 20px;"></div>
                        <div class="w-1 bg-white rounded-full animate-voice-wave" style="animation-delay: 0.1s; height: 35px;"></div>
                        <div class="w-1 bg-white rounded-full animate-voice-wave" style="animation-delay: 0.2s; height: 50px;"></div>
                        <div class="w-1 bg-white rounded-full animate-voice-wave" style="animation-delay: 0.3s; height: 35px;"></div>
                        <div class="w-1 bg-white rounded-full animate-voice-wave" style="animation-delay: 0.4s; height: 45px;"></div>
                        <div class="w-1 bg-white rounded-full animate-voice-wave" style="animation-delay: 0.5s; height: 30px;"></div>
                        <div class="w-1 bg-white rounded-full animate-voice-wave" style="animation-delay: 0.6s; height: 40px;"></div>
                        <div class="w-1 bg-white rounded-full animate-voice-wave" style="animation-delay: 0.7s; height: 25px;"></div>
                    </div>
                    
                    <!-- CTA Text -->
                    <div class="text-center mb-4">
                        <p class="text-sm opacity-90 mb-2">Haz clic en el botón para escuchar una llamada de demostración</p>
                        <svg class="w-8 h-8 mx-auto animate-bounce text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    
                    <!-- Audio Element (hidden) -->
                    <audio id="call-audio-demo" preload="metadata" class="hidden">
                        <source src="{{ asset('audio/asistente-llamada-demo.mp3') }}" type="audio/mp3">
                    </audio>
                    
                    <!-- Call Actions -->
                    <div class="flex items-center justify-center space-x-6">
                        <button id="call-button-demo" class="w-16 h-16 bg-white/20 backdrop-blur-lg rounded-full flex items-center justify-center hover:bg-white/30 transition-all shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </button>
                        <button id="end-call-button-demo" class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center hover:bg-red-600 transition-all shadow-lg">
                            <svg class="w-8 h-8 text-white transform rotate-135" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes voice-wave {
    0%, 100% { height: 20px; }
    50% { height: 50px; }
}
.animate-voice-wave {
    animation: voice-wave 1s ease-in-out infinite;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const audio = document.getElementById('call-audio-demo');
    const callBtn = document.getElementById('call-button-demo');
    const endBtn = document.getElementById('end-call-button-demo');
    const timer = document.getElementById('call-timer');
    
    let interval;
    let seconds = 42;
    
    if (callBtn && audio) {
        callBtn.addEventListener('click', function() {
            audio.play();
            startTimer();
        });
    }
    
    if (endBtn && audio) {
        endBtn.addEventListener('click', function() {
            audio.pause();
            audio.currentTime = 0;
            stopTimer();
            seconds = 42;
            updateTimer();
        });
    }
    
    function startTimer() {
        interval = setInterval(function() {
            seconds++;
            updateTimer();
        }, 1000);
    }
    
    function stopTimer() {
        clearInterval(interval);
    }
    
    function updateTimer() {
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        timer.textContent = `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
    }
});
</script>