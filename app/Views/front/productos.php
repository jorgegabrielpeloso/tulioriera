<?= $this->extend('front/layout_view') ?>
<?= $this->section('contenido') ?>

<div class="container my-5">
  <h2 class="text-center text-primary mb-4">Todos los Productos</h2>

  <!-- FILTROS -->
  <form method="get" class="row g-3 mb-4 justify-content-center">
    <div class="col-md-4">
      <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre..." value="<?= esc($busqueda ?? '') ?>">
    </div>
    <div class="col-md-4">
      <select name="categoria" class="form-select">
        <option value="">Filtrar por categoría</option>
        <?php foreach ($categorias as $cat): ?>
          <option value="<?= esc($cat) ?>" <?= ($categoriaSeleccionada ?? '') === $cat ? 'selected' : '' ?>>
            <?= esc($cat) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary w-100">Filtrar</button>
    </div>
  </form>

  <!-- PRODUCTOS -->
  <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-4">
    <?php if (!empty($productos)): ?>
      <?php foreach ($productos as $producto): ?>
        <div class="col">
          <div class="card shadow-sm h-100 text-center p-2">
            <?php if ($producto['imagen']): ?>
              <img src="<?= base_url('public/assets/img/productos/' . $producto['imagen']) ?>" class="card-img-top" alt="<?= esc($producto['nombre']) ?>" style="height: 180px; object-fit: contain;">
            <?php else: ?>
              <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">Sin imagen</div>
            <?php endif; ?>
            <div class="card-body p-2">
              <span class="badge bg-warning text-dark mb-2"><?= strtoupper($producto['categoria']) ?></span>
              <h6 class="card-title mb-1"><?= esc($producto['nombre']) ?></h6>
              <p class="precio fw-bold m-0">$<?= number_format($producto['precio'], 2, ',', '.') ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center">
        <p>No se encontraron productos con los filtros aplicados.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<?= $this->endSection() ?>

