<footer class="pt-4 bg-light border-top">
  <div class="container">
    <div class="row text-center text-md-start align-items-center">
      <!-- Logo -->
      <div class="col-md-4 mb-3 mb-md-0">
        <img src="<?= base_url('public/assets/img/logomenu2.png') ?>" alt="Logo Tulio Riera" width="150">
      </div>

      <!-- Medios de pago -->
      <div class="col-md-4 mb-3 mb-md-0">
        <h6 class="fw-bold text-primary">Medios de pago</h6>
        <img src="<?= base_url('public/assets/img/mediomediosdepago.png') ?>" alt="Medios de pago" style="max-width: 100%; height: 30px;">
      </div>

      <!-- Redes -->
      <div class="col-md-4">
        <h6 class="fw-bold text-primary">Seguinos en</h6>
        <a href="#" class="text-dark me-2"><i class="bi bi-facebook fs-4"></i></a>
        <a href="#" class="text-dark me-2"><i class="bi bi-instagram fs-4"></i></a>
        <a href="#" class="text-dark"><i class="bi bi-youtube fs-4"></i></a>
      </div>
    </div>

    <hr class="my-3">

    <!-- Pie de página inferior -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small">
      <div class="text-muted">
        © 2025 Tulio Riera Supermercado <span class="text-primary fw-semibold">Mayorista - Todos</span> los derechos reservados.
      </div>
      <div class="mt-2 mt-md-0">
        <a href="#" class="text-muted me-3">Términos y condiciones</a>
        <a href="#" class="text-muted">Política de privacidad</a>
      </div>
    </div>
  </div>
  <!-- Botón flotante -->
  <a href="#" class="btn-chatbot" data-bs-toggle="modal" data-bs-target="#chatbotModal">
    <i class="bi bi-robot"></i>
  </a>


</footer>


<!-- Swiper JS único -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Swiper para promoSwiper (tarjetas institucionales)
    new Swiper('.promoSwiper', {
      slidesPerView: 'auto',
      spaceBetween: 16,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });

    // Swiper para categoriaSwiper (si lo volvés a usar)
    new Swiper('.categoriaSwiper', {
      slidesPerView: 2,
      spaceBetween: 10,
      breakpoints: {
        576: { slidesPerView: 3 },
        768: { slidesPerView: 4 },
        992: { slidesPerView: 6 }
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      }
    });
  });
</script>

<script src="<?= base_url('assets/js/chatbot.js') ?>"></script>
