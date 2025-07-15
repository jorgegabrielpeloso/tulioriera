<?= $this->extend('back/jefe/jefe_layout') ?>
<?= $this->section('contenido') ?>

<h4 class="mb-4">Dashboard del Jefe de Depósito</h4>

<!-- Flash messages -->
<?php if (session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-success">
        <i class="bi bi-check-circle-fill"></i> <?= session()->getFlashdata('mensaje') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <i class="bi bi-x-circle-fill"></i> <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<!-- Tarjetas estilo SB Admin 2 -->
<div class="row">

    <!-- Generar Excel -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Generar Excel</div>
                    <a href="<?= base_url('jefe/generar-reporte') ?>" class="btn btn-sm btn-outline-primary mt-2">
                        <i class="bi bi-file-earmark-excel-fill"></i> Descargar
                    </a>
                </div>
                <i class="fas fa-file-excel fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>

    <!-- Ver reportes generados -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Reportes generados</div>
                    <a href="<?= base_url('jefe/reportes-generados') ?>" class="btn btn-sm btn-outline-secondary mt-2">
                        <i class="bi bi-folder2-open"></i> Ver
                    </a>
                </div>
                <i class="fas fa-folder-open fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>

    <!-- Productos cargados -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Productos cargados</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $productos_cargados ?></div>
                </div>
                <i class="fas fa-boxes fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>

    <!-- Vencimientos registrados -->
    <div class="col-xl-3 col-md-6 mb-4">
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

<!-- 🔔 Sección de alertas si hay notificaciones -->
<!-- 🔔 Sección de alertas si hay notificaciones -->
<?php if (!empty($notificaciones)): ?>
  <div class="card border-left-danger shadow mb-4 alertas-recientes">
    <div class="card-body position-relative">
      <!-- Botón de cierre (X) -->
      <button class="btn-cerrar-alerta" title="Cerrar alerta">&times;</button>

      <h6 class="font-weight-bold text-danger"><i class="fas fa-exclamation-triangle"></i> Alertas recientes</h6>
      <ul class="mb-0">
        <?php foreach ($notificaciones as $n): ?>
          <li><?= esc($n['mensaje']) ?> <span class="text-muted small">(<?= date('d/m/Y', strtotime($n['created_at'])) ?>)</span></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
<?php endif; ?>


<?= $this->endSection() ?>
