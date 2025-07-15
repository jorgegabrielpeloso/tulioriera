<?php

namespace App\Controllers;

use App\Models\ProductoDepositoModel;
use App\Models\VencimientoModel;
use App\Models\NotificacionModel;
use CodeIgniter\Controller;

class JefeDepositoController extends Controller
{
    public function dashboard()
    {
        $db = \Config\Database::connect();

        // 📈 Vencimientos por mes
        $queryMes = $db->query("
            SELECT DATE_FORMAT(fecha_vencimiento, '%Y-%m') AS mes, COUNT(*) AS cantidad
            FROM vencimientos
            WHERE fecha_vencimiento IS NOT NULL
            GROUP BY mes
            ORDER BY mes ASC
        ");
        $vencimientos_por_mes = [];
        foreach ($queryMes->getResultArray() as $fila) {
            $vencimientos_por_mes[$fila['mes']] = (int) $fila['cantidad'];
        }

        // 🗂️ Vencimientos por pasillo
        $queryPasillo = $db->query("
            SELECT p.pasillo AS pasillo, COUNT(*) AS cantidad
            FROM productos_deposito p
            JOIN vencimientos v ON p.id = v.producto_id
            WHERE p.pasillo IS NOT NULL
            GROUP BY p.pasillo
            ORDER BY p.pasillo ASC
        ");
        $vencimientos_por_pasillo = [];
        foreach ($queryPasillo->getResultArray() as $fila) {
            $vencimientos_por_pasillo[$fila['pasillo']] = (int) $fila['cantidad'];
        }

        // 📊 Totales
        $productos_cargados = $db->table('productos_deposito')->countAll();
        $vencimientos_registrados = $db->table('vencimientos')->countAll();

        // 🔔 Notificaciones
        $notificacionModel = new NotificacionModel();
        $notificaciones = $notificacionModel->orderBy('created_at', 'DESC')->findAll(5);

        return view('back/jefe/jefe_dashboard', [
            'productos_cargados' => $productos_cargados,
            'vencimientos_registrados' => $vencimientos_registrados,
            'vencimientos_por_mes' => $vencimientos_por_mes,
            'vencimientos_por_pasillo' => $vencimientos_por_pasillo,
            'notificaciones' => $notificaciones
        ]);
    }
    public function marcarNotificacionesLeidas()
{
    $model = new \App\Models\NotificacionModel();
    $model->where('leido', 'NO')->set(['leido' => 'SI'])->update();

    return redirect()->to(base_url('jefe/dashboard'));
}

    public function crearNotificacionVencimientos()
    {
        $vencimientoModel = new VencimientoModel();
        $hoy = date('Y-m-d');
        $limite = date('Y-m-d', strtotime('+5 days'));

        $cantidad = $vencimientoModel
            ->where('fecha_vencimiento >=', $hoy)
            ->where('fecha_vencimiento <=', $limite)
            ->countAllResults();

        if ($cantidad > 0) {
            $model = new NotificacionModel();
            $model->insert([
                'mensaje' => "⚠️ $cantidad producto(s) vencen en menos de 5 días",
                'leido' => 'NO'
            ]);
        }

        return redirect()->to(base_url('jefe/dashboard'));
    }

    public function formProductoConVencimiento()
    {
        return view('back/jefe/productos_vencimiento');
    }

    public function guardarProductoConVencimiento()
    {
        $productoModel = new ProductoDepositoModel();
        $vencimientoModel = new VencimientoModel();

        $dataProducto = [
            'codigo_riera' => $this->request->getPost('codigo_riera'),
            'nombre' => $this->request->getPost('nombre'),
            'proveedor' => $this->request->getPost('proveedor'),
            'lote' => $this->request->getPost('lote'),
            'pasillo' => $this->request->getPost('pasillo'),
            'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
            'created_at' => date('Y-m-d H:i:s'),
            'up' => session()->get('id'),
        ];

        $productoModel->insert($dataProducto);
        $productoID = $productoModel->getInsertID();

        $dataVencimiento = [
            'producto_id' => $productoID,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $vencimientoModel->insert($dataVencimiento);

        return redirect()->to(base_url('jefe/productos-vencimiento'))->with('mensaje', 'Producto y vencimiento guardados');
    }

    public function guardarProducto()
    {
        helper(['form']);
        $productoModel = new ProductoDepositoModel();
        $vencimientoModel = new VencimientoModel();

        $data = [
            'codigo_riera' => $this->request->getPost('codigo_riera'),
            'nombre' => $this->request->getPost('nombre'),
            'proveedor' => $this->request->getPost('proveedor'),
            'lote' => $this->request->getPost('lote'),
            'pasillo' => $this->request->getPost('pasillo'),
            'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
        ];

        $productoModel->insert($data);
        $producto_id = $productoModel->getInsertID();

        $vencimientoModel->insert([
            'producto_id' => $producto_id,
            'fecha_vencimiento' => $data['fecha_vencimiento'],
            'usuario_id' => session('id'),
        ]);

        return redirect()->to(base_url('jefe/vencimientos'));
    }

    public function generarReporte()
    {
        $script = realpath(APPPATH . '../python_scripts/generar_reporte.py');
        $output = shell_exec("py $script 2>&1");

        if (str_contains($output, 'Reporte generado correctamente')) {
            session()->setFlashdata('mensaje', '<i class="bi bi-file-earmark-excel-fill"></i> Reporte generado con éxito.');
        } else {
            session()->setFlashdata('error', '<i class="bi bi-exclamation-triangle-fill"></i> Ocurrió un error al generar el reporte.');
        }

        return redirect()->to(base_url('jefe/dashboard'));
    }

    public function reportesGenerados()
    {
        $ruta = WRITEPATH . 'reportes/';
        $archivos = [];

        if (is_dir($ruta)) {
            $files = scandir($ruta);
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'xlsx') {
                    $archivos[] = [
                        'nombre' => $file,
                        'ruta'   => base_url('writable/reportes/' . $file),
                        'fecha'  => date("Y-m-d H:i:s", filemtime($ruta . $file))
                    ];
                }
            }
        }

        return view('back/jefe/reportes_generados', ['reportes' => $archivos]);
    }

    public function descargarReporte($nombre)
    {
        $ruta = WRITEPATH . 'reportes/' . $nombre;

        if (!file_exists($ruta)) {
            return redirect()->back()->with('error', 'El archivo no existe.');
        }

        return $this->response->download($ruta, null)->setFileName($nombre);
    }

    public function enviarEmail($nombre)
    {
        $ruta = WRITEPATH . 'reportes/' . $nombre;

        if (!file_exists($ruta)) {
            return redirect()->back()->with('error', 'El archivo no existe.');
        }

        $email = \Config\Services::email();
        $email->setTo('pelosogabrielj@gmail.com');
        $email->setSubject('📊 Reporte de Vencimientos');
        $email->setMessage('Se adjunta el reporte generado desde el sistema Tulio Riera.');
        $email->attach($ruta);

        if ($email->send()) {
            return redirect()->back()->with('mensaje', 'Reporte enviado por email.');
        } else {
            return redirect()->back()->with('error', 'No se pudo enviar el correo.');
        }
    }
}
