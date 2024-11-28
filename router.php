<?php

require_once 'libs/router.php';

require_once 'app/controladores/vueloApiControlador.php';


$router = new Router();

$router->addRoute('vuelo', 'GET', 'VueloControlador', 'obtenerTodo');
$router->addRoute('vuelo/:id', 'GET', 'VueloControlador', 'obtener');
$router->addRoute('vuelo', 'POST', 'VueloControlador', 'agregar');
$router->addRoute('vuelo/:id', 'PUT', 'VueloControlador', 'modificar');
$router->addRoute('vuelo/:id', 'DELETE', 'VueloControlador', 'eliminar');


$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);