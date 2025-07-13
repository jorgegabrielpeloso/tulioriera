<?= $this->extend('back/jefe/jefe_layout') ?>
<?= $this->section('contenido') ?>

<h1 class="h3 mb-4 text-gray-800">Reporte de Vencimientos</h1>

<!-- Filtros -->
<form method="get" class="form-inline mb-4">
  <label class="mr-2">Filtrar por vencimiento:</label>
  <select name="filtro_dias" class="form-control mr-2" onchange="this.form.submit()">
    <option value="9999" <?= $filtroActivo == 9999 ? 'selected' : '' ?>>Todos</option>
    <option value="5" <?= $filtroActivo == 5 ? 'selected' : '' ?>>5 días</option>
    <option value="15" <?= $filtroActivo == 15 ? 'selected' : '' ?>>15 días</option>
    <option value="30" <?= $filtroActivo == 30 ? 'selected' : '' ?>>30 días</option>
    <option value="45" <?= $filtroActivo == 45 ? 'selected' : '' ?>>45 días</option>
    <option value="60" <?= $filtroActivo == 60 ? 'selected' : '' ?>>60 días</option>
  </select>

  <a href="<?= base_url('vencimientos/exportarPdf?filtro_dias=' . $filtroActivo) ?>" 
     class="btn btn-danger ml-2" 
     target="_blank">
    <i class="fas fa-file-pdf"></i> Exportar PDF
  </a>
</form>

<!-- Tabla de Vencimientos -->
<div class="table-responsive">
  <table class="table table-bordered">
    <thead class="thead-dark">
      <tr>
        <th>Código Riera</th>
        <th>Producto</th>
        <th>Proveedor</th>
        <th>Lote</th>
        <th>Pasillo</th>
        <th>Fecha de Vencimiento</th>
        <th>Registrado el</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($vencimientos)): ?>
        <?php foreach ($vencimientos as $item): ?>
          <tr>
            <td><?= esc($item['codigo_riera']) ?></td>
            <td><?= esc($item['producto']) ?></td>
            <td><?= esc($item['proveedor']) ?></td>
            <td><?= esc($item['lote']) ?></td>
            <td><?= esc($item['pasillo']) ?></td>
            <td><?= date('d/m/Y', strtotime($item['fecha_vencimiento'])) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="7" class="text-center">No se encontraron vencimientos para este filtro.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>
