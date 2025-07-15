<?= $this->extend('back/jefe/jefe_layout') ?>
<?= $this->section('contenido') ?>

<h4 class="mb-4"><i class="bi bi-folder2-open"></i> Reportes Generados</h4>

<?php if (session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<table class="table table-bordered table-hover shadow">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Fecha</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reportes as $archivo): ?>
            <tr>
                <td><?= esc($archivo['nombre']) ?></td>
                <td><?= esc($archivo['fecha']) ?></td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                        <a href="<?= base_url('jefe/descargar-reporte/' . $archivo['nombre']) ?>" class="btn btn-success btn-sm">
                            <i class="bi bi-download"></i> Descargar
                        </a>
                        <a href="<?= base_url('jefe/enviar-email/' . $archivo['nombre']) ?>" class="btn btn-primary btn-sm">
                            <i class="bi bi-envelope-fill"></i> Enviar por email
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
