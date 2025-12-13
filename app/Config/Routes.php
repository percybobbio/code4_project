<?php

use App\Controllers\Api\Pelicula;
use App\Controllers\Web\Usuario;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//$routes->get('pelicula', 'Pelicula::index');

$routes->group('api', function($routes){
    $routes->get('test', 'Api\Pelicula::test');
    $routes->resource('pelicula', ['controller' => 'Api\Pelicula']);
    $routes->resource('categoria', ['controller' => 'Api\Categoria']);
});


$routes->group('dashboard', function($routes){
    $routes->presenter('pelicula' , ['controller' => 'Dashboard\Pelicula']);
    //$routes->get('index', 'Pelicula::index', ['as' => 'pelicula.index']);
    $routes->presenter('categoria' , ['controller' => 'Dashboard\Categoria']);
    //Para mostrar solo las rutas deseadas
    //$routes->presenter('categoria', ['only' => ['index', 'show']]);
    $routes->get('usuario/crear', [Usuario::class, 'crear_usuario']);
    $routes->get('usuario/probar', [Usuario::class, 'probar_contrasena']);

    //Para exceptuar rutas en el presenter
    //$routes->presenter('categoria', ['except' => ['index', 'show']]);
    $routes->get('indexcat', 'Categoria::index', ['as' => 'categoria.index']);
    $routes->get('test/(:num)/(:num)', 'Pelicula::test/$1/$2', ['as' => 'test']);
    $routes->presenter('usuario');
});

$routes->get('login', [Usuario::class, 'login'], ['as' => 'usuario.login']);
$routes->post('login_post', [Usuario::class, 'login_post'], ['as' => 'usuario.login_post']);

$routes->get('register', [Usuario::class, 'register'], ['as' => 'usuario.register']);
$routes->post('register_post', [Usuario::class, 'register_post'], ['as' => 'usuario.register_post']);

$routes->get('logout', [Usuario::class, 'logout'], ['as' => 'usuario.logout']);