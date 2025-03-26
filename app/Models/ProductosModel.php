<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table            = 'productos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nom',
        'descripcion',
        'existencias',
        'precio',
        'imagen',
        'caracteristicas',
        'tam',
        'tampantalla',
        'id_marca',
        'id_estado',
        'id_color',
        'id_categoria',
        'id_garantia',
        'id_almacenamiento',
        'id_ram',
        'id_sistema_operativo',
        'id_resolucion'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
