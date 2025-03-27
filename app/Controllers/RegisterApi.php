<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsuarioModel;

class RegisterApi extends BaseController {
  use ResponseTrait;

  public function index() {
    $rules = [
      'correo' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[usuario.correo]'],
      'password' => ['rules' => 'required|min_length[4]|max_length[255]'],
      'confirm_password' => ['label' => 'confirm_password', 'rules' => 'matches[password]']
    ];

    if ($this->validate($rules)) {
      $usuarioModel = new UsuarioModel();
      $data = [
        'correo' => $this->request->getVar('correo'),
        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
      ];

      $usuarioModel->save($data);
      return $this->respond(['message' => 'Registro exitoso'], 200);
    } else {
      $response = [
        'error' => $this->validator->getErrors(),
        'message' => 'Datos inválidos'
      ];
      return $this->fail($response, 409);
    }
  }
}