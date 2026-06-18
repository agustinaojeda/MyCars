<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Usuario::index');

$routes->get('login', 'AuthController::login');

$routes->post('login/verificar', 'AuthController::verificar');
$routes->get('logout', 'AuthController::logout');

$routes->get('admin/dashboard','Admin::panel',['filter' => 'soloAdmin']);

$routes->get('vehiculos','Usuario::index');