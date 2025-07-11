<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tulio Riera - Jefe de Depósito</title>

  <!-- CSS SB Admin 2 -->
  <link href="<?= base_url('public/assets/sbadmin2/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= base_url('public/assets/sbadmin2/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('jefe/dashboard') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">TULIO RIERA</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Items -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('jefe/dashboard') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('usuarios') ?>">
          <i class="fas fa-fw fa-users"></i>
          <span>Usuarios</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('jefe/vencimientos') ?>">
          <i class="fas fa-fw fa-file-alt"></i>
          <span>Reporte de Vencimientos</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Botón cerrar sesión -->
      <div class="text-center d-none d-md-inline mb-4">
        <a href="<?= base_url('logout') ?>" class="btn btn-success text-white">Cerrar sesión</a>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..." aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Notificaciones -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Centro de Alertas</h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">Julio 11, 2025</div>
                    ¡Se ha generado un nuevo reporte!
                  </div>
                </a>
              </div>
            </li>

            <!-- Mensajes -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">Centro de Mensajes</h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://via.placeholder.com/60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hola jefe, revise el nuevo lote cargado.</div>
                    <div class="small text-gray-500">Pasillero · Hace 2 horas</div>
                  </div>
                </a>
              </div>
            </li>

            <!-- Usuario -->
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Jefe Depósito</span>
                <i class="fas fa-user-circle fa-lg"></i>
              </a>
            </li>

          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Contenido principal -->
        <div class="container-fluid">
          <?= $this->renderSection('contenido') ?>
        </div>

      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="<?= base_url('public/assets/sbadmin2/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('public/assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('public/assets/sbadmin2/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
  <script src="<?= base_url('public/assets/sbadmin2/js/sb-admin-2.min.js') ?>"></script>

</body>
</html>
