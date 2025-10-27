import './bootstrap';



// Alpine.js ya viene incluido con Livewire/Filament
// No es necesario importarlo manualmente

// Smooth scroll para navegación
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
});

// resources/js/voice-recorder.js
class VoiceRecorder {
  constructor() {
    this.isRecording = false;
    this.currentField = null;
    this.currentButton = null;
    this.recognition = null;
    this.initRecognition();
    console.log('VoiceRecorder inicializado');
  }

  initRecognition() {
    if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
      console.warn('Web Speech API no disponible');
      return;
    }
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    this.recognition = new SpeechRecognition();
    this.recognition.continuous = true;
    this.recognition.interimResults = true;
    this.recognition.lang = 'es-ES';

    this.recognition.onresult = (event) => {
      let finalTranscript = '';
      for (let i = event.resultIndex; i < event.results.length; i++) {
        if (event.results[i].isFinal) finalTranscript += event.results[i][0].transcript + ' ';
      }
      if (finalTranscript && this.currentField) {
        this.updateField(this.currentField, finalTranscript.trim());
      }
    };

    this.recognition.onerror = () => this.stopRecording();
    this.recognition.onend = () => this.stopRecording();
  }

  startRecording(fieldName, button) {
    if (!this.recognition) {
      alert('Reconocimiento de voz no disponible');
      return;
    }
    if (this.isRecording) {
      this.stopRecording();
      return;
    }
    this.currentField = fieldName;
    this.currentButton = button || null;
    this.isRecording = true;

    if (button) {
      button.style.color = '#ef4444';
      button.classList.add('animate-pulse');
      // Cambiar icono a STOP y guardar el original
      this.swapButtonIcon(button, 'stop');
    }

    try {
      this.recognition.start();
    } catch (error) {
      console.error('Error al iniciar:', error);
      this.stopRecording();
    }
  }

  stopRecording() {
    if (this.recognition && this.isRecording) this.recognition.stop();
    this.isRecording = false;
    this.currentField = null;
    this.currentButton = null;

    document.querySelectorAll('[data-voice-button]').forEach((btn) => {
      btn.style.color = '';
      btn.classList.remove('animate-pulse');
      // Restaurar icono original (micrófono)
      this.swapButtonIcon(btn, 'mic');
    });
  }

  updateField(fieldName, text) {
    const scopes = [];
    if (this.currentButton) {
      const container = this.currentButton.closest(`[wire\\:partial*="mountedActionSchema0.${fieldName}"]`) ||
        this.currentButton.closest('[wire\\:partial]') ||
        this.currentButton.closest('.fi-sc-component') ||
        this.currentButton.closest('[data-field-wrapper]');
      if (container) scopes.push(container);
    }
    scopes.push(document);

    let textarea = null;
    for (const root of scopes) {
      textarea =
        root.querySelector(`[id="mountedActionSchema0.${fieldName}"]`) ||
        root.querySelector(`[id$=".${fieldName}"]`) ||
        root.querySelector(`[wire\\:model="mountedActions.0.data.${fieldName}"]`) ||
        root.querySelector(`[wire\\:model$=".${fieldName}"]`) ||
        root.querySelector(`textarea[name="data[${fieldName}]"]`) ||
        root.querySelector(`textarea[name$="[${fieldName}]"]`);
      if (textarea) break;
    }
    if (!textarea) return console.error('No se encontró textarea para:', fieldName);
    const currentValue = textarea.value || '';
    textarea.value = currentValue ? `${currentValue} ${text}` : text;
    textarea.dispatchEvent(new Event('input', { bubbles: true }));
    textarea.dispatchEvent(new Event('change', { bubbles: true }));
  }

  swapButtonIcon(button, to) {
    if (!button) return;
    if (to === 'stop') {
      if (!button.dataset.originalIcon) {
        button.dataset.originalIcon = button.innerHTML;
      }
      button.innerHTML = this.getStopIconSvg();
      button.setAttribute('aria-label', 'Detener grabación');
      button.title = 'Detener grabación';
    } else {
      if (button.dataset.originalIcon) {
        button.innerHTML = button.dataset.originalIcon;
        delete button.dataset.originalIcon;
      }
      button.setAttribute('aria-label', 'Grabar');
      button.title = 'Grabar';
    }
  }

  getStopIconSvg() {
    // Icono "stop" (outline) compatible con estilo de heroicons outline
    return `
      <svg class="fi-icon fi-size-sm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 7.5A2.5 2.5 0 0 1 7.5 5h9A2.5 2.5 0 0 1 19 7.5v9A2.5 2.5 0 0 1 16.5 19h-9A2.5 2.5 0 0 1 5 16.5v-9Z"/>
      </svg>
    `;
  }
}

// Exportar global
window.VoiceRecorder = VoiceRecorder;
window.voiceRecorder = window.voiceRecorder || new VoiceRecorder();

// Delegación de eventos para botones de voz (evita inline JS y problemas de escape)
document.addEventListener('click', (e) => {
  const btn = e.target.closest('[data-voice-field]');
  if (!btn) return;
  const field = btn.getAttribute('data-voice-field');
  if (!field) return;
  e.preventDefault();
  // Evitar que Alpine/Livewire manejen el mismo click del Action
  if (e.stopImmediatePropagation) e.stopImmediatePropagation();
  e.stopPropagation();
  if (window.voiceRecorder) {
    window.voiceRecorder.startRecording(field, btn);
  } else {
    console.error('voiceRecorder no está disponible');
  }
}, true);
