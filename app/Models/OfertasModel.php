<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertasModel extends Model
{
    protected $table            = 'ofertas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'descuento',
        'imagen',
        'fechaini',
        'fechafin',
        'descripcion',
        'estado',
        'productos_id'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
