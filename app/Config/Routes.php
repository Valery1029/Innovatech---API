<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('innovatech', function($routes){
  $routes->post('addUsuarioApi', 'RegisterApi::index');
  $routes->post('loginApi', 'LoginApi::index');
  $routes->get('usuariosApi', 'UsuarioApi::index', ['filter'=>'authFilter']);
});