<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::iniciarSesion');

$routes->get('login', 'Home::iniciarSesion');

$routes->post('login/verificar', 'AuthController::verificar');
$routes->get('logout', 'AuthController::logout');

$routes->get('admin/dashboard','Admin::panel',['filter' => 'soloAdmin']);

$routes->get('vehiculos','Usuario::index');