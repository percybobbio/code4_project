<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('pelicula', 'Pelicula::index');

$routes->presenter('pelicula');

$routes->presenter('categoria');
