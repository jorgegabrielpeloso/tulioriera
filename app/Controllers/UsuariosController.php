<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class UsuariosController extends Controller
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        if (!session()->get('logueado')) return redirect()->to('/login');

        $rol = session()->get('usuario_rol');

        if ($rol === 'admin') {
            $usuarios = $this->usuarioModel->findAll();
            return view('back/admin/admin_usuarios', ['usuarios' => $usuarios]);
        } elseif ($rol === 'jefe_deposito') {
            $usuarios = $this->usuarioModel
                ->where('rol', 'pasillo')
                ->where('creado_por', session()->get('usuario_id'))
                ->findAll();
            return view('back/jefe/jefe_usuarios', ['usuarios' => $usuarios]);
        } else {
            return redirect()->to('/');
        }
    }

    public function guardar()
    {
        if (!session()->get('logueado')) return redirect()->to('/login');

        $rolLogueado = session()->get('usuario_rol');
        $creadoPor = session()->get('usuario_id');

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'rol' => $this->request->getPost('rol'),
            'pasillo_asignado' => $this->request->getPost('pasillo_asignado') ?? null,
            'creado_por' => $creadoPor,
        ];

        // Validación por rol
        if ($rolLogueado === 'jefe_deposito' && $data['rol'] !== 'pasillo') {
            return redirect()->back()->with('error', 'No podés crear ese tipo de usuario.');
        }

        $this->usuarioModel->save($data);
        return redirect()->to('/usuarios');
    }

    public function eliminar($id)
    {
        $this->usuarioModel->delete($id);
        return redirect()->to('/usuarios');
    }
}
