<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductoDepositoModel;
use App\Models\VencimientoModel;
use App\Models\UsuarioModel;

class PasilloController extends Controller
{
    public function dashboard()
    {
        if (session()->get('usuario_rol') !== 'pasillo') {
            return redirect()->to('/login');
        }

        $usuarioId = session()->get('usuario_id');
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($usuarioId);

        $productosModel = new ProductoDepositoModel();
        $productos = $productosModel->where('pasillo', $usuario['pasillo'])->findAll();

        return view('back/pasillo/pasillo_dashboard', [
            'productos' => $productos,
            'pasillo' => $usuario['pasillo']
        ]);
    }

    public function guardarVencimiento()
    {
        if (session()->get('usuario_rol') !== 'pasillo') {
            return redirect()->to('/login');
        }

        $usuarioId = session()->get('usuario_id');

        if (!$usuarioId) {
            return redirect()->back()->with('error', 'Usuario no logueado.');
        }

        $vencimientoModel = new VencimientoModel();

        $vencimientoModel->save([
            'producto_id' => $this->request->getPost('producto'),
            'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
            'usuario_id' => $usuarioId
        ]);

        return redirect()->back()->with('mensaje', 'Vencimiento registrado correctamente.');
    }
}
