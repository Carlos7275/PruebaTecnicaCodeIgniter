<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group("", ["filter" => "login"], function ($routes) {
    $routes->get("/", 'Home::inicio');
    $routes->group("", ['filter' => 'rolefilter:1'], function ($routes) {
        $routes->get("usuarios", "UsuariosController::usuarios");
        $routes->get("tareas", "TareasController::tareas");
    });
    $routes->get('usuario/configuracion', 'UsuariosController::configuracionUsuario');
});


$routes->get('/login', 'UsuariosController::login', ['filter' => 'public']);
$routes->get('/registro', 'UsuariosController::registro', ['filter' => 'public']);

$routes->group('api',  function ($routes) {

    //Rutas que no necesitan sesiones
    $routes->post('iniciarsesion', 'UsuariosController::iniciarSesion');
    $routes->get('generos', 'GenerosController::obtenerGeneros');
    $routes->get('genero/(:num)', 'GenerosController::obtenerGenero/$1');
    $routes->post("crearUsuario", 'UsuariosController::registrarUsuario');

    //Rutas que necesitan sesiones
    $routes->group('', ["filter" => "login"], function ($routes) {
        //Usuarios
        $routes->get('cerrarsesion', 'UsuariosController::cerrarSesion');
        $routes->post("usuarios", "UsuariosController::paginacion");
        $routes->put("editarusuario/(:num)", 'UsuariosController::editarUsuario/$1');
        $routes->delete("cambiarestatus/(:num)", "UsuariosController::cambiarEstatus/$1");

        //Roles
        $routes->get("roles", "RolesController::obtenerRoles");
        //Prioridades
        $routes->get("obtenerPrioridades", "PrioridadesController:obtenerPrioridades");

        //Tareas
        $routes->post("tareas", "TareasController::paginar");
        $routes->post("creartarea", "TareasController::crearTarea");
        $routes->put("editartarea/(:num)", "TareasController::editarTarea/$1");
        $routes->put("eliminartarea/(:num)", "TareasController::eliminarTarea/$1");
    });
});
