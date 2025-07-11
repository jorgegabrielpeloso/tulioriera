<?php
namespace App\Controllers;

use App\Models\ProductoModel;
use CodeIgniter\Controller;

class ProductosPublicosController extends Controller
{
    public function index()
    {
        $model = new ProductoModel();
        $busqueda = $this->request->getGet('busqueda');
        $categoriaSeleccionada = $this->request->getGet('categoria');

        $builder = $model->where('baja', 'NO');

        if ($busqueda) {
            $builder->groupStart()
                ->like('nombre', $busqueda)
                ->orLike('categoria', $busqueda)
                ->groupEnd();
        }

        if ($categoriaSeleccionada) {
            $builder->where('categoria', $categoriaSeleccionada);
        }

        $productos = $builder->findAll();
        $categorias = $model->select('categoria')->distinct()->findColumn('categoria');

        return view('front/productos', [
            'productos' => $productos,
            'categorias' => $categorias,
            'busqueda' => $busqueda,
            'categoriaSeleccionada' => $categoriaSeleccionada
        ]);
    }

    public function ofertas()
    {
        $productoModel = new ProductoModel();

        $ofertas = $productoModel
            ->where('baja', 'NO')
            ->where('oferta', 'SI')
            ->groupStart()
                ->where('oferta_fin IS NULL')
                ->orWhere('oferta_fin >=', date('Y-m-d'))
            ->groupEnd()
            ->findAll();

        return view('front/ofertas', ['ofertas' => $ofertas]);
    }


    public function buscarAjax()
    {
        $model = new ProductoModel();
        $busqueda = $this->request->getGet('busqueda');
        $categoria = $this->request->getGet('categoria');
        $builder = $model->where('baja', 'NO');

        if ($busqueda) {
            $builder->groupStart()
                ->like('nombre', $busqueda)
                ->orLike('categoria', $busqueda)
                ->groupEnd();
        }

        if  ($categoria) {
            $builder->where('categoria', $categoria);
        }

        $productos = $builder->findAll();
        return $this->response->setJSON($productos);
    }


    
}
