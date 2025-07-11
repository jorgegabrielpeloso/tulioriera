<!-- app/Views/back/admin/productos_form.php -->
<?= view('back/admin/header') ?>
<div class="container mt-5">
  <h2 class="mb-4">Cargar nuevo producto</h2>
  <form action="<?= base_url('/admin/productos/guardar') ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre del producto</label>
      <input type="text" class="form-control" name="nombre" id="nombre" required>
    </div>

    <div class="mb-3">
      <label for="precio" class="form-label">Precio</label>
      <input type="number" step="0.01" class="form-control" name="precio" id="precio" required>
    </div>

    <div class="mb-3">
      <label for="categoria" class="form-label">Categoría</label>
      <select class="form-select" name="categoria" id="categoria" required>
        <option value="">Seleccionar</option>
        <option value="Limpieza">Limpieza</option>
        <option value="Congelados">Congelados</option>
        <option value="Bebidas c/alcohol">Bebidas c/alcohol</option>
        <option value="Bebidas s/alcohol">Bebidas s/alcohol</option>
        <option value="Comestibles">Comestibles</option>
        <option value="Golosinas">Golosinas</option>
        <option value="Cerveza">Cerveza</option>
        <option value="Vinos y Espumantes">Vinos y Espumantes</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="imagen" class="form-label">Imagen del producto</label>
      <input type="file" class="form-control" name="imagen" id="imagen" required>
    </div>

    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" name="oferta" id="oferta">
      <label class="form-check-label" for="oferta">
        Producto en oferta (aparecerá en la portada)
      </label>
    </div>

    <button type="submit" class="btn btn-primary">Guardar producto</button>
  </form>
</div>
<?= view('back/admin/footer') ?>
