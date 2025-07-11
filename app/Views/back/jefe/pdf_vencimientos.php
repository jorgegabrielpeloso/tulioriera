<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Vencimientos</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        h2 { text-align: center; }
    </style>
</head>
<body>

<h2>Productos próximos a vencer</h2>

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
