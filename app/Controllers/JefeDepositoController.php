<?php
namespace App\Controllers;

use App\Models\ProductoDepositoModel;
use App\Models\UsuarioModel;
use App\Models\VencimientoModel;
use CodeIgniter\Controller;

class JefeDepositoController extends Controller
{
    public function dashboard()
    {
        return view('back/jefe/jefe_dashboard');
    }

    public function guardarProducto()
    {
        $productoModel = new ProductoDepositoModel();

        $data = [
            'nombre'     => $this->request->getPost('nombre'),
            'descripcion'=> $this->request->getPost('descripcion'),
            'pasillo'    => $this->request->getPost('pasillo')
        ];

        $productoModel->insert($data);
        return redirect()->to(base_url('jefe/dashboard'))->with('mensaje', 'Producto guardado con éxito');
    }

    public function usuarios()
    {
        $usuarioModel = new UsuarioModel();
        $data['usuarios'] = $usuarioModel->where('rol', 'pasillo')->findAll();

        return view('back/jefe/jefe_usuarios', $data);
    }

    public function vencimientos()
    {
        $vencimientoModel = new VencimientoModel();

        // ✅ Usamos el método que une productos y usuarios
        $data['vencimientos'] = $vencimientoModel->getVencimientosConUsuarios();

        return view('back/jefe/vencimientos_jefe', $data);
    }

    public function vencimientosPDF()
    {
        $vencimientoModel = new VencimientoModel();
        $data['vencimientos'] = $vencimientoModel->getVencimientosConUsuarios();

        return view('back/jefe/pdf_vencimientos', $data);
    }
}
