<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Usuario::index');

$routes->get('login', 'AuthController::login');
$routes->get('registrarse', 'AuthController::registro');

$routes->post('registrarse/verificar', 'AuthController::verificarRegistro');

$routes->post('login/verificar', 'AuthController::verificar');
$routes->get('logout', 'AuthController::logout');

// Panel principal protegido por el filtro de administrador
$routes->get('admin/dashboard', 'Admin::panel', ['filter' => 'soloAdmin']);
// Ruta para cargar la pantalla de listado de reservas
$routes->get('admin/reservas-pendientes', 'Admin::reservasPendientes');

// Ruta para procesar la aprobación de una reserva individual
$routes->get('admin/aprobar-reserva/(:num)', 'Admin::confirmarReserva/$1');
// Ruta para ver el detalle de una reserva específica
$routes->get('admin/reserva-detalle/(:num)', 'Admin::detalleReserva/$1');

// Ruta para rechazar una reserva
$routes->get('admin/rechazar-reserva/(:num)', 'Admin::rechazarReserva/$1');
$routes->get('admin/devoluciones', 'Admin::devoluciones');
$routes->get('admin/confirmar-devolucion/(:num)', 'Admin::confirmarDevolucion/$1');
// Ruta para el reporte de alquileres activos
$routes->get('admin/reporte-activos', 'Admin::reporteActivos');
// Ruta para el reporte de clientes por vehículo
$routes->get('admin/reporte-clientes-vehiculo', 'Admin::reporteClientesVehiculo');
// Ruta para el reporte de vehículos por cliente
$routes->get('admin/reporte-vehiculos-cliente', 'Admin::reporteVehiculosCliente');

$routes->get('vehiculos', 'Usuario::index');

$routes->get('admin/gestionar-usuarios', 'Admin::gestionarUsuarios');
$routes->get('admin/usuarios/baja/(:num)', 'Admin::bajaLogica/$1');
$routes->get('admin/usuarios/editar/(:num)', 'Admin::editar/$1');
$routes->post('admin/usuarios/actualizar/(:num)', 'Admin::actualizar/$1');

$routes->get('admin/gestionar-vehiculos', 'Admin::gestionarVehiculos');
$routes->get('admin/vehiculos/baja/(:num)', 'Admin::bajaLogicaVehiculo/$1');
$routes->get('admin/vehiculos/editar/(:num)', 'Admin::editarVehiculo/$1');
$routes->post('admin/vehiculos/actualizar/(:num)', 'Admin::actualizarVehiculo/$1');
$routes->get('admin/vehiculos/crear', 'Admin::crearVehiculo');
$routes->post('admin/vehiculos/guardar', 'Admin::guardarVehiculo');

$routes->get('vehiculos','Usuario::index');

$routes->get('categoria/(:segment)', 'Vehiculo::categoria/$1');

$routes->get('categoria/detalle/(:num)', 'Vehiculo::detalle/$1');

$routes->get('reserva/(:num)', 'Alquiler::nuevo/$1');
$routes->post('alquiler/guardar', 'Alquiler::guardar');

$routes->get('mis-reservas', 'Alquiler::misReservas');