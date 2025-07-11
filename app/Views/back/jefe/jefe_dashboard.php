<?= $this->extend('back/jefe/jefe_layout') ?>
<?= $this->section('contenido') ?>

<h2 class="mb-4">Cargar producto al pasillo</h2>

<?php if (session('mensaje')): ?>
  <div class="alert alert-success"><?= session('mensaje') ?></div>
<?php endif; ?>

<form action="<?= base_url('jefe/guardarProducto') ?>" method="post" class="row g-3 mb-4">
  <div class="col-md-5">
    <input type="text" name="nombre" class="form-control" placeholder="Nombre del producto" required>
  </div>
  <div class="col-md-5">
    <input type="text" name="descripcion" class="form-control" placeholder="Descripción">
  </div>
  <div class="col-md-2">
    <input type="number" name="pasillo" class="form-control" placeholder="Pasillo" required>
  </div>
  <div class="col-md-12 text-end">
    <button type="submit" class="btn btn-primary">Guardar producto</button>
  </div>
</form>

<?= $this->endSection() ?>
