
<?= $this->extend('front/layout_view') ?>
<?= $this->section('contenido') ?>

<div class="container my-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('/productos') ?>">Productos</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= esc(ucwords($categoria)) ?></li>
    </ol>
  </nav>
</div>

<section class="container mb-5">
  <h2 class="text-center text-danger mb-4">Categoría: <?= esc(ucwords($categoria)) ?></h2>

  <div class="row row-cols-2 row-cols-md-4 g-4">
    <?php if (!empty($productos)): ?>
      <?php foreach ($productos as $producto): ?>
        <div class="col">
          <div class="card h-100 text-center shadow-sm">
            <?php if ($producto['imagen']): ?>
              <img src="<?= base_url('public/assets/img/productos/' . $producto['imagen']) ?>" class="card-img-top" alt="<?= esc($producto['nombre']) ?>">
            <?php else: ?>
              <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 180px;">Sin imagen</div>
            <?php endif; ?>
            <div class="card-body">
              <span class="badge bg-warning text-dark mb-2"><?= strtoupper($producto['categoria']) ?></span>
              <h6 class="card-title"><?= esc($producto['nombre']) ?></h6>
              <p class="fw-bold">$<?= number_format($producto['precio'], 2, ',', '.') ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center">No hay productos en esta categoría</div>
    <?php endif; ?>
  </div>
</section>

<?= $this->endSection() ?>
