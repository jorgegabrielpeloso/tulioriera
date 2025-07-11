<?= $this->extend('back/jefe/jefe_layout') ?>
<?= $this->section('contenido') ?>

<!-- Título -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-users"></i> Usuarios Creados</h1>
</div>

<!-- Tabla de usuarios -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Listado de usuarios creados por el Jefe</h6>
  </div>
  <div class="card-body">
    <?php if (!empty($usuarios)): ?>
      <div class="table-responsive">
        <table class="table table-bordered table-hover" width="100%">
          <thead class="thead-light">
            <tr>
              <th>Nombre</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Pasillo asignado</th>
              <th>Estado</th>
              <th>Fecha de creación</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios as $usuario): ?>
              <tr>
                <td><?= esc($usuario['nombre']) ?></td>
                <td><?= esc($usuario['email']) ?></td>
                <td><?= esc($usuario['rol']) ?></td>
                <td><?= esc($usuario['pasillo'] ?? '—') ?></td>
                <td>
                  <?php if ($usuario['baja'] === 'NO'): ?>
                    <span class="badge badge-success">Activo</span>
                  <?php else: ?>
                    <span class="badge badge-danger">Baja</span>
                  <?php endif; ?>
                </td>
                <td><?= date('d/m/Y H:i', strtotime($usuario['created_at'])) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-center">No hay usuarios cargados aún.</p>
    <?php endif; ?>
  </div>
</div>

<?= $this->endSection() ?>
