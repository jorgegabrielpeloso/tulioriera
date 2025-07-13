<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Vencimientos</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f2f2f2; }
        img.logo { display: block; margin: 0 auto; width: 130px; height: auto; }
    </style>
</head>
<body>

    <img src="<?= FCPATH . 'public/assets/img/logo_tulioriera.png' ?>" class="logo" alt="Logo Tulio Riera">
    <h2>Reporte de Productos por Vencimiento</h2>

    <table>
        <thead>
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
            <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= esc($producto['codigo_riera']) ?></td>
                <td><?= esc($producto['nombre']) ?></td>
                <td><?= esc($producto['proveedor']) ?></td>
                <td><?= esc($producto['lote']) ?></td>
                <td><?= esc($producto['pasillo']) ?></td>
                <td><?= date('d/m/Y', strtotime($producto['fecha_vencimiento'])) ?></td>
                <td><?= date('d/m/Y H:i', strtotime($producto['created_at'])) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
