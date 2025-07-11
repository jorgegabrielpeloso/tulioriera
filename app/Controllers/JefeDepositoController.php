<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductoDepositoModel;
use App\Models\VencimientoModel;
use App\Models\UsuarioModel;

class JefeDepositoController extends Controller
{
    public function dashboard()
    {
        if (session()->get('usuario_rol') !== 'jefe_deposito') {
            return redirect()->to('/login');
        }

        return view('back/jefe/jefe_dashboard');
    }

   public function vencimientos()
{
    if (session()->get('usuario_rol') !== 'jefe_deposito') {
        return redirect()->to('/login');
    }

    $db = \Config\Database::connect();

    $vencimientos = $db->table('vencimientos v')
        ->select('v.fecha_vencimiento, v.created_at, u.nombre AS pasillero, p.nombre AS producto')
        ->join('usuarios u', 'u.id = v.usuario_id')
        ->join('productos_deposito p', 'p.id = v.producto_id')
        ->orderBy('v.created_at', 'DESC')
        ->get()
        ->getResultArray();

    return view('back/jefe/vencimientos_jefe', ['vencimientos' => $vencimientos]);
}


    public function guardarProducto()
    {
        if (session()->get('usuario_rol') !== 'jefe_deposito') {
            return redirect()->to('/login');
        }

        $productoModel = new ProductoDepositoModel();

        $productoModel->save([
            'nombre'      => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'pasillo'     => $this->request->getPost('pasillo'),
        ]);

        return redirect()->back()->with('mensaje', 'Producto guardado correctamente.');
    }
}
