<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class AuthFilter implements FilterInterface {
  public function before(RequestInterface $request, $arguments = null) {
    $key = getenv('JWT_SECRET');
    $header = $request->getHeaderLine('Authorization');
    $token = null;

    if (!empty($header)) {
			if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
				$token = $matches[1];
			}
    }
		if (is_null($token) || empty($token)) {
      $response = service('response');
			$response->setBody('Acceso Denegado');
			$response->setStatusCode('401');
			return $response;
    }
		try {
      $decoded = JWT::decode($token, new Key($key, 'HS256'));
      // Agregar los datos del usuario decodificado a la solicitud
      $request->user = [
        'email' => $decoded->email,
        'usuario' => $decoded->usuario,
        'rol_id' => $decoded->rol_id,
      ];
    } catch (Exception $ex) {
      $response = service('response');
			$response->setBody('Token inválido');
			$response->setStatusCode('401');
			return $response;
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
    // No se requiere procesamiento posterior
  }
}
