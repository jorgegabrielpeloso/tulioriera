<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoDepositoModel extends Model
{
    protected $table = 'productos_deposito';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nombre', 'descripcion', 'pasillo'];
    protected $useTimestamps = true;
}
