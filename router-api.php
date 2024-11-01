<?php
require_once 'libs/router.php';
require_once 'app/controllers/producto.api.controller.php';
require_once 'app/controllers/material.api.controller.php';
    

$router = new Router();

// define la tabla de ruteo
#                 endpoint         verbo        controller                     método
$router->addRoute('productos', 'GET', 'ProductoApiController', 'getAll');
$router->addRoute('materiales', 'GET', 'MaterialesApiController', 'getAll');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);