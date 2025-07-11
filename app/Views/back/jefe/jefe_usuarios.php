<?= view('back/jefe/jefe_layout') ?>

<div class="container mt-4">
  <h2 class="mb-4">Gestión de Usuarios de Pasillo</h2>

  <div class="text-end mb-3">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUsuario">Crear Usuario de Pasillo</button>
  </div>

  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Pasillo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($usuarios as $u): ?>
        <tr>
          <td><?= esc($u['nombre']) ?></td>
          <td><?= esc($u['email']) ?></td>
          <td><?= esc($u['pasillo_asignado'] ?? '-') ?></td>
          <td>
            <a href="<?= base_url('usuarios/eliminar/' . $u['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">🗑️</a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('usuarios/guardar') ?>" method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Usuario de Pasillo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="rol" value="pasillo">

        <div class="mb-2">
          <label>Nombre</label>
          <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-2">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-2">
          <label>Contraseña</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-2">
          <label>Pasillo asignado</label>
          <input type="number" name="pasillo_asignado" class="form-control" min="1" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
      </div>
    </form>
  </div>
</div>
