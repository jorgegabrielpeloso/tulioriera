<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Vencimientos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .resumen {
            margin-top: 15px;
            font-size: 13px;
        }
    </style>
</head>
<body>

    <h2>Reporte de Vencimientos - Próximos <?= esc($dias) ?> días</h2>
    <p class="resumen">Generado el: <?= esc($fecha) ?></p>

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
