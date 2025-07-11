
<?= $this->extend('back/jefe/jefe_layout') ?>
<?= $this->section('contenido') ?>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800 text-center">Listado de vencimientos registrados</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <select id="filtroDias" class="form-control form-control-sm w-auto">
                <option value="9999" <?= $filtroActivo == 9999 ? 'selected' : '' ?>>Todos los vencimientos</option>
                <option value="5" <?= $filtroActivo == 5 ? 'selected' : '' ?>>Próximos 5 días</option>
                <option value="15" <?= $filtroActivo == 15 ? 'selected' : '' ?>>Próximos 15 días</option>
                <option value="30" <?= $filtroActivo == 30 ? 'selected' : '' ?>>Próximos 30 días</option>
                <option value="45" <?= $filtroActivo == 45 ? 'selected' : '' ?>>Próximos 45 días</option>
                <option value="60" <?= $filtroActivo == 60 ? 'selected' : '' ?>>Próximos 60 días</option>
            </select>
        </div>
        <div>
            <a href="<?= base_url('jefe/exportarPdf?filtro_dias=' . $filtroActivo) ?>" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Exportar PDF
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Producto</th>
                    <th>Pasillo</th>
                    <th>Pasillero</th>
                    <th>Fecha de vencimiento</th>
                    <th>Registrado el</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vencimientos as $v): ?>
                <tr>
                    <td><?= esc($v['producto']) ?></td>
                    <td><?= esc($v['pasillo']) ?></td>
                    <td><?= esc($v['pasillero']) ?></td>
                    <td><?= date('d/m/Y', strtotime($v['fecha_vencimiento'])) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($v['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('filtroDias').addEventListener('change', function () {
        const dias = this.value;
        window.location.href = "<?= base_url('jefe/vencimientos/') ?>" + dias;
    });
</script>

<?= $this->endSection() ?>
