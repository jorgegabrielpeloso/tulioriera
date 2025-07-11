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

    public function guardar()
    {
        if (session()->get('usuario_rol') !== 'pasillo') {
            return redirect()->back()->with('mensaje', 'Solo los empleados de pasillo pueden registrar vencimientos.');
        }

        $usuarioId = session()->get('usuario_id');

        if (!$usuarioId) {
            return redirect()->back()->with('mensaje', 'Error: sesión expirada o usuario inválido.');
        }

        $usuarioModel = new \App\Models\UsuarioModel();
        $usuario = $usuarioModel->find($usuarioId);

        if (!$usuario || empty($usuario['pasillo'])) {
            return redirect()->back()->with('mensaje', 'Error: el usuario no tiene un pasillo asignado.');
        }

        $datos = [
            'producto' => $this->request->getPost('producto'),
            'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
            'pasillo' => $usuario['pasillo'],
            'usuario_id' => $usuarioId
        ];

        $this->vencimientoModel->save($datos);

        return redirect()->back()->with('mensaje', 'Vencimiento registrado correctamente.');
    }

    public function verParaJefe()
    {
        return $this->vencimientosPorDias(9999); // sin límite inicial
    }

    public function vencimientosPorDias($dias)
{
    $fechaLimite = date('Y-m-d', strtotime("+$dias days"));

    $db = \Config\Database::connect();
    $builder = $db->table('vencimientos v');
    $builder->select('v.fecha_vencimiento, v.created_at, p.pasillo, u.nombre AS pasillero, p.nombre AS producto');
    $builder->join('usuarios u', 'u.id = v.usuario_id');
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
        $dias = $this->request->getGet('filtro_dias');
        $fechaActual = date('d/m/Y');

        $db = \Config\Database::connect();
        $builder = $db->table('vencimientos v');
        $builder->select('v.fecha_vencimiento, v.created_at, p.pasillo, u.nombre AS pasillero, p.nombre AS producto');
        $builder->join('usuarios u', 'u.id = v.usuario_id');
        $builder->join('productos_deposito p', 'p.id = v.producto_id');
        $builder->where('v.fecha_vencimiento <=', date('Y-m-d', strtotime("+$dias days")));
        $builder->orderBy('v.fecha_vencimiento', 'ASC');

        $vencimientos = $builder->get()->getResultArray();

        $html = view('back/jefe/vencimientos_pdf', [
            'vencimientos' => $vencimientos,
            'dias' => $dias,
            'fecha' => $fechaActual
        ]);

        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("vencimientos_{$dias}_dias.pdf", ["Attachment" => false]); // abrir en navegador
    }
}
