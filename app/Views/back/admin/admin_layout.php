
<?= $this->include('front/head_view') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="<?= base_url('admin') ?>">Tulio Riera</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input id="adminBuscarInput" class="form-control form-control-dark w-100" type="text" placeholder="Buscar..." aria-label="Buscar">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="<?= base_url('/logout') ?>">Cerrar sesión</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>" href="<?= base_url('admin/dashboard') ?>">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= uri_string() == 'admin/usuarios' ? 'active' : '' ?>" href="<?= base_url('admin/usuarios') ?>">
              <span data-feather="users"></span>
              Usuarios
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= uri_string() == 'admin/productos' ? 'active' : '' ?>" href="<?= base_url('admin/productos') ?>">
              <span data-feather="shopping-cart"></span>
              Productos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= uri_string() == 'admin/ofertas' ? 'active' : '' ?>" href="<?= base_url('admin/ofertas') ?>">
              <span data-feather="tag"></span>
              Ofertas
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Reportes guardados</span>
          <a class="link-secondary" href="#" aria-label="Agregar reporte">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Últimos movimientos
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Contenido principal -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
      <?= $this->renderSection('contenido') ?>
    </main>
  </div>
</div>

<script>
  feather.replace();
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('adminBuscarInput');

  input.addEventListener('input', () => {
    const filtro = input.value.toLowerCase();

    // Para cada tabla filtrable que exista
    document.querySelectorAll('.tabla-filtrable tbody').forEach(tbody => {
      tbody.querySelectorAll('tr').forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
      });
    });
  });
});
</script>
