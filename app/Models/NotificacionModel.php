<?php
namespace App\Models;

use CodeIgniter\Model;

class NotificacionModel extends Model
{
    protected $table            = 'notificaciones';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ['mensaje', 'leido', 'created_at'];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = ''; // 🔧 Desactivamos updated_at para evitar error

    public function obtenerNoLeidas()
    {
        return $this->where('leido', 'NO')->orderBy('created_at', 'DESC')->findAll();
    }

    public function marcarTodasComoLeidas()
    {
        return $this->where('leido', 'NO')->set(['leido' => 'SI'])->update();
    }
}
