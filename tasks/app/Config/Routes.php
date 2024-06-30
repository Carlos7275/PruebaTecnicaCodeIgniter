<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group("", ["filter" => "login"], function ($routes) {
    $routes->get("/", 'Home::index');
});


$routes->get('/login', 'Home::login', ['filter' => 'public']);
$routes->get('/registro', 'Home::register', ['filter' => 'public']);

$routes->group('api',  function ($routes) {

    //Rutas que necesitan sesiones
    $routes->group('', ["filter" => "login"], function ($routes) {
        $routes->get('cerrarsesion', 'UsuariosController::cerrarSesion');
    });
    $routes->post('iniciarsesion', 'UsuariosController::iniciarSesion');
});
