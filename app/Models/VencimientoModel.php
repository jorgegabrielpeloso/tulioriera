<?php
namespace App\Models;

use CodeIgniter\Model;

class VencimientoModel extends Model
{
    protected $table = 'vencimientos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['producto_id', 'fecha_vencimiento', 'usuario_id'];

    public $useTimestamps = false;
}
