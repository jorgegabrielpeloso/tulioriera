<?= $this->extend('back/jefe/jefe_layout') ?>
<?= $this->section('contenido') ?>

<!-- Título -->
<h1 class="h3 mb-4 text-gray-800">Cargar producto al pasillo</h1>

<!-- Cards de bienvenida -->
<div class="row">

    <!-- Productos totales (placeholder) -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Productos cargados</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">125</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vencimientos registrados -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Vencimientos registrados</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">32</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-times fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Formulario para cargar producto -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nuevo producto</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('jefe/guardarProducto') ?>" method="post">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre del producto</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ej: Leche" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="descripcion">Descripción</label>
                    <input type="text" class="form-control" name="descripcion" placeholder="Ej: Entera x1L" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="pasillo">Pasillo</label>
                    <input type="text" class="form-control" name="pasillo" placeholder="Ej: 4" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar producto</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
