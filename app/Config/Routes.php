<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::iniciarSesion');

$routes->get('login', 'Home::iniciarSesion');