<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class RegisterController extends Controller
{
    private $UsuarioModel;
    private $key;

    public function __construct()
    {
        $this->UsuarioModel = new UsuarioModel();
        $this->key = "1023292005"; // Reemplaza con una clave segura
    }

    public function register()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        if ($this->UsuarioModel->where('email', $email)->first()) {
            return $this->response->setJSON([
                'message' => 'Email already registered',
                'response' => ResponseInterface::HTTP_CONFLICT
            ]);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userData = [
            'email' => $email,
            'password' => $hashedPassword
        ];

        if ($this->UsuarioModel->insert($userData)) {
            $payload = [
                'iss' => "your-domain.com",
                'aud' => "your-domain.com",
                'iat' => time(),
                'exp' => time() + 3600,
                'data' => [
                    'email' => $email
                ]
            ];

            $token = JWT::encode($payload, $this->key, 'HS256');

            return $this->response->setJSON([
                'message' => 'Registration successful',
                'token' => $token,
                'response' => ResponseInterface::HTTP_CREATED
            ]);
        } else {
            return $this->response->setJSON([
                'message' => 'Registration failed',
                'response' => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}