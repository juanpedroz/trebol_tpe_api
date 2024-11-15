<?php
require_once 'libs/router.php';
require_once 'app/controllers/opinion.api.controller.php';
require_once 'app/controllers/material.api.controller.php';
require_once 'app/controllers/producto.api.controller.php';
require_once 'app/controllers/usuario.api.controller.php';
require_once 'app/controllers/token.api.controller.php';
    

$router = new Router();

// define la tabla de ruteo
#                 endpoint         verbo        controller             método
//productos
$router->addRoute('productos', 'GET', 'productoApiController', 'getProductos');
$router->addRoute('producto/:id', 'GET', 'productoApiController', 'getProducto');
$router->addRoute('producto', 'POST', 'productoApiController', 'crearProducto');
$router->addRoute('producto/:id', 'DELETE', 'productoApiController', 'eliminarProducto');
$router->addRoute('producto/:id', 'PUT', 'productoApiController', 'modificarProducto');
$router->addRoute('productosOrd', 'GET', 'productoApiController', 'getProductosOrdenados');//funciona

//opiniones
$router->addRoute('opiniones', 'GET', 'OpinionApiController', 'getAll');
$router->addRoute('opinion/:id', 'GET', 'OpinionApiController','getOpinion');
$router->addRoute('opinion', 'POST', 'OpinionApiController','crearOpinion');
$router->addRoute('opinion/:id', 'DELETE', 'OpinionApiController', 'eliminarOpinion');
$router->addRoute('opinion/:id', 'PUT', 'OpinionApiController', 'modificarOpinion');

$router->addRoute('usuario/:nombre_usuario', 'GET', 'UsuarioApiController', 'getUsuario');

$router->addRoute('token', 'GET', 'TokenApiController', 'getToken');

//materiales
$router->addRoute('materiales', 'GET', 'MaterialesApiController', 'getMateriales');
$router->addRoute('material/:id', 'GET', 'MaterialesApiController','getMaterial');
$router->addRoute('material', 'POST', 'MaterialesApiController','crearMaterial');
$router->addRoute('material/:id', 'DELETE', 'MaterialesApiController', 'eliminarMaterial');
$router->addRoute('material/:id', 'PUT', 'MaterialesApiController', 'modificarMaterial');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);