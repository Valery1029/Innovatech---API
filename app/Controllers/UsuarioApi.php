<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsuarioModel;

class UserApi extends BaseController {
  use ResponseTrait;

  public function index() {
    $usuarioModel = new UsuarioModel();
    return $this->respond(['usuarios' => $usuarioModel->findAll()], 200);
  }
}
