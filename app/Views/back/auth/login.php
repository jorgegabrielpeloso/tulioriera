<?= view('front/head_view') ?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h3 class="text-center mb-4">Iniciar Sesión</h3>

      <?php if (session('error')): ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
      <?php endif; ?>

      <form action="<?= base_url('procesar-login') ?>" method="post">
        <div class="mb-3">
          <label for="nombre" class="form-label">Usuario</label>
          <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
      </form>
    </div>
  </div>
</div>

<?= view('front/footer_view') ?>
