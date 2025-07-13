<?php
namespace App\Models;

use CodeIgniter\Model;

class VencimientoModel extends Model
{
    protected $table = 'vencimientos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['producto_id', 'fecha_vencimiento', 'usuario_id'];
    public $useTimestamps = false;

    public function getVencimientosConUsuarios()
    {
    return $this->select('productos_deposito.nombre AS producto, productos_deposito.pasillo, vencimientos.fecha_vencimiento, usuarios.nombre AS usuario_nombre, vencimientos.created_at')
                ->join('productos_deposito', 'productos_deposito.id = vencimientos.producto_id')
                ->join('usuarios', 'usuarios.id = vencimientos.usuario_id')
                ->orderBy('vencimientos.created_at', 'DESC')
                ->findAll();
    }


    public function obtenerParaJefe($filtro_dias = null)
{
    $builder = $this->db->table('productos_deposito');
    $builder->select('*');

    if ($filtro_dias && is_numeric($filtro_dias)) {
        $fecha_limite = date('Y-m-d', strtotime("+$filtro_dias days"));
        $builder->where('fecha_vencimiento <=', $fecha_limite);
    }

    return $builder->get()->getResultArray();
}


}
