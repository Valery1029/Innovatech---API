<?php

namespace App\Models;

use CodeIgniter\Model;

class IngresoProductoModel extends Model
{
    protected $table            = 'ingreso_producto';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['factura', 'UsuarioId_usuario2'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}