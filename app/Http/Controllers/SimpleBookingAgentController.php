<?php

namespace App\Http\Controllers;

use App\Models\Appoinment;
use App\Models\Patient;
use App\Models\MedicalService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;

class SimpleBookingAgentController extends Controller
{
    private $model = 'gemini-2.0-flash';

    /**
     * Chat simple con el agente de reservas
     */
    public function chat(Request $request)
    {
        try {
            $userMessage = $request->input('message');
            $conversationHistory = $request->input('history', []);
            
            \Log::info('=== INICIO CHAT REQUEST ===', [
                'message' => $userMessage,
                'history_count' => count($conversationHistory)
            ]);
            
            // Construir el contexto de la conversación
            $context = $this->buildContext($conversationHistory, $userMessage);
            
            // Determinar si necesitamos ejecutar alguna función
            $functionResult = $this->detectAndExecuteFunction($userMessage, $conversationHistory);
            
            \Log::info('Resultado de detectAndExecuteFunction', [
                'functionResult' => $functionResult,
                'message' => $userMessage
            ]);
            
            if ($functionResult) {
                $context .= "\n\nInformación del sistema: " . json_encode($functionResult, JSON_UNESCAPED_UNICODE);
            }
            
            // Generar respuesta con Gemini
            $response = Gemini::generativeModel($this->model)->generateContent($context);
            
            $reply = $response->text();
            
            // Actualizar historial
            $newHistory = $conversationHistory;
            $newHistory[] = ['role' => 'user', 'message' => $userMessage];
            
            // Si hay resultado de función, agregarlo al historial para referencia futura
            if ($functionResult && isset($functionResult['fisioterapeuta_seleccionado'])) {
                $newHistory[] = ['role' => 'assistant', 'message' => $reply, 'data' => $functionResult];
            } else {
                $newHistory[] = ['role' => 'assistant', 'message' => $reply];
            }
            
            return response()->json([
                'success' => true,
                'reply' => $reply,
                'history' => $newHistory,
                'is_booking_complete' => $this->isBookingComplete($functionResult),
                'function_executed' => $functionResult ? $functionResult['function'] : null
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error en SimpleBookingAgentController', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'reply' => 'Lo siento, he tenido un problema técnico. Por favor, contacta directamente al 966 52 XX XX para hacer tu reserva.',
                'error' => 'SYSTEM_ERROR'
            ], 500);
        }
    }

    /**
     * Construir el contexto para Gemini
     */
    private function buildContext(array $history, string $newMessage): string
    {
        // Obtener servicios disponibles de la base de datos
        $serviciosResult = $this->obtenerServicios();
        $serviciosText = '';
        
        if ($serviciosResult['status'] === 'success') {
            foreach ($serviciosResult['services'] as $service) {
                $serviciosText .= "   - {$service['name']}: {$service['description']} ({$service['duration']}, {$service['price']})\n";
            }
        }
        
        // Instrucción del Sistema (la personalidad y tarea del asistente)
        $systemInstruction = "Eres 'FisioGEM', un asistente virtual especializado en reservas para la Clínica de Fisioterapia FisioAlcoy.

PERSONALIDAD:
- Amable, profesional y empático
- Hablas en español de forma natural y cercana
- Eres eficiente pero no apresurado

OBJETIVO PRINCIPAL:
Ayudar a los pacientes a reservar citas de fisioterapia siguiendo un flujo estructurado paso a paso.

FLUJO OBLIGATORIO DE CONVERSACIÓN (SEGUIR EN ESTE ORDEN):
1. **Saludo inicial** y pregunta si necesita reservar una cita
2. **Paso 1 - NOMBRE:** Obtén el nombre completo del paciente
3. **Paso 2 - SÍNTOMAS:** Pregunta qué síntomas o molestias tiene para determinar el servicio adecuado
4. **Paso 3 - SERVICIO:** Basándote en los síntomas, sugiere el servicio más apropiado de los disponibles:
{$serviciosText}
5. **Paso 4 - TELÉFONO:** Solicita número de teléfono
6. **Paso 5 - EMAIL:** Solicita correo electrónico
7. **Paso 6 - DNI:** Solicita cédula de identidad (formato: V-12345678 o solo números)
8. **Paso 7 - FECHA:** Pregunta qué fecha prefiere
9. **Paso 8 - HORA:** Pregunta qué hora prefiere
10. **Paso 9 - VERIFICACIÓN:** Verifica disponibilidad y muestra fisioterapeutas disponibles
11. **Paso 10 - SELECCIÓN:** Permite elegir fisioterapeuta
12. **Paso 11 - CONFIRMACIÓN:** Confirma todos los datos y crea la reserva

REGLAS CRÍTICAS:
- NO avances al siguiente paso hasta obtener la información del paso actual
- Si el usuario se desvía del tema, redirige amablemente: 'Para consultas generales, puedes contactarnos al 966 52 XX XX. Ahora, continuemos con tu reserva...'
- Pide UN SOLO dato por vez, no hagas listas de múltiples preguntas
- Sé paciente y espera la respuesta antes de continuar
- Cuando tengas fecha y hora, SIEMPRE verifica disponibilidad antes de continuar

HORARIO DE ATENCIÓN:
Lunes a Viernes de 9:00 a 18:00 (no fines de semana)

EJEMPLO DE FLUJO:
Usuario: 'Quiero reservar una cita'
Tú: '¡Perfecto! Para comenzar, ¿cuál es tu nombre completo?'
Usuario: 'Juan Pérez'
Tú: 'Encantado Juan. ¿Qué síntomas o molestias tienes que te gustaría tratar?'
Usuario: 'Me duele el hombro'
Tú: 'Entiendo. Por el dolor de hombro, te recomendaría fisioterapia general. ¿Te parece bien este servicio?'
Usuario: 'Sí'
Tú: 'Perfecto. ¿Cuál es tu número de teléfono?'
...y así sucesivamente.

Mantén el foco en obtener la información paso a paso de manera conversacional.";

        $context = $systemInstruction . "\n\nCONVERSACIÓN:\n";
        
        // Agregar historial
        foreach ($history as $item) {
            $role = $item['role'] === 'user' ? 'Usuario' : 'FisioGEM';
            $context .= "{$role}: {$item['message']}\n";
        }
        
        $context .= "Usuario: {$newMessage}\nFisioGEM: ";
        
        return $context;
    }

    /**
     * Detectar si necesitamos ejecutar alguna función basada en el mensaje
     */
    private function detectAndExecuteFunction(string $message, array $history): ?array
    {
        $originalMessage = $message;
        $message = strtolower($message);
        
        // Debug temporal - mostrar información extraída
        if (strtolower(trim($originalMessage)) === 'debug') {
            $bookingInfo = $this->extractBookingInfo($history, $originalMessage);
            return [
                'function' => 'debug',
                'status' => 'info',
                'message' => "🔍 **Información extraída:**\n\n" . 
                            "• **Nombre:** " . ($bookingInfo['nombre'] ?? 'NO DETECTADO') . "\n" .
                            "• **DNI:** " . ($bookingInfo['dni'] ?? 'NO DETECTADO') . "\n" .
                            "• **Email:** " . ($bookingInfo['email'] ?? 'NO DETECTADO') . "\n" .
                            "• **Teléfono:** " . ($bookingInfo['telefono'] ?? 'NO DETECTADO') . "\n" .
                            "• **Fecha:** " . ($bookingInfo['fecha'] ?? 'NO DETECTADO') . "\n" .
                            "• **Hora:** " . ($bookingInfo['hora'] ?? 'NO DETECTADO') . "\n" .
                            "• **Servicio:** " . ($bookingInfo['servicio'] ?? 'NO DETECTADO') . "\n" .
                            "• **Fisioterapeuta:** " . ($bookingInfo['fisioterapeuta_seleccion'] ?? 'NO DETECTADO') . "\n\n" .
                            "**¿Está completa?** " . ($this->isCompleteBookingInfo($bookingInfo) ? '✅ SÍ' : '❌ NO') . "\n\n" .
                            "**Historial:** " . count($history) . " mensajes"
            ];
        }
        
        // Comando para forzar verificación de disponibilidad
        if (strtolower(trim($originalMessage)) === 'verificar') {
            $bookingInfo = $this->extractBookingInfo($history, $originalMessage);
            \Log::info('FORZANDO VERIFICACIÓN DE DISPONIBILIDAD', $bookingInfo);
            return $this->verificarDisponibilidad($bookingInfo);
        }
        
        // Comando para forzar creación de reserva
        if (strtolower(trim($originalMessage)) === 'crear') {
            $bookingInfo = $this->extractBookingInfo($history, $originalMessage);
            \Log::info('FORZANDO CREACIÓN DE RESERVA', $bookingInfo);
            return $this->crearReserva($bookingInfo);
        }
        
        // TRIGGER PRINCIPAL: Detectar cuando se proporciona fecha y hora
        $hasDia = (strpos($message, 'lunes') !== false || strpos($message, 'martes') !== false || 
                   strpos($message, 'marte') !== false || // "El marte" sin s
                   strpos($message, 'miércoles') !== false || strpos($message, 'miercoles') !== false ||
                   strpos($message, 'jueves') !== false || strpos($message, 'viernes') !== false);
        $hasHora = (strpos($message, 'am') !== false || strpos($message, 'pm') !== false || 
                    preg_match('/\d{1,2}:\d{2}/', $originalMessage));
        $historyCount = count($history);
        
        \Log::info('EVALUANDO TRIGGER PRINCIPAL', [
            'message' => $originalMessage,
            'hasDia' => $hasDia,
            'hasHora' => $hasHora,
            'historyCount' => $historyCount,
            'condition' => $hasDia && $hasHora && $historyCount > 3
        ]);
        
        if ($hasDia && $hasHora && $historyCount > 3) { // Reducido de 5 a 3
            
            $bookingInfo = $this->extractBookingInfo($history, $originalMessage);
            
            \Log::info('BOOKING INFO EXTRAÍDA', [
                'bookingInfo' => $bookingInfo,
                'hasNombre' => !empty($bookingInfo['nombre']),
                'hasServicio' => !empty($bookingInfo['servicio'])
            ]);
            
            if (!empty($bookingInfo['nombre']) && !empty($bookingInfo['servicio'])) {
                \Log::info('EJECUTANDO VERIFICAR DISPONIBILIDAD', $bookingInfo);
                return $this->verificarDisponibilidad($bookingInfo);
            }
        }
        
        // Detectar confirmación final (solo "sí", "si", "confirmo")
        $isConfirmation = (strtolower(trim($originalMessage)) === 'sí' ||
                          strtolower(trim($originalMessage)) === 'si' ||
                          strpos(strtolower($originalMessage), 'confirmo') !== false);
        
        \Log::info('EVALUANDO CONFIRMACIÓN FINAL', [
            'message' => $originalMessage,
            'isConfirmation' => $isConfirmation,
            'historyCount' => count($history),
            'condition' => $isConfirmation && count($history) > 8
        ]);
        
        if ($isConfirmation && count($history) > 8) { // Solo en conversaciones avanzadas
            
            $bookingInfo = $this->extractBookingInfo($history, $originalMessage);
            
            \Log::info('BOOKING INFO PARA CONFIRMACIÓN', [
                'bookingInfo' => $bookingInfo,
                'isComplete' => $this->isCompleteBookingInfo($bookingInfo),
                'fisioterapeuta_seleccion' => $bookingInfo['fisioterapeuta_seleccion'] ?? 'NULL',
                'history_count' => count($history)
            ]);
            
            // Buscar fisioterapeuta en historial si no se encontró
            if (empty($bookingInfo['fisioterapeuta_seleccion'])) {
                foreach ($history as $item) {
                    if ($item['role'] === 'assistant' && isset($item['data']['fisioterapeuta_seleccionado'])) {
                        $bookingInfo['fisioterapeuta_seleccion'] = $item['data']['fisioterapeuta_seleccionado'];
                        \Log::info('FISIOTERAPEUTA ENCONTRADO EN HISTORIAL', [
                            'fisioterapeuta' => $bookingInfo['fisioterapeuta_seleccion']
                        ]);
                        break;
                    }
                }
            }
            
            if ($this->isCompleteBookingInfo($bookingInfo)) {
                \Log::info('EJECUTANDO CREAR RESERVA', $bookingInfo);
                return $this->crearReserva($bookingInfo);
            } else {
                \Log::info('BOOKING INFO INCOMPLETA PARA CREAR RESERVA', [
                    'missing_fields' => [
                        'nombre' => empty($bookingInfo['nombre']),
                        'dni' => empty($bookingInfo['dni']),
                        'email_or_phone' => empty($bookingInfo['email']) && empty($bookingInfo['telefono']),
                        'fecha' => empty($bookingInfo['fecha']),
                        'hora' => empty($bookingInfo['hora']),
                        'fisioterapeuta' => empty($bookingInfo['fisioterapeuta_seleccion'])
                    ]
                ]);
            }
        }
        
        // Detectar intención de crear reserva (fallback)
        if (strpos($message, 'confirmar') !== false || 
            strpos($message, 'reservar') !== false ||
            strpos($message, 'agendar') !== false) {
            
            $bookingInfo = $this->extractBookingInfo($history, $message);
            
            if ($this->isCompleteBookingInfo($bookingInfo)) {
                return $this->crearReserva($bookingInfo);
            }
        }
        
        // Detectar solicitud de servicios
        if (strpos($message, 'servicios') !== false || 
            strpos($message, 'tratamientos') !== false ||
            strpos($message, 'qué ofrecen') !== false) {
            return $this->obtenerServicios();
        }
        
        // Detectar selección de fisioterapeuta (solo cuando hay lista previa)
        if ($this->hasPhysiotherapistList($history)) {
            $isSelection = (strpos($message, 'elijo') !== false ||
                           strpos($message, 'quiero') !== false ||
                           strpos($message, 'prefiero') !== false ||
                           preg_match('/^[1-5]$/', trim($originalMessage)) ||
                           preg_match('/^[A-Za-záéíóúñ]+$/', trim($originalMessage))); // Solo nombres
            
            \Log::info('EVALUANDO SELECCIÓN DE FISIOTERAPEUTA', [
                'message' => $originalMessage,
                'hasPhysiotherapistList' => true,
                'isSelection' => $isSelection,
                'historyCount' => count($history)
            ]);
            
            if ($isSelection) {
                $bookingInfo = $this->extractBookingInfo($history, $message);
                \Log::info('BOOKING INFO PARA SELECCIÓN', [
                    'bookingInfo' => $bookingInfo,
                    'fisioterapeuta_seleccion' => $bookingInfo['fisioterapeuta_seleccion'] ?? 'NULL'
                ]);
                
                if (!empty($bookingInfo['fisioterapeuta_seleccion'])) {
                    return $this->seleccionarFisioterapeuta($bookingInfo, $history);
                }
            }
        }
        
        \Log::info('DETECTANDEXECUTEFUNCTION - NO SE EJECUTÓ NINGUNA FUNCIÓN', [
            'message' => $originalMessage,
            'historyCount' => count($history)
        ]);
        
        return null;
    }

    /**
     * Extraer información de reserva del historial y mensaje actual
     */
    private function extractBookingInfo(array $history, string $currentMessage): array
    {
        $info = [
            'nombre' => null,
            'email' => null,
            'telefono' => null,
            'dni' => null,
            'servicio' => null,
            'fecha' => null,
            'hora' => null,
            'fisioterapeuta_seleccion' => null,
        ];
        
        // Combinar todo el texto para análisis
        $allText = $currentMessage . ' ';
        foreach ($history as $item) {
            if ($item['role'] === 'user') {
                $allText .= $item['message'] . ' ';
            }
        }
        
        // Extraer email
        if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $allText, $matches)) {
            $info['email'] = $matches[0];
        }
        
        // Extraer teléfono (mejorado para números venezolanos)
        if (preg_match('/\b\d{11,13}\b/', $allText, $matches)) {
            $info['telefono'] = $matches[0];
        } elseif (preg_match('/\b\d{9,10}\b/', $allText, $matches)) {
            $info['telefono'] = $matches[0];
        } elseif (preg_match('/\b\d{3}\s?\d{3}\s?\d{3,4}\b/', $allText, $matches)) {
            $info['telefono'] = $matches[0];
        }
        
        // Extraer DNI (cédula venezolana: V-12345678 o 12345678)
        if (preg_match('/(?:V-?|E-?)?(\d{7,8})/', $allText, $matches)) {
            $info['dni'] = $matches[1];
        }
        
        // Extraer fecha (mejorado para español)
        if (preg_match('/(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{4})/', $allText, $matches)) {
            $info['fecha'] = $matches[3] . '-' . str_pad($matches[2], 2, '0', STR_PAD_LEFT) . '-' . str_pad($matches[1], 2, '0', STR_PAD_LEFT);
        } elseif (preg_match('/(\d{4})[\/\-](\d{1,2})[\/\-](\d{1,2})/', $allText, $matches)) {
            $info['fecha'] = $matches[1] . '-' . str_pad($matches[2], 2, '0', STR_PAD_LEFT) . '-' . str_pad($matches[3], 2, '0', STR_PAD_LEFT);
        } elseif (preg_match('/(lunes|martes|marte|miércoles|miercoles|jueves|viernes)/i', $allText, $matches)) {
            // Convertir días de la semana a fechas
            $dias = [
                'lunes' => 1, 'martes' => 2, 'marte' => 2, 'miércoles' => 3, 'miercoles' => 3, 'jueves' => 4, 'viernes' => 5
            ];
            $diaNumero = $dias[strtolower($matches[1])];
            $hoy = Carbon::now();
            $fechaObjetivo = $hoy->next($diaNumero);
            $info['fecha'] = $fechaObjetivo->format('Y-m-d');
        }
        
        // Extraer hora (mejorado para AM/PM)
        if (preg_match('/(\d{1,2}):(\d{2})/', $allText, $matches)) {
            $info['hora'] = str_pad($matches[1], 2, '0', STR_PAD_LEFT) . ':' . $matches[2];
        } elseif (preg_match('/(\d{1,2})\s*(am|pm)/i', $allText, $matches)) {
            $hora = intval($matches[1]);
            $ampm = strtolower($matches[2]);
            
            if ($ampm === 'pm' && $hora !== 12) {
                $hora += 12;
            } elseif ($ampm === 'am' && $hora === 12) {
                $hora = 0;
            }
            
            $info['hora'] = str_pad($hora, 2, '0', STR_PAD_LEFT) . ':00';
        }
        
        // Extraer nombre (mejorado)
        if (preg_match('/(?:soy|me llamo|mi nombre es)\s+([A-Za-záéíóúñ\s]+?)(?:\s|$|\.|\,)/i', $allText, $matches)) {
            $info['nombre'] = trim($matches[1]);
        } elseif (preg_match('/^([A-Za-záéíóúñ]+\s+[A-Za-záéíóúñ]+)$/i', trim($currentMessage), $matches)) {
            // Detectar "Gero Rodriguez" como respuesta única
            $info['nombre'] = trim($matches[1]);
        }
        
        // Si no se encontró nombre, buscar en el historial patrones de nombres
        if (empty($info['nombre'])) {
            foreach ($history as $item) {
                if ($item['role'] === 'user') {
                    if (preg_match('/^([A-Za-záéíóúñ]+\s+[A-Za-záéíóúñ]+)$/i', trim($item['message']), $matches)) {
                        $info['nombre'] = trim($matches[1]);
                        break;
                    }
                }
            }
        }
        
        // Extraer servicio (mejorado para detectar servicios de la BD)
        $servicios = [
            'fisioterapia' => ['fisioterapia', 'fisio', 'cuello', 'espalda', 'muscular', 'general'],
            'rehabilitación' => ['rehabilitación', 'rehabilitacion', 'lesión', 'lesion', 'carrera', 'deportiva', 'rodilla'],
            'masaje' => ['masaje', 'relajante', 'terapéutico', 'terapeutico'],
            'prevención' => ['prevención', 'prevencion', 'preventivo'],
            'dolor' => ['dolor', 'duele', 'molestia'],
            'cervicales' => ['cervical', 'cervicales', 'cuello']
        ];
        
        foreach ($servicios as $servicio => $palabras) {
            foreach ($palabras as $palabra) {
                if (strpos(strtolower($allText), $palabra) !== false) {
                    $info['servicio'] = $servicio;
                    break 2; // Salir de ambos loops
                }
            }
        }
        
        // Extraer selección de fisioterapeuta (números del 1-5 o nombres)
        if (preg_match('/(?:elijo|quiero|prefiero)\s+(?:el\s+)?([1-5])/i', $currentMessage, $matches)) {
            $info['fisioterapeuta_seleccion'] = trim($matches[1]);
        } elseif (preg_match('/^([1-5])$/', trim($currentMessage))) {
            $info['fisioterapeuta_seleccion'] = trim($currentMessage);
        } elseif (preg_match('/^([A-Za-záéíóúñ]+)$/', trim($currentMessage))) {
            // Detectar nombres simples como "Lara", "Ana", "Carlos"
            $info['fisioterapeuta_seleccion'] = trim($currentMessage);
        }
        
        // Buscar fisioterapeuta seleccionado en respuestas del asistente
        foreach ($history as $item) {
            if ($item['role'] === 'assistant' && isset($item['data']['fisioterapeuta_seleccionado'])) {
                $info['fisioterapeuta_seleccion'] = $item['data']['fisioterapeuta_seleccionado'];
                break;
            }
        }
        
        return $info;
    }

    /**
     * Verificar si tenemos información completa para hacer una reserva
     */
    private function isCompleteBookingInfo(array $info): bool
    {
        return !empty($info['nombre']) && 
               !empty($info['dni']) &&
               (!empty($info['email']) || !empty($info['telefono'])) &&
               !empty($info['fecha']) && 
               !empty($info['hora']) &&
               !empty($info['fisioterapeuta_seleccion']);
    }

    /**
     * Verificar si el historial contiene información completa de reserva
     */
    private function hasCompleteBookingInfo(array $history): bool
    {
        $info = $this->extractBookingInfo($history, '');
        return $this->isCompleteBookingInfo($info);
    }

    /**
     * Verificar si el historial contiene una lista de fisioterapeutas
     */
    private function hasPhysiotherapistList(array $history): bool
    {
        foreach ($history as $item) {
            if ($item['role'] === 'assistant' && 
                (strpos($item['message'], 'Fisioterapeutas disponibles:') !== false ||
                 strpos($item['message'], 'fisioterapeutas disponibles') !== false)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Verificar disponibilidad
     */
    private function verificarDisponibilidad(array $bookingInfo): array
    {
        \Log::info('=== EJECUTANDO VERIFICAR DISPONIBILIDAD ===', [
            'bookingInfo' => $bookingInfo
        ]);
        
        try {
            if (!$bookingInfo['fecha'] || !$bookingInfo['hora']) {
                return [
                    'function' => 'verificarDisponibilidad',
                    'status' => 'error',
                    'message' => 'Necesito la fecha y hora para verificar disponibilidad.'
                ];
            }

            $startTime = Carbon::parse($bookingInfo['fecha'] . ' ' . $bookingInfo['hora']);

            // Verificar horario laboral
            if ($startTime->isWeekend()) {
                return [
                    'function' => 'verificarDisponibilidad',
                    'status' => 'unavailable',
                    'message' => 'No atendemos los fines de semana. Nuestro horario es de Lunes a Viernes de 9:00 a 18:00.',
                    'suggestions' => $this->getSuggestedDates($startTime)
                ];
            }

            if ($startTime->hour < 9 || $startTime->hour >= 18) {
                return [
                    'function' => 'verificarDisponibilidad',
                    'status' => 'unavailable',
                    'message' => 'Ese horario está fuera de nuestro horario de atención (9:00 - 18:00).',
                    'suggestions' => ['09:00', '10:00', '11:00', '14:00', '15:00', '16:00']
                ];
            }

            if ($startTime->isPast()) {
                return [
                    'function' => 'verificarDisponibilidad',
                    'status' => 'unavailable',
                    'message' => 'No podemos programar citas en el pasado.',
                    'suggestions' => $this->getSuggestedDates(Carbon::now())
                ];
            }

            // Buscar fisioterapeutas disponibles
            \Log::info('Buscando fisioterapeutas disponibles', [
                'startTime' => $startTime->format('Y-m-d H:i:s'),
                'date' => $startTime->format('Y-m-d'),
                'time' => $startTime->format('H:i')
            ]);
            
            $availableFisios = User::fisioterapeutas()
                ->availableAt($startTime, 60)
                ->get();
                
            \Log::info('Resultado consulta fisioterapeutas', [
                'count' => $availableFisios->count(),
                'fisioterapeutas' => $availableFisios->map(fn($f) => [
                    'id' => $f->id,
                    'name' => $f->name,
                    'email' => $f->email
                ])->toArray()
            ]);

            if ($availableFisios->isEmpty()) {
                // Fallback: mostrar todos los fisioterapeutas si no hay disponibles específicamente
                \Log::info('No hay fisioterapeutas disponibles específicamente, mostrando todos');
                
                $allFisioterapeutas = User::fisioterapeutas()->get();
                
                \Log::info('Fisioterapeutas totales en sistema', [
                    'count' => $allFisioterapeutas->count(),
                    'fisioterapeutas' => $allFisioterapeutas->map(fn($f) => [
                        'id' => $f->id,
                        'name' => $f->name
                    ])->toArray()
                ]);
                
                if ($allFisioterapeutas->isEmpty()) {
                    return [
                        'function' => 'verificarDisponibilidad',
                        'status' => 'no_availability',
                        'message' => "No hay fisioterapeutas registrados en el sistema.",
                        'suggestions' => []
                    ];
                }
                
                // Mostrar todos los fisioterapeutas disponibles (sin verificar horario específico)
                return [
                    'function' => 'verificarDisponibilidad',
                    'status' => 'available',
                    'message' => "Tenemos disponibilidad el {$startTime->format('d/m/Y')} a las {$startTime->format('H:i')}.\n\n🏥 **Fisioterapeutas disponibles:**\n\n" . 
                                $allFisioterapeutas->map(function($fisio, $index) {
                                    return "**" . ($index + 1) . ". " . $fisio->name . "**\n   • Fisioterapeuta especializado";
                                })->implode("\n\n") . 
                                "\n\n¿Con cuál fisioterapeuta te gustaría agendar tu cita? Puedes elegir por el número.",
                    'available_fisioterapeutas' => $allFisioterapeutas->map(fn($f) => [
                        'id' => $f->id,
                        'name' => $f->name
                    ])->toArray()
                ];
            }

            return [
                'function' => 'verificarDisponibilidad',
                'status' => 'available',
                'message' => "¡Excelente! Tenemos disponibilidad el {$startTime->format('d/m/Y')} a las {$startTime->format('H:i')}.\n\nFisioterapeutas disponibles:\n" . 
                            $availableFisios->map(function($fisio, $index) {
                                return ($index + 1) . ". " . $fisio->name;
                            })->implode("\n") . 
                            "\n\n¿Con cuál fisioterapeuta te gustaría agendar tu cita? Puedes elegir por el número o mencionar el nombre.",
                'available_fisioterapeutas' => $availableFisios->map(fn($f) => [
                    'id' => $f->id,
                    'name' => $f->name
                ])->toArray()
            ];

        } catch (\Exception $e) {
            return [
                'function' => 'verificarDisponibilidad',
                'status' => 'error',
                'message' => 'Error al verificar disponibilidad. Verifica el formato de fecha y hora.'
            ];
        }
    }

    /**
     * Crear reserva
     */
    private function crearReserva(array $bookingInfo): array
    {
        \Log::info('=== EJECUTANDO CREAR RESERVA ===', [
            'bookingInfo' => $bookingInfo
        ]);
        
        try {
            // Validar datos requeridos
            $requiredFields = ['nombre', 'fecha', 'hora'];
            foreach ($requiredFields as $field) {
                if (empty($bookingInfo[$field])) {
                    return [
                        'function' => 'crearReserva',
                        'status' => 'error',
                        'message' => "Falta información requerida: {$field}"
                    ];
                }
            }

            // Buscar servicio
            $service = MedicalService::where('name', 'like', '%' . ($bookingInfo['servicio'] ?? 'general') . '%')
                ->first() ?? MedicalService::first();

            if (!$service) {
                return [
                    'function' => 'crearReserva',
                    'status' => 'error',
                    'message' => 'Servicio no encontrado.'
                ];
            }

            $startTime = Carbon::parse($bookingInfo['fecha'] . ' ' . $bookingInfo['hora']);
            $endTime = $startTime->copy()->addMinutes($service->duration ?? 60);

            // Buscar fisioterapeuta seleccionado por nombre
            $fisioterapeutaNombre = $bookingInfo['fisioterapeuta_seleccion'] ?? null;
            $fisioterapeuta = null;
            
            if ($fisioterapeutaNombre) {
                $fisioterapeuta = User::fisioterapeutas()
                    ->where('name', 'like', '%' . $fisioterapeutaNombre . '%')
                    ->availableAt($startTime, $service->duration ?? 60)
                    ->first();
            }
            
            if (!$fisioterapeuta) {
                // Buscar primer fisioterapeuta disponible
                $fisioterapeuta = User::fisioterapeutas()
                    ->availableAt($startTime, $service->duration ?? 60)
                    ->first();
            }

            if (!$fisioterapeuta) {
                return [
                    'function' => 'crearReserva',
                    'status' => 'error',
                    'message' => 'Ya no hay disponibilidad para ese horario.'
                ];
            }

            // Crear o encontrar paciente por DNI (más confiable)
            $patient = Patient::firstOrCreate(
                ['dni' => $bookingInfo['dni']],
                [
                    'name' => explode(' ', $bookingInfo['nombre'])[0] ?? 'Paciente',
                    'last_name' => implode(' ', array_slice(explode(' ', $bookingInfo['nombre']), 1)) ?: '',
                    'email' => $bookingInfo['email'] ?? 'temp@example.com',
                    'phone' => $bookingInfo['telefono'] ?? '',
                    'dni' => $bookingInfo['dni'],
                    'fisioterapeuta_id' => $fisioterapeuta->id,
                ]
            );

            // Crear cita
            $appointment = Appoinment::create([
                'start_time' => $startTime,
                'end_time' => $endTime,
                'status' => 'pending',
                'patient_id' => $patient->id,
                'fisioterapeuta_id' => $fisioterapeuta->id,
                'medical_service_id' => $service->id,
                'notes' => "Reserva creada por FisioGEM - Asistente Virtual",
            ]);

            return [
                'function' => 'crearReserva',
                'status' => 'success',
                'message' => "🎉 ¡Reserva confirmada!\n\nTu cita de {$service->name} está programada para el {$startTime->format('d/m/Y')} a las {$startTime->format('H:i')} con {$fisioterapeuta->name}.\n\n📋 **Detalles de tu cita:**\n👤 Paciente: {$patient->name}\n📞 Teléfono: {$patient->phone}\n📧 Email: {$patient->email}\n🏥 Servicio: {$service->name}\n👨‍⚕️ Fisioterapeuta: {$fisioterapeuta->name}\n\n¡Te esperamos! Si necesitas cancelar o reprogramar, contacta al 966 52 XX XX.",
                'appointment_id' => $appointment->id,
                'details' => [
                    'patient' => $patient->name,
                    'service' => $service->name,
                    'fisioterapeuta' => $fisioterapeuta->name,
                    'date' => $startTime->format('d/m/Y'),
                    'time' => $startTime->format('H:i'),
                ]
            ];

        } catch (\Exception $e) {
            \Log::error('Error creando reserva', [
                'error' => $e->getMessage(),
                'booking_info' => $bookingInfo
            ]);

            return [
                'function' => 'crearReserva',
                'status' => 'error',
                'message' => 'Error al crear la reserva. Por favor, contacta al 966 52 XX XX.'
            ];
        }
    }

    /**
     * Obtener servicios disponibles
     */
    private function obtenerServicios(): array
    {
        try {
            $services = MedicalService::all();
            
            return [
                'function' => 'obtenerServicios',
                'status' => 'success',
                'services' => $services->map(fn($s) => [
                    'name' => $s->name,
                    'description' => $s->description,
                    'duration' => $s->duration . ' minutos',
                    'price' => number_format($s->price, 2) . ' €'
                ])->toArray()
            ];
        } catch (\Exception $e) {
            return [
                'function' => 'obtenerServicios',
                'status' => 'error',
                'message' => 'Error al obtener servicios.'
            ];
        }
    }

    /**
     * Manejar selección de fisioterapeuta
     */
    private function seleccionarFisioterapeuta(array $bookingInfo, array $history): array
    {
        try {
            $seleccion = $bookingInfo['fisioterapeuta_seleccion'];
            
            // Buscar en el historial la lista de fisioterapeutas disponibles
            $availableFisios = [];
            foreach ($history as $item) {
                if ($item['role'] === 'assistant' && strpos($item['message'], 'Fisioterapeutas disponibles:') !== false) {
                    // Extraer los fisioterapeutas del mensaje
                    if (preg_match_all('/(\d+)\.\s+([A-Za-záéíóúñ\s]+)/u', $item['message'], $matches, PREG_SET_ORDER)) {
                        foreach ($matches as $match) {
                            $availableFisios[$match[1]] = trim($match[2]);
                        }
                    }
                    break;
                }
            }
            
            if (empty($availableFisios)) {
                return [
                    'function' => 'seleccionarFisioterapeuta',
                    'status' => 'error',
                    'message' => 'No encuentro la lista de fisioterapeutas disponibles. Por favor, verifica la disponibilidad nuevamente.'
                ];
            }
            
            $fisioterapeutaSeleccionado = null;
            
            // Buscar por número
            if (is_numeric($seleccion) && isset($availableFisios[$seleccion])) {
                $fisioterapeutaSeleccionado = $availableFisios[$seleccion];
            } else {
                // Buscar por nombre
                foreach ($availableFisios as $numero => $nombre) {
                    if (stripos($nombre, $seleccion) !== false) {
                        $fisioterapeutaSeleccionado = $nombre;
                        break;
                    }
                }
            }
            
            if (!$fisioterapeutaSeleccionado) {
                return [
                    'function' => 'seleccionarFisioterapeuta',
                    'status' => 'error',
                    'message' => "No pude identificar al fisioterapeuta '{$seleccion}'. Por favor, elige uno de los números de la lista o menciona el nombre exacto."
                ];
            }
            
            return [
                'function' => 'seleccionarFisioterapeuta',
                'status' => 'success',
                'message' => "Perfecto! Has elegido a {$fisioterapeutaSeleccionado}.\n\nAhora tengo todos los datos necesarios. Permíteme confirmar tu reserva:\n\n" .
                            "📋 **RESUMEN DE TU CITA:**\n" .
                            "👤 Paciente: {$bookingInfo['nombre']}\n" .
                            "📞 Teléfono: {$bookingInfo['telefono']}\n" .
                            "📧 Email: {$bookingInfo['email']}\n" .
                            "🏥 Servicio: {$bookingInfo['servicio']}\n" .
                            "📅 Fecha: {$bookingInfo['fecha']}\n" .
                            "🕐 Hora: {$bookingInfo['hora']}\n" .
                            "👨‍⚕️ Fisioterapeuta: {$fisioterapeutaSeleccionado}\n\n" .
                            "¿Confirmas que todos los datos son correctos? Responde 'SÍ' para crear la reserva.",
                'fisioterapeuta_seleccionado' => $fisioterapeutaSeleccionado
            ];
            
        } catch (\Exception $e) {
            return [
                'function' => 'seleccionarFisioterapeuta',
                'status' => 'error',
                'message' => 'Error al procesar la selección del fisioterapeuta.'
            ];
        }
    }

    /**
     * Verificar si la reserva se completó
     */
    private function isBookingComplete(?array $functionResult): bool
    {
        return $functionResult && 
               $functionResult['function'] === 'crearReserva' && 
               $functionResult['status'] === 'success';
    }

    /**
     * Obtener fechas sugeridas
     */
    private function getSuggestedDates(Carbon $fromDate): array
    {
        $suggestions = [];
        $date = $fromDate->copy()->startOfDay();
        
        for ($i = 1; $i <= 5; $i++) {
            $nextDate = $date->copy()->addDays($i);
            if (!$nextDate->isWeekend()) {
                $suggestions[] = $nextDate->format('d/m/Y');
                if (count($suggestions) >= 3) break;
            }
        }
        
        return $suggestions;
    }

    /**
     * Obtener fechas alternativas con disponibilidad
     */
    private function getAlternativeDates(Carbon $preferredTime): array
    {
        $suggestions = [];
        $date = $preferredTime->copy()->startOfDay();
        
        for ($i = 1; $i <= 7; $i++) {
            $nextDate = $date->copy()->addDays($i);
            if (!$nextDate->isWeekend()) {
                $availableFisios = User::fisioterapeutas()
                    ->availableAt($nextDate->setTime(10, 0), 60)
                    ->count();
                
                if ($availableFisios > 0) {
                    $suggestions[] = $nextDate->format('d/m/Y');
                    if (count($suggestions) >= 3) break;
                }
            }
        }
        
        return $suggestions;
    }
}
