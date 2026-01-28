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
    //A veces se debe colocar las rutas mas espeficas antes de las generales
    $routes->get('pelicula/etiquetas/(:num)', 'Dashboard\Pelicula::etiquetas/$1', ['as' => 'pelicula.etiquetas']);
    $routes->post('pelicula/etiquetas/(:num)', 'Dashboard\Pelicula::etiquetas_post/$1', ['as' => 'pelicula.etiquetas']);
    $routes->post('pelicula/(:num)/etiquetas/(:num)/delete', 'Dashboard\Pelicula::etiqueta_delete/$1/$2', ['as' => 'pelicula.etiqueta.delete']);
    $routes->presenter('pelicula' , ['controller' => 'Dashboard\Pelicula']);
    //$routes->get('index', 'Pelicula::index', ['as' => 'pelicula.index']);
    $routes->presenter('categoria' , ['controller' => 'Dashboard\Categoria']);

    //Ruta para las etiquetas
    $routes->presenter('etiqueta' , ['controller' => 'Dashboard\Etiqueta']);
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