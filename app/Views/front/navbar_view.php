<!-- CONTENEDOR PRINCIPAL DEL HEADER -->
<div class="container">
  <header class="d-flex flex-wrap align-items-center justify-content-between py-3 mb-2 border-bottom">

    <!-- Logo a la izquierda -->
    <a href="<?= base_url('/') ?>" class="d-flex align-items-center mb-2 mb-md-0 text-dark text-decoration-none">
      <img src="<?= base_url('public/assets/img/logo_tulioriera.png') ?>" alt="Tulio Riera" style="height: 40px;">
    </a>

    <!-- Botón hamburguesa solo en mobile -->
    <button class="btn btn-outline-secondary d-md-none ms-auto" data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
      <i class="bi bi-list fs-4"></i>
    </button>

    <!-- Menú central visible solo en desktop -->
    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 d-none d-md-flex">
      <li><a href="<?= base_url('/') ?>" class="nav-link px-2 link-secondary">Inicio</a></li>
      <li><a href="<?= base_url('/productos') ?>" class="nav-link px-2 link-dark">Productos</a></li>
      <li><a href="<?= base_url('/ofertas') ?>" class="nav-link px-2 link-dark">Ofertas</a></li>
      <li><a href="#" class="nav-link px-2 link-dark">Sucursales</a></li>
      <li><a href="#" class="nav-link px-2 link-dark">Contacto</a></li>
    </ul>

    <!-- Botón Whatsapp visible solo en desktop -->
    <div class="d-none d-md-block">
      <a href="https://wa.me/549XXXXXXXXXX" class="btn btn-whatsapp" target="_blank">
        <i class="bi bi-whatsapp"></i> Sumate al canal de WhatsApp
      </a>
    </div>

  </header>
</div>

<!-- BOTÓN WHATSAPP PARA MOBILE DEBAJO DEL HEADER -->
<div class="container d-md-none mb-3">
  <div class="text-center">
    <a href="https://wa.me/549XXXXXXXXXX" class="btn btn-whatsapp w-auto" target="_blank">
      <i class="bi bi-whatsapp"></i> Sumate al canal de WhatsApp
    </a>
  </div>
</div>

<!-- MENU LATERAL RESPONSIVE (OFFCANVAS) SOLO PARA MOBILE -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="menuLateral" aria-labelledby="menuLateralLabel">
  <div class="offcanvas-header">
    <img src="<?= base_url('public/assets/img/logo_tulioriera.png') ?>" alt="Tulio Riera" style="height: 40px;">
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="list-unstyled">
      <li><a class="text-decoration-none d-block py-2" href="<?= base_url('/') ?>">Inicio</a></li>
      <li><a class="text-decoration-none d-block py-2" href="<?= base_url('/productos') ?>">Productos</a></li>
      <li><a class="text-decoration-none d-block py-2" href="<?= base_url('/ofertas') ?>">Ofertas</a></li>
      <li><a class="text-decoration-none d-block py-2" href="#">Sucursales</a></li>
      <li><a class="text-decoration-none d-block py-2" href="#">Contacto</a></li>
    </ul>
  </div>
</div>
