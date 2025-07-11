<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        $productoModel = new ProductoModel();

        $hoy = date('Y-m-d');
        $destacados = $productoModel
            ->where('oferta', 'SI')
            ->where('baja', 'NO')
            ->groupStart()
                ->where('oferta_fin IS NULL')
                ->orWhere('oferta_fin >=', '2025-07-06')
            ->groupEnd()
            ->findAll();

        return view('front/inicio', ['destacados' => $destacados]);
    }
}
