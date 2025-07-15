<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 🌐 Página de inicio
$routes->get('/', 'Home::index');
$routes->get('/inicio', 'Home::index');

// 🛒 Productos públicos
$routes->get('productos', 'ProductosPublicosController::index');
$routes->get('productos/(:segment)', 'ProductosPublicosController::index/$1');
$routes->get('productos/buscar/ajax', 'ProductosPublicosController::buscarAjax');
$routes->get('ofertas', 'ProductosPublicosController::ofertas');

// 🤖 Chatbot
$routes->post('chatbot/responder', 'ChatbotController::responder');

// 🔐 Autenticación
$routes->get('login', 'AuthController::login');
$routes->post('procesar-login', 'AuthController::procesarLogin');
$routes->get('logout', 'AuthController::logout');

// 👑 Panel Admin
$routes->get('admin', 'AdminController::dashboard');
$routes->get('admin/dashboard', 'AdminController::dashboard');

// 📦 Productos (admin)
$routes->get('admin/productos', 'ProductosController::index');
$routes->post('admin/productos/guardar', 'ProductosController::guardar');
$routes->post('admin/productos/actualizar/(:num)', 'ProductosController::actualizar/$1');
$routes->get('admin/productos/eliminar/(:num)', 'ProductosController::eliminar/$1');
$routes->get('admin/productos/alta/(:num)', 'ProductosController::alta/$1');

// 👥 Usuarios (admin y jefe)
$routes->get('usuarios', 'UsuariosController::index');
$routes->post('usuarios/guardar', 'UsuariosController::guardar');
$routes->get('usuarios/eliminar/(:num)', 'UsuariosController::eliminar/$1');

// 📂 Panel Jefe de Depósito
$routes->get('jefe/dashboard', 'JefeDepositoController::dashboard');
$routes->get('jefe/vencimientos', 'VencimientosController::verParaJefe');
$routes->get('jefe/vencimientos-por-dias/(:num)', 'VencimientosController::vencimientosPorDias/$1');
$routes->get('jefe/vencimientos/pdf/(:num)', 'JefeDepositoController::generarPDF/$1');
$routes->get('jefe/exportar-pdf', 'VencimientosController::exportarPdf');
$routes->get('jefe/productos-vencimiento', 'JefeDepositoController::formProductoConVencimiento');
$routes->post('jefe/guardarProducto', 'JefeDepositoController::guardarProducto');
$routes->post('jefe/guardarProductoConVencimiento', 'JefeDepositoController::guardarProductoConVencimiento');
$routes->get('jefe/generar-reporte', 'JefeDepositoController::generarReporte');
$routes->get('jefe/descargar-reporte', 'JefeDepositoController::descargarUltimoReporte');
$routes->get('jefe/reportes-generados', 'JefeDepositoController::reportesGenerados');
$routes->get('jefe/descargar-reporte/(:any)', 'JefeDepositoController::descargarReporte/$1');
$routes->get('jefe/enviar-email/(:any)', 'JefeDepositoController::enviarEmail/$1');
$routes->get('jefe/notificaciones-leidas', 'JefeDepositoController::marcarNotificacionesLeidas');


// 🧾 Panel Pasillo
$routes->get('pasillo/dashboard', 'PasilloController::dashboard');
$routes->post('pasillo/guardar-vencimiento', 'PasilloController::guardarVencimiento');
