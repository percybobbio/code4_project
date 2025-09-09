<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('pelicula', 'Pelicula::index');


$routes->group('dashboard', function($routes){
    $routes->presenter('pelicula' , ['controller' => 'Dashboard\Pelicula']);
    $routes->get('index', 'Pelicula::index', ['as' => 'pelicula.index']);
    $routes->presenter('categoria' , ['controller' => 'Dashboard\Categoria']);
    //Para mostrar solo las rutas deseadas
    //$routes->presenter('categoria', ['only' => ['index', 'show']]);

    //Para exceptuar rutas en el presenter
    //$routes->presenter('categoria', ['except' => ['index', 'show']]);
    $routes->get('indexcat', 'Categoria::index', ['as' => 'categoria.index']);
    $routes->get('test/(:num)/(:num)', 'Pelicula::test/$1/$2', ['as' => 'test']);
    $routes->presenter('usuario');
});
