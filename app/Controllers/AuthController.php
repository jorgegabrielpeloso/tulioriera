<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('back/auth/login');
    }

    public function procesarLogin()
    {
        $nombre = $this->request->getPost('nombre');
        $password = $this->request->getPost('password');

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->where('nombre', $nombre)->first();

        if (!$usuario) {
            return redirect()->to('/login')->with('error', 'Usuario no encontrado');
        }

        if (!password_verify($password, $usuario['password'])) {
            return redirect()->to('/login')->with('error', 'Contraseña incorrecta');
        }

        // ✅ Guardamos toda la info relevante en la sesión
        session()->set([
            'usuario_id' => $usuario['id'],
            'usuario_rol' => $usuario['rol'],
            'usuario_nombre' => $usuario['nombre'],
            'usuario_pasillo' => $usuario['pasillo'] ?? null,
            'logueado' => true
        ]);

        // 🔀 Redirección según el rol
        switch ($usuario['rol']) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'jefe_deposito':
                return redirect()->to('/jefe/dashboard');
            case 'pasillo':
                return redirect()->to('/pasillo/dashboard');
            default:
                return redirect()->to('/login')->with('error', 'Rol no reconocido');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
