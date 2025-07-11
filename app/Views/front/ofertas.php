<?= $this->extend('front/layout_view') ?>
<?= $this->section('contenido') ?>

<div class="container my-5">
  <h2 class="text-center text-danger mb-4">Productos en Oferta</h2>

  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    <?php foreach ($ofertas as $p) : ?>
      <div class="col">
        <div class="card-producto">
          <div class="producto-img">
            <?php if ($p['imagen']) : ?>
              <img src="<?= base_url('public/assets/img/productos/' . $p['imagen']) ?>" alt="<?= esc($p['nombre']) ?>">
            <?php else : ?>
              <div class="no-img">Sin imagen</div>
            <?php endif; ?>
          </div>

          <div class="producto-info mt-2">
            <span class="badge bg-warning text-dark text-uppercase mb-1"><?= strtoupper($p['categoria']) ?></span>
            <h6><?= esc($p['nombre']) ?></h6>
            <p class="precio">$<?= number_format($p['precio'], 2, ',', '.') ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?= $this->endSection() ?>
