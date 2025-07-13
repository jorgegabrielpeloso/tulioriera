<?= $this->extend('back/jefe/jefe_layout') ?>
<?= $this->section('contenido') ?>

<!-- Encabezado -->
<h1 class="h3 mb-4 text-gray-800">Registrar Producto con Vencimiento</h1>

<!-- Formulario -->
<?php if (session()->getFlashdata('mensaje')): ?>
  <div class="alert alert-success">
    <?= session()->getFlashdata('mensaje') ?>
  </div>
<?php endif; ?>

<form action="<?= base_url('jefe/guardar-producto') ?>" method="post">
  <div class="row mb-3">
    <div class="col-md-4">
      <label for="codigo_riera" class="form-label">Código Riera</label>
      <input type="text" name="codigo_riera" id="codigo_riera" class="form-control">
    </div>
    <div class="col-md-4">
      <label for="nombre" class="form-label">Nombre del Producto</label>
      <input type="text" name="nombre" id="nombre" class="form-control">
    </div>
    <div class="col-md-4">
      <label for="proveedor" class="form-label">Proveedor</label>
      <input type="text" name="proveedor" id="proveedor" class="form-control">
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-4">
      <label for="lote" class="form-label">Lote</label>
      <input type="text" name="lote" id="lote" class="form-control">
    </div>
    <div class="col-md-4">
      <label for="pasillo" class="form-label">Pasillo</label>
      <input type="number" name="pasillo" id="pasillo" class="form-control">
    </div>
    <div class="col-md-4">
      <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
      <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control">
    </div>
  </div>

  <div class="text-end mt-4">
    <button type="submit" class="btn btn-primary">Guardar Producto</button>
  </div>
</form>


<?= $this->endSection() ?>
