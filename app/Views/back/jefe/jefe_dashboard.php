<?= $this->extend('back/jefe/jefe_layout') ?>
<?= $this->section('contenido') ?>

<h4 class="mb-4">Dashboard del Jefe de Depósito</h4>

<div class="row mb-4">
  <div class="col-md-6">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Productos cargados</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $productos_cargados ?></div>
        </div>
        <i class="fas fa-boxes fa-2x text-gray-300"></i>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Vencimientos registrados</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $vencimientos_registrados ?></div>
        </div>
        <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
