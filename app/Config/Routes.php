<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Usuario::index');

$routes->get('login', 'AuthController::login');
$routes->get('registrarse', 'AuthController::registro');

$routes->post('registrarse/verificar', 'AuthController::verificarRegistro');

$routes->post('login/verificar', 'AuthController::verificar');
$routes->get('logout', 'AuthController::logout');

//$routes->get('admin/dashboard','Admin::panel',['filter' => 'soloAdmin']); POR AHORA lo dejo asi
$routes->get('admin/dashboard', 'Admin::panel');
// Ruta para cargar la pantalla de listado de reservas
$routes->get('admin/reservas-pendientes', 'Admin::reservasPendientes');

// Ruta para procesar la aprobación de una reserva individual
$routes->get('admin/aprobar-reserva/(:num)', 'Admin::confirmarReserva/$1');

$routes->get('vehiculos','Usuario::index');

$routes->get('categoria/(:segment)', 'Vehiculo::categoria/$1');

$routes->get('categoria/detalle/(:num)', 'Vehiculo::detalle/$1');

$routes->get('reserva/(:num)', 'Alquiler::nuevo/$1');
$routes->post('alquiler/guardar', 'Alquiler::guardar');