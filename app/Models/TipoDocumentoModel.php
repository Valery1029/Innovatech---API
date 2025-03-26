<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoDocumentoModel extends Model
{
    protected $table            = 'tipo_documento';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nom'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}