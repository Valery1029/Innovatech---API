<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuario';
    protected $primaryKey       = 'id_usuario';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 
        'documento', 'correo', 'telefono1', 'telefono2', 'direccion', 
        'usuario', 'password', 'tipo_documento_id', 'ciudad_id', 'rol_id', 'estado_usuario_id'
    ];

    protected bool $allowEmptyInserts = false;


    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
