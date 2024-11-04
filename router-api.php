<?php
require_once 'libs/router.php';
require_once 'app/controllers/opinion.api.controller.php';
require_once 'app/controllers/material.api.controller.php';
    

$router = new Router();

// define la tabla de ruteo
#                 endpoint         verbo        controller                     método
$router->addRoute('opiniones', 'GET', 'OpinionApiController', 'getAll');
//$router->addRoute('materiales', 'GET', 'MaterialesApiController', 'getAll');
$router->addRoute('opinion/:id', 'GET', 'OpinionApiController','getOpinion');
$router->addRoute('opinion', 'POST', 'OpinionApiController','crearOpinion');
// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);