<?= view('front/head_view') ?>

<div class="d-flex">
  <!-- Sidebar -->
  <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
    <h4 class="text-center mb-4">Tulio Riera</h4>
    
    <ul class="nav flex-column">
      <li class="nav-item mb-2">
        <a href="<?= base_url('pasillo/dashboard') ?>" class="nav-link text-white">
          🧾 Reporte de Vencimientos
        </a>
      </li>
    </ul>

    <div class="mt-5 text-center">
      <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
    </div>
  </div>

  <!-- Contenido -->
  <div class="flex-grow-1 p-4">
    <?= $this->renderSection('contenido') ?>
  </div>
</div>

<?= view('front/footer_view') ?>
