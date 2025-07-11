<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Vencimientos</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .logo { width: 150px; }
        .fecha { text-align: right; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h3 { margin-bottom: 10px; }
    </style>
</head>
<body>


    <div class="header">
        <img src="<?= base_url('public/assets/img/logo_tulioriera.png') ?>" alt="Logo" class="logo">
        <div class="fecha">Fecha: <?= date('d/m/Y') ?></div>
    </div>

    <h3>Listado de productos que vencen en los próximos <?= esc($dias) ?> días</h3>

    <table>
        <thead>
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

</body>
</html>
