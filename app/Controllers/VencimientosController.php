<?php

namespace App\Controllers;

use App\Models\VencimientoModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

class VencimientosController extends Controller
{
    protected $vencimientoModel;

    public function __construct()
    {
        $this->vencimientoModel = new VencimientoModel();
    }

    public function verParaJefe()
    {
        return $this->vencimientosPorDias(9999); // Todos por defecto
    }

    public function vencimientosPorDias($dias = 9999)
    {
        $filtroDias = $this->request->getGet('filtro_dias');
        if ($filtroDias !== null) {
            $dias = (int)$filtroDias;
        }

        $fechaLimite = date('Y-m-d', strtotime("+$dias days"));

        $db = \Config\Database::connect();
        $builder = $db->table('vencimientos v');
        $builder->select('v.fecha_vencimiento, v.created_at, p.codigo_riera, p.nombre AS producto, p.proveedor, p.lote, p.pasillo');
        $builder->join('productos_deposito p', 'p.id = v.producto_id');
        $builder->where('v.fecha_vencimiento <=', $fechaLimite);
        $builder->orderBy('v.fecha_vencimiento', 'ASC');

        $vencimientos = $builder->get()->getResultArray();

        return view('back/jefe/vencimientos_jefe', [
            'vencimientos' => $vencimientos,
            'filtroActivo' => $dias
        ]);
    }

    public function exportarPdf()
{
    helper('filesystem');

    $filtro_dias = $this->request->getGet('filtro_dias');
    $model = new VencimientoModel();

    $productos = $model->obtenerParaJefe($filtro_dias); // esta función ya está definida

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml(view('back/jefe/vencimientos_pdf', ['productos' => $productos]));
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('reporte_vencimientos.pdf', ['Attachment' => false]);
}

}
