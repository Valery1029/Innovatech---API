<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsuarioModel;
use Firebase\JWT\JWT;

class Login extends BaseController {
    use ResponseTrait;

    public function index() {
        $usuarioModel = new UsuarioModel();
        $email = $this->request->getVar('correo');
        $password = $this->request->getVar('password');
        
        $usuario = $usuarioModel->where('correo', $email)->first();

        if (is_null($usuario)) {
            return $this->respond(['error' => 'Usuario no encontrado'], 401);
        }
        
        if (!password_verify($password, $usuario['password'])) {
            return $this->respond(['error' => 'Credenciales incorrectas'], 401);
        }
        
        $key = getenv('JWT_SECRET');
        $iat = time();
        $exp = $iat + 3600;
        $payload = [
            'iss' => 'Issuer of the JWT',
            'aud' => 'Audience that the JWT',
            'sub' => 'Subject of the JWT',
            'iat' => $iat,
            'exp' => $exp,
            'email' => $usuario['correo'],
            'usuario' => $usuario['usuario'],
            'rol_id' => $usuario['rol_id'],
        ];
        
        $token = JWT::encode($payload, $key, 'HS256');
        $response = [
            'message' => 'Inicio de sesión exitoso',
            'token' => $token
        ];
        
        return $this->respond($response, 200);
    }
}
