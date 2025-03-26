<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosIngresoModel extends Model
{
    protected $table            = 'productos_ingreso_producto';
    protected $primaryKey       = ['ProductosId_Producto', 'Ingreso_productoid_ingreso'];
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ProductosId_Producto', 'Ingreso_productoid_ingreso', 'cantidad'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}