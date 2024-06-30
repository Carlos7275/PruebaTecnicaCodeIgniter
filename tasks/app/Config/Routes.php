<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group("", ["filter" => "login"], function ($routes) {
    $routes->get("/", 'Home::inicio');
    $routes->group("", ['filter' => 'rolefilter:1'], function ($routes) {
        $routes->get("usuarios", "UsuariosController::usuarios");
    });
    $routes->get('usuario/configuracion', 'UsuariosController::configuracionUsuario');
});


$routes->get('/login', 'UsuariosController::login', ['filter' => 'public']);
$routes->get('/registro', 'UsuariosController::registro', ['filter' => 'public']);

$routes->group('api',  function ($routes) {

    //Rutas que necesitan sesiones
    $routes->group('', ["filter" => "login"], function ($routes) {
        $routes->get('cerrarsesion', 'UsuariosController::cerrarSesion');
        $routes->put("editarusuario/(:num)", 'UsuariosController::editarUsuario/$1');
    });
    $routes->post('iniciarsesion', 'UsuariosController::iniciarSesion');
    $routes->get('generos', 'GenerosController::obtenerGeneros');
    $routes->get('genero/(:num)', 'GenerosController::obtenerGenero/$1');
    $routes->post("crearUsuario", 'UsuariosController::registrarUsuario');
});
