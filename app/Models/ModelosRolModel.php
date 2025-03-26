<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelosRolModel extends Model
{ 
    protected $table            = 'modelos_rol';
    protected $primaryKey       = ['Modelosid', 'Rolid'];
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Modelosid', 'Rolid'];

    protected bool $allowEmptyInserts = false;


    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}