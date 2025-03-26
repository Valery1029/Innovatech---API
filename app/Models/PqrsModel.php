<?php

namespace App\Models;

use CodeIgniter\Model;

class PqrsModel extends Model
{
    protected $table            = 'pqrs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'descripcion',  'comentario_respuesta', 
        'tipo_pqrs_id', 'usuario_id', 'estado_pqrs_id'
    ];


    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
