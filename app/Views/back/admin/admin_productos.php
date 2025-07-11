<?= $this->extend('back/admin/admin_layout') ?>
<?= $this->section('contenido') ?>

<h2 class="mb-4">Gestión de Productos</h2>

<!-- Botón para abrir modal -->
<div class="text-end mb-3">
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto">
    Crear Producto
  </button>
</div>

<!-- Modal de formulario (CREAR) -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="modalProductoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?= base_url('admin/productos/guardar') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="modalProductoLabel">Nuevo Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col">
              <label for="nombre" class="form-label">Nombre del producto</label>
              <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="col">
              <label for="precio" class="form-label">Precio</label>
              <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="categoria" class="form-label">Categoría</label>
              <select name="categoria" id="categoria" class="form-select" required>
                <option value="">Seleccionar</option>
                <option value="Limpieza">Limpieza</option>
                <option value="Congelados">Congelados</option>
                <option value="Bebidas c/alcohol">Bebidas c/alcohol</option>
                <option value="Bebidas s/alcohol">Bebidas s/alcohol</option>
                <option value="Comestibles">Comestibles</option>
                <option value="Golosinas">Golosinas</option>
                <option value="Vinos y Espumantes">Vinos y Espumantes</option>
                <option value="Cerveza">Cerveza</option>
              </select>
            </div>
            <div class="col">
              <label for="imagen" class="form-label">Imagen</label>
              <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar producto</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Tabla de productos -->
<div class="card mt-4">
  <div class="card-header fw-bold">Productos cargados</div>
  <div class="table-responsive">
    <table class="table table-bordered table-hover m-0 text-center tabla-filtrable">
      <thead class="table-dark">
        <tr>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Precio</th>
          <th>Categoría</th>
          <th>Oferta</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($productos)) : ?>
          <?php foreach ($productos as $producto) : ?>
            <tr>
              <td>
                <?php if ($producto['imagen']) : ?>
                  <img src="<?= base_url('public/assets/img/productos/'  . $producto['imagen']) ?>" alt="<?= esc($producto['nombre']) ?>" width="50">
                <?php else : ?>
                  Sin imagen
                <?php endif; ?>
              </td>
              <td><?= esc($producto['nombre']) ?></td>
              <td>$<?= number_format($producto['precio'], 2, ',', '.') ?></td>
              <td><?= esc($producto['categoria']) ?></td>
              <td>
                <?php if ($producto['oferta'] === 'SI') : ?>
                  <span class="badge bg-success">Sí</span>
                <?php else : ?>
                  <span class="badge bg-secondary">No</span>
                <?php endif; ?>
              </td>
              <td>
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editarModal<?= $producto['id'] ?>" title="Editar">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <?php if ($producto['baja'] === 'NO') : ?>
                  <a href="<?= base_url('admin/productos/eliminar/' . $producto['id']) ?>" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Eliminar este producto?')">
                    <i class="bi bi-trash"></i>
                  </a>
                <?php else : ?>
                  <a href="<?= base_url('admin/productos/alta/' . $producto['id']) ?>" class="btn btn-sm btn-success" title="Reactivar">
                    <i class="bi bi-arrow-clockwise"></i>
                  </a>
                <?php endif; ?>
              </td>
            </tr>

            <!-- Modal edición -->
            <div class="modal fade" id="editarModal<?= $producto['id'] ?>" tabindex="-1" aria-labelledby="editarModalLabel<?= $producto['id'] ?>" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <form action="<?= base_url('admin/productos/actualizar/' . $producto['id']) ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                      <h5 class="modal-title">Editar Producto</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?= esc($producto['nombre']) ?>" required>
                      </div>
                      <div class="mb-3">
                        <label>Precio</label>
                        <input type="number" class="form-control" name="precio" value="<?= esc($producto['precio']) ?>" required>
                      </div>
                      <div class="mb-3">
                        <label>Categoría</label>
                        <input type="text" class="form-control" name="categoria" value="<?= esc($producto['categoria']) ?>" required>
                      </div>
                      <div class="mb-3">
                        <label>¿Está en oferta?</label>
                        <select class="form-select" name="oferta" id="oferta<?= $producto['id'] ?>" onchange="toggleVigencia(<?= $producto['id'] ?>)">
                          <option value="SI" <?= $producto['oferta'] === 'SI' ? 'selected' : '' ?>>Sí</option>
                          <option value="NO" <?= $producto['oferta'] === 'NO' ? 'selected' : '' ?>>No</option>
                        </select>
                      </div>
                      <div class="mb-3" id="vigenciaContainer<?= $producto['id'] ?>" style="display: <?= $producto['oferta'] === 'SI' ? 'block' : 'none' ?>;">
                        <label>Vigencia de la oferta</label>
                        <select class="form-select mb-2" name="oferta_vigencia" onchange="toggleFecha(this, <?= $producto['id'] ?>)">
                          <option value="indefinida">Indefinida</option>
                          <option value="fecha">Hasta una fecha</option>
                        </select>
                        <input type="date" name="oferta_fin" id="fechaVigencia<?= $producto['id'] ?>" class="form-control" style="display: none;">
                      </div>
                      <div class="mb-3">
                        <label>Imagen (opcional)</label>
                        <input type="file" class="form-control" name="imagen">
                        <small>Si no se selecciona una nueva imagen, se mantiene la actual.</small>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <tr>
            <td colspan="6" class="text-center">No hay productos cargados</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  function toggleVigencia(id) {
    const ofertaSelect = document.getElementById('oferta' + id);
    const vigenciaContainer = document.getElementById('vigenciaContainer' + id);
    vigenciaContainer.style.display = ofertaSelect.value === 'SI' ? 'block' : 'none';
  }

  function toggleFecha(select, id) {
    const fechaInput = document.getElementById('fechaVigencia' + id);
    fechaInput.style.display = select.value === 'fecha' ? 'block' : 'none';
  }
</script>

<?= $this->endSection() ?>
