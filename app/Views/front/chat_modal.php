<!-- Modal Chatbot Estilo Vital -->
<div class="modal fade" id="chatbotModal" tabindex="-1" aria-labelledby="chatbotModalLabel" aria-hidden="true">
  <div class="modal-dialog position-fixed bottom-0 end-0 m-3" style="width: 330px; max-width: 100vw;">
    <div class="modal-content shadow">
      <div class="modal-header bg-dark text-white py-2">
        <h6 class="modal-title" id="chatbotModalLabel">
          <i class="bi bi-robot me-1"></i> Asistente Tulio
        </h6>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body p-3" id="chat-contenido" style="height: 300px; overflow-y: auto;">
        <div class="text-muted text-center small">¡Hola! 🤖 Preguntame algo</div>
      </div>
      <div class="modal-footer p-2">
        <form id="chat-form" class="w-100 d-flex gap-2">
          <input type="text" id="chat-input" class="form-control form-control-sm rounded-pill" placeholder="Escribí tu mensaje..." required>
          <button class="btn btn-primary btn-sm rounded-pill px-3" type="submit">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>
