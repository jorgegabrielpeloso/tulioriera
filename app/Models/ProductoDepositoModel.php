<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductoDepositoModel extends Model
{
    protected $table = 'productos_deposito';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'codigo_riera',
        'nombre',
        'proveedor',
        'lote',
        'pasillo',
        'fecha_vencimiento'
    ];

    protected $useTimestamps = true;
}
