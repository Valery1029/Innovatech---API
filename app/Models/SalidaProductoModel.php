<?php

namespace App\Models;

use CodeIgniter\Model;

class SalidaProductoModel extends Model
{
    protected $table            = 'salida_producto';
    protected $primaryKey       = ['id', 'facturaid', 'Productosid'];
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'Fecha', 'Cantidad', 'Precio', 'facturaid', 'Productosid'];

    protected bool $allowEmptyInserts = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}