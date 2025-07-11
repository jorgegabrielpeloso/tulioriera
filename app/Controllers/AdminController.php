<?php
namespace App\Controllers;

use App\Models\ProductoModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function adminProductos()
    {
        echo view('back/admin/admin_productos');
    }

    public function guardarProducto()
    {
        $productoModel = new ProductoModel();

        $imagen = $this->request->getFile('imagen');
        $nombreImagen = null;

        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move(ROOTPATH . 'public/assets/img/productos', $nombreImagen);
        }

        $data = [
            'nombre'    => $this->request->getPost('nombre'),
            'precio'    => $this->request->getPost('precio'),
            'categoria' => $this->request->getPost('categoria'),
            'imagen'    => $nombreImagen,
            'oferta'    => $this->request->getPost('oferta') === 'SI' ? 'SI' : 'NO',
            'baja'      => 'NO',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $productoModel->insert($data);
        return redirect()->to(base_url('admin/productos'));
    }

    public function productos()
    {
        $productoModel = new ProductoModel();
        $productos = $productoModel->findAll(); // mostramos todos, activos y dados de baja
        return view('back/admin/admin_productos', ['productos' => $productos]);
    }

    public function actualizarProducto($id)
    {
        $model = new ProductoModel();
        $producto = $model->find($id);

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'precio' => $this->request->getPost('precio'),
            'categoria' => $this->request->getPost('categoria'),
            'oferta' => $this->request->getPost('oferta'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $img = $this->request->getFile('imagen');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $nuevoNombre = $img->getRandomName();
            $img->move('public/uploads', $nuevoNombre);
            $data['imagen'] = $nuevoNombre;
        }

        $model->update($id, $data);
        return redirect()->to(base_url('admin/productos'));
    }

    public function eliminarProducto($id)
    {
        $model = new ProductoModel();
        $model->update($id, [
            'baja' => 'SI',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->to(base_url('admin/productos'));
    }

    public function altaProducto($id)
    {
        $model = new ProductoModel();
        $model->update($id, [
            'baja' => 'NO',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->to(base_url('admin/productos'));
    }

    public function dashboard()
{
    $productoModel = new \App\Models\ProductoModel();
    $productos = $productoModel->where('baja', 'NO')->orderBy('created_at', 'DESC')->limit(10)->findAll();

    return view('back/admin/admin_dashboard', ['productos' => $productos]);
}

}
