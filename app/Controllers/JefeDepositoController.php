<?php

namespace App\Controllers;

use App\Models\ProductoDepositoModel;
use App\Models\VencimientoModel;
use CodeIgniter\Controller;

class JefeDepositoController extends Controller{


    public function dashboard()
{
    $productoModel = new \App\Models\ProductoDepositoModel();
    $vencimientoModel = new \App\Models\VencimientoModel();

    $data['productos_cargados'] = $productoModel->countAll();
    $data['vencimientos_registrados'] = $vencimientoModel->countAll();

    return view('back/jefe/jefe_dashboard', $data);
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
            'nombre'       => $this->request->getPost('nombre'),
            'proveedor'    => $this->request->getPost('proveedor'),
            'lote'         => $this->request->getPost('lote'),
            'pasillo'      => $this->request->getPost('pasillo'),
            'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
            'created_at'   => date('Y-m-d H:i:s'),
            'up'           => session()->get('id'), // ID del jefe logueado
        ];

        // Insertar producto en productos_deposito
        $productoModel->insert($dataProducto);
        $productoID = $productoModel->getInsertID();

        // Insertar vencimiento asociado
        $dataVencimiento = [
            'producto_id' => $productoID,
            'created_at'  => date('Y-m-d H:i:s'),
        ];
        $vencimientoModel->insert($dataVencimiento);

        return redirect()->to(base_url('jefe/productos-vencimiento'))->with('mensaje', 'Producto y vencimiento guardados');
    }

    public function guardarProducto()
{
    helper(['form']);
    $productoModel = new \App\Models\ProductoDepositoModel();
    $vencimientoModel = new \App\Models\VencimientoModel();

    $data = [
        'codigo_riera' => $this->request->getPost('codigo_riera'),
        'nombre'       => $this->request->getPost('nombre'),
        'proveedor'    => $this->request->getPost('proveedor'),
        'lote'         => $this->request->getPost('lote'),
        'pasillo'      => $this->request->getPost('pasillo'),
        'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
    ];

    // Insertamos el producto
    $productoModel->insert($data);
    $producto_id = $productoModel->getInsertID(); // Obtenemos el ID insertado

    // Insertamos el vencimiento asociado
    $vencimientoData = [
        'producto_id' => $producto_id,
        'fecha_vencimiento' => $data['fecha_vencimiento'],
        'usuario_id' => session('id'), // o el campo correspondiente según cómo lo manejes
    ];
    $vencimientoModel->insert($vencimientoData);

    return redirect()->to(base_url('jefe/vencimientos'));
}




}
