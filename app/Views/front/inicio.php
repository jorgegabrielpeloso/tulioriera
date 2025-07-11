
<?= $this->extend('front/layout_view') ?>
<?= $this->section('contenido') ?>

<!-- SLIDER INICIO -->
<div class="w-100 overflow-hidden">
  <div class="carousel-wrapper mb-4">
    <div id="carouselTulio" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?= base_url('public/assets/img/slider1.jpg') ?>" class="d-block w-100" alt="Promo 1">
        </div>
        <div class="carousel-item">
          <img src="<?= base_url('public/assets/img/slider2.jpg') ?>" class="d-block w-100" alt="Promo 2">
        </div>
        <div class="carousel-item">
          <img src="<?= base_url('public/assets/img/slider3.jpg') ?>" class="d-block w-100" alt="Promo 3">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselTulio" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselTulio" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>
  </div>
</div>
<!-- TARJETAS INSTITUCIONALES -->
<section class="py-5">
  <div class="container">
    <div class="row g-3 justify-content-center">
      <div class="col-6 col-md-3">
        <a href="<?= base_url('/ofertas') ?>" class="text-decoration-none">
        <div class="card-vital card-vital-a">
          <div class="card-content">
            <div class="icono"><i class="bi bi-tag"></i></div>
            <p>Mirá nuestras<br><strong>Ofertas semanales</strong></p>
          </div>
        </div>
        </a>
      </div>
      <div class="col-6 col-md-3">
        <div class="card-vital card-vital-b">
          <div class="card-content">
            <div class="icono"><i class="bi bi-stars"></i></div>
            <p><strong>Promociones</strong></p>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">     
        <div class="card-vital card-vital-c">
          <div class="card-content">
            <div class="icono"><i class="bi bi-geo-alt-fill"></i></div>
            <p>Conocé Nuestra<br><strong>Sucursal</strong></p>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <a href="<?= base_url('/productos') ?>" class="text-decoration-none">
        <div class="card-vital card-vital-d">
          <div class="card-content">
            <div class="icono"><i class="bi bi-bag-check-fill"></i></div>
            <p>Conocé Nuestro<br><strong>Catalogo completo</strong></p>
          </div>
        </div>
      </div>
      </a>
    </div>
  </div>
</section>

<!-- DESTACADOS -->
<section class="container my-5">
  <h2 class="text-center text-danger mb-4">¡Mirá las ofertas de esta semana!</h2>
  <div class="row row-cols-2 row-cols-md-4 g-4">
    <?php if (!empty($destacados)): ?>
      <?php foreach ($destacados as $producto): ?>
        <div class="col">
          <div class="producto-card shadow-sm">
            <div class="producto-img">
              <?php if ($producto['imagen']): ?>
                <img src="<?= base_url('public/assets/img/productos/' . $producto['imagen']) ?>" alt="<?= esc($producto['nombre']) ?>">
              <?php else: ?>
                <div class="no-img">Sin imagen</div>
              <?php endif; ?>
            </div>
            <div class="producto-info">
              <span class="badge bg-danger mb-1">OFERTA</span>
              <h6><?= esc($producto['nombre']) ?></h6>
              <p class="precio">$<?= number_format($producto['precio'], 2, ',', '.') ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center">No hay productos destacados</div>
    <?php endif; ?>
  </div>
</section>



<!-- FORMULARIO DE SUSCRIPCIÓN -->
<section class="py-5 bg-light border-top">
  <div class="container text-center">
    <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
      <i class="bi bi-megaphone-fill fs-2 text-primary"></i>
      <h4 class="fw-bold text-primary m-0">¿Querés recibir las ofertas antes que nadie?</h4>
    </div>
    <form class="row g-3 justify-content-center">
      <div class="col-6 col-md-3">
        <input type="text" class="form-control" placeholder="Nombre*" required>
      </div>
      <div class="col-6 col-md-3">
        <input type="text" class="form-control" placeholder="Apellido*" required>
      </div>
      <div class="col-6 col-md-3">
        <select class="form-select" required>
          <option value="">Rubro*</option>
          <option>Almacén</option>
          <option>Autoservicio</option>
          <option>Consumidor Final</option>
          <option>Mayorista / Distribuidor</option>
          <option>Escuela</option>
          <option>ONG</option>
        </select>
      </div>
      <div class="col-6 col-md-3">
        <input type="email" class="form-control" placeholder="Correo electrónico*" required>
      </div>
      <div class="col-12 d-flex justify-content-center align-items-center gap-2">
        <input type="checkbox" class="form-check-input">
        <label class="form-check-label small">Acepto recibir notificaciones</label>
      </div>
      <div class="col-12 text-center">
        <button type="submit" class="btn btn-danger px-4">Suscribirme</button>
      </div>
    </form>
  </div>
</section>

<?= $this->endSection() ?>
