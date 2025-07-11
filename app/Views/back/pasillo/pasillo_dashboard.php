<?= $this->extend('back/pasillo/pasillo_layout') ?>
<?= $this->section('contenido') ?>

<h2 class="mb-4">Registro de vencimientos - Pasillo <?= esc($pasillo) ?></h2>

<?php if (session('mensaje')): ?>
  <div class="alert alert-success"><?= session('mensaje') ?></div>
<?php endif; ?>

<form method="post" action="<?= base_url('pasillo/guardar-vencimiento') ?>">
    <select name="producto" class="form-select" required>
        <option value="">Seleccionar producto</option>
        <?php foreach ($productos as $producto): ?>
            <option value="<?= $producto['id'] ?>"><?= esc($producto['nombre']) ?></option>
        <?php endforeach; ?>
    </select>

    <input type="date" name="fecha_vencimiento" class="form-control mt-3" required>

    <button type="submit" class="btn btn-primary mt-3">Registrar</button>
</form>


<?= $this->endSection() ?>
