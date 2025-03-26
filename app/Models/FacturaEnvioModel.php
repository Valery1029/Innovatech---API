<?php

namespace App\Models;

use CodeIgniter\Model;

class FacturaEnvioModel extends Model
{
    protected $table            = 'factura_envio';
    protected $primaryKey       = ['FacturaId_Factura', 'EnvioId_Envio'];
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['FacturaId_Factura', 'EnvioId_Envio'];

    protected bool $allowEmptyInserts = false;


    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


}