<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartamentoModel extends Model
{
    protected $table            = 'departamento';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'nom', 'updated_at'];

    protected bool $allowEmptyInserts = false;


    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


}
