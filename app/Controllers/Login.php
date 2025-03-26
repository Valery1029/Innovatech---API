<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class LoginController extends Controller
{
    private $UsuarioModel;
    private $key;

    public function __construct()
    {
        $this->UsuarioModel = new UsuarioModel();
        $this->key = "1023292005"; // Reemplaza con una clave segura
    }

    public function login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->UsuarioModel->where('email', $email)->first();
        
        if ($user && password_verify($password, $user['password'])) {
            $payload = [
                'iss' => "your-domain.com", // Emisor del token
                'aud' => "your-domain.com", // Audiencia
                'iat' => time(), // Tiempo de emisión
                'exp' => time() + 3600, // Expiración en 1 hora
                'data' => [
                    'id' => $user['id'],
                    'email' => $user['email']
                ]
            ];

            $token = JWT::encode($payload, $this->key, 'HS256');

            return $this->response->setJSON([
                'message' => 'Login successful',
                'token' => $token,
                'response' => ResponseInterface::HTTP_OK
            ]);
        } else {
            return $this->response->setJSON([
                'message' => 'Invalid credentials',
                'response' => ResponseInterface::HTTP_UNAUTHORIZED
            ]);
        }
    }
}
