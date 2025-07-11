document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('chat-form');
  const input = document.getElementById('chat-input');
  const chat = document.getElementById('chat-contenido');
  const chatbotModal = document.getElementById('chatbotModal');

  const sonidoEnviar = new Audio('https://www.myinstants.com/media/sounds/pop-up-kernel.mp3');
  const sonidoRespuesta = new Audio('https://www.myinstants.com/media/sounds/notification-sound.mp3');

  // Mostrar saludo inicial con avatar Tulio
  chatbotModal.addEventListener('shown.bs.modal', () => {
    if (!chat.dataset.saludo) {
      chat.innerHTML += `
        <div class="d-flex align-items-start mb-2">
          <div class="me-2 rounded-circle bg-dark text-white d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 0.85rem;">
            T
          </div>
          <div class="bg-light text-dark rounded px-2 py-1" style="max-width: 80%;">
            👋 ¡Hola! Soy <strong>Tulio</strong>, tu asistente virtual. ¿En qué puedo ayudarte?<br>
            <div class="mt-2 d-flex flex-wrap gap-1">
              <button class="btn btn-sm btn-outline-primary btn-pregunta">Formas de pago</button>
              <button class="btn btn-sm btn-outline-primary btn-pregunta">¿Hacen envíos?</button>
              <button class="btn btn-sm btn-outline-primary btn-pregunta">¿Dónde están ubicados?</button>
              <button class="btn btn-sm btn-outline-primary btn-pregunta">Horarios de atención</button>
            </div>
          </div>
        </div>
      `;
      chat.dataset.saludo = "ok";
      chat.scrollTop = chat.scrollHeight;
    }
  });

  // Manejar el envío de mensajes del usuario
  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const mensaje = input.value.trim();
    if (mensaje === '') return;

    // Mostrar mensaje del usuario (burbuja)
    chat.innerHTML += `
      <div class="d-flex justify-content-end mb-2">
        <div class="bg-primary text-white rounded px-2 py-1" style="max-width: 80%;">
          ${mensaje}
        </div>
      </div>
    `;
    chat.scrollTop = chat.scrollHeight;
    sonidoEnviar.play();
    input.value = '';

    // Enviar al backend
    try {
      const res = await fetch('/chatbot/responder', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ mensaje })
      });

      const data = await res.json();

      // Mostrar respuesta del bot
      chat.innerHTML += `
        <div class="d-flex align-items-start mb-2">
          <div class="me-2 rounded-circle bg-dark text-white d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 0.85rem;">
            T
          </div>
          <div class="bg-light text-dark rounded px-2 py-1" style="max-width: 80%;">
            ${data.respuesta}
          </div>
        </div>
      `;
      chat.scrollTop = chat.scrollHeight;
      sonidoRespuesta.play();

    } catch (error) {
      chat.innerHTML += `<div class="text-start text-danger">Error al responder. Intentalo de nuevo.</div>`;
    }
  });

  // Manejar clics en botones de preguntas rápidas
  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-pregunta')) {
      input.value = e.target.innerText;
      form.dispatchEvent(new Event('submit'));
    }
  });
});
