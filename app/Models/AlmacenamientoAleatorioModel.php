<?php

namespace App\Models;

use CodeIgniter\Model;

class AlmacenamientoAleatorioModel extends Model
{
    protected $table            = 'almacenamiento_aleatorio';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['num', 'unidadestandar'];

    protected bool $allowEmptyInserts = false;
    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}