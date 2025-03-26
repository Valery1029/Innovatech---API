<?php

namespace App\Models;

use CodeIgniter\Model;

class PermisosModelosRolModel extends Model
{
    protected $table            = 'permisos_modelos_rol';
    protected $primaryKey       = ['Permisosid', 'Modelos_RolModelosid', 'Modelos_RolRolid'];
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Permisosid', 'Modelos_RolModelosid', 'Modelos_RolRolid'];

    protected bool $allowEmptyInserts = false;


    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}