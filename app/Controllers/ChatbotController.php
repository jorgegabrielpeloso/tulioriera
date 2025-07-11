<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ChatbotController extends Controller
{
    public function responder()
    {
        $request = service('request');
        $pregunta = strtolower($request->getPost('mensaje'));

        $respuesta = match (true) {
            str_contains($pregunta, 'pago') => 'Aceptamos efectivo, transferencia y todas las tarjetas.',
            str_contains($pregunta, 'envío') || str_contains($pregunta, 'envios') => 'Hacemos envíos dentro de Corrientes Capital. Pronto al interior.',
            str_contains($pregunta, 'ubicación') || str_contains($pregunta, 'dónde están') => 'Estamos en Av. Cazadores Correntinos 1234, Corrientes Capital.',
            str_contains($pregunta, 'horario') => 'Abrimos de lunes a sábados de 8 a 20 hs.',
            str_contains($pregunta, 'hola') => '¡Hola! ¿En qué puedo ayudarte?',
            default => 'Lo siento, no entiendo tu pregunta. ¿Podés reformularla?'
        };

        return $this->response->setJSON(['respuesta' => $respuesta]);
    }
}
