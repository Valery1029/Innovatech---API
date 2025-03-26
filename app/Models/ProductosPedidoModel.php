<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosPedidoModel extends Model
{
    protected $table            = 'productos_pedido';
    protected $primaryKey       = ['ProductosId_Producto', 'PedidoId_Pedido'];
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ProductosId_Producto', 'PedidoId_Pedido'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}