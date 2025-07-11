<?= $this->extend('back/jefe/jefe_layout') ?>
<?= $this->section('contenido') ?>

<h2 class="mb-4">Listado de vencimientos registrados</h2>

<!-- Filtro y botón PDF -->
<div class="d-flex mb-3 align-items-center gap-2">
    <select id="filtro_dias" class="form-select" style="max-width: 250px;">
        <option disabled selected>Filtrar próximos vencimientos...</option>
        <?php foreach ([5, 15, 30, 45, 60] as $d): ?>
            <option value="<?= $d ?>" <?= (isset($filtroActivo) && $filtroActivo == $d) ? 'selected' : '' ?>>
                Próximos <?= $d ?> días
            </option>
        <?php endforeach; ?>
    </select>

    <form action="<?= base_url('jefe/exportar-pdf') ?>" method="get" target="_blank" class="mb-0">
        <input type="hidden" name="filtro_dias" id="filtro_dias_hidden" value="<?= esc($filtroActivo ?? '') ?>">
        <button type="submit" class="btn btn-danger">Exportar PDF</button>
    </form>
</div>

<!-- Tabla -->
<table class="table table-bordered table-hover">
    <thead class="table-dark">
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

<!-- Script para navegación dinámica + sincronizar input hidden del PDF -->
<script>
    const selectFiltro = document.getElementById('filtro_dias');
    const inputHidden = document.getElementById('filtro_dias_hidden');

    selectFiltro.addEventListener('change', function () {
        const dias = this.value;
        if (inputHidden) inputHidden.value = dias;
        window.location.href = '<?= base_url('jefe/vencimientos-por-dias') ?>/' + dias;
    });
</script>

<?= $this->endSection() ?>
