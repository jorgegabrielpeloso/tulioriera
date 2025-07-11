<?php
namespace App\Controllers;

use App\Models\ProductoModel;
use CodeIgniter\Controller;

class ProductosController extends Controller
{
    public function index()
    {
        $productoModel = new ProductoModel();
        $productos = $productoModel->findAll();

        return view('back/admin/admin_productos', ['productos' => $productos]);
    }

    public function guardar()
    {
        $productoModel = new ProductoModel();

        $imagen = $this->request->getFile('imagen');
        $nombreImagen = null;

        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move(ROOTPATH . 'public/assets/img/productos', $nombreImagen);
        }

        $oferta = $this->request->getPost('oferta') === 'SI' ? 'SI' : 'NO';
        $oferta_fin = null;

        if ($oferta === 'SI') {
            $tipoVigencia = $this->request->getPost('oferta_vigencia');
            if ($tipoVigencia === 'fecha') {
                $oferta_fin = $this->request->getPost('oferta_fin');
            }
        }

        $data = [
            'nombre'      => $this->request->getPost('nombre'),
            'precio'      => $this->request->getPost('precio'),
            'categoria'   => $this->request->getPost('categoria'),
            'imagen'      => $nombreImagen,
            'oferta'      => $oferta,
            'oferta_fin'  => $oferta_fin,
            'baja'        => 'NO',
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $productoModel->insert($data);
        return redirect()->to(base_url('admin/productos'));
    }

    public function actualizar($id)
    {
        $model = new ProductoModel();
        $producto = $model->find($id);

        $data = [
            'nombre'      => $this->request->getPost('nombre'),
            'precio'      => $this->request->getPost('precio'),
            'categoria'   => $this->request->getPost('categoria'),
            'oferta'      => $this->request->getPost('oferta') === 'SI' ? 'SI' : 'NO',
            'oferta_fin'  => null,
            'updated_at'  => date('Y-m-d H:i:s')
        ];

        if ($data['oferta'] === 'SI') {
            $tipoVigencia = $this->request->getPost('oferta_vigencia');
            if ($tipoVigencia === 'fecha') {
                $data['oferta_fin'] = $this->request->getPost('oferta_fin');
            }
        }

        $img = $this->request->getFile('imagen');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $nuevoNombre = $img->getRandomName();
            $img->move(ROOTPATH . 'public/assets/img/productos', $nuevoNombre);
            $data['imagen'] = $nuevoNombre;
        }

        $model->update($id, $data);
        return redirect()->to(base_url('admin/productos'));
    }

    public function eliminar($id)
    {
    $model = new ProductoModel();
    $data = [
        'baja' => 'SI',
        'updated_at' => date('Y-m-d H:i:s')
    ];
    $model->update($id, $data);
    return redirect()->to(base_url('admin/productos'));
    }

    public function alta($id)
    {
    $model = new ProductoModel();
    $data = [
        'baja' => 'NO',
        'updated_at' => date('Y-m-d H:i:s')
    ];
    $model->update($id, $data);
    return redirect()->to(base_url('admin/productos'));
    }

}
