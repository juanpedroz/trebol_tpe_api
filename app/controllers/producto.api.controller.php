<?php

require_once 'app/models/producto.api.model.php';
require_once 'api.controller.php';
require_once 'app/controllers/usuario.api.controller.php';
require_once 'app/models/material.model.php';

//error_reporting(E_ALL); // Muestra todos los errores
//ini_set('display_errors', 1); // Activa la visualización de errores

class ProductoApiController extends ApiController {
    
    private $model;
    private $user;

    public function __construct() {
        parent::__construct();//invoco constructor ApiController
        $this->model = new ProductoModel;
        $this->user = new UsuarioApiController;
        $this->modelMaterial = new MaterialModel;
    }

    public function getProductos (){
        $productos = $this->model->getProductos();
        return $this->view->response($productos,200);
    }

    public function getProducto($req){
        $id = $req->params->id;
        $producto = $this->model->detalleProducto($id);

        if(!$producto){
            return $this->view->response("No existe un producto con el id = $id", 404);
        }

        return $this->view->response($producto, 200);
    }

    public function crearProducto($req){//hay que controlar q esté logueado
        $this->user->autenticar();
        $nuevoProducto = $this->getData();//json_decode($this->data);
        $nombre = $nuevoProducto->nombre;
        $precio = $nuevoProducto->precio;
        $descripcion = $nuevoProducto->descripcion;
        $imagen = $nuevoProducto->imagen;
        $material = $nuevoProducto->id_material;// hay q controlar q el material exista
        
        $verificarMaterial = $this->modelMaterial->detalleMaterial($id);
        if(!$verificarMaterial){
            return $this->view->response("No existe el material", 404);
        }

        $this->model->cargarProducto($nombre, $precio, $descripcion, $imagen, $material);
        $this->view->response("Producto creado", 201);//este mensaje esta mal enviado porq no hay control de si esta creado o no
    }

    public function eliminarProducto($req){
        $id = $req->params->id;

        $producto = $this->model->detalleProducto($id);
        if(!$producto){
            return $this->view->response("No existe el producto", 404);
        }
        else{
            $this->model->eliminarProducto($id);
            return $this->view->response("El producto se elimino correctamente", 200);
        }
    }

    public function modificarProducto($req){
        $id = $req->params->id;

        $producto = $this->model->detalleProducto($id);

        if(!$producto){
            return $this->view->response("No existe el producto", 404);
        }

        $nuevoProducto = $this->getData();//json_decode($this->data);
        $nombre = $nuevoProducto->nombre;
        $precio = $nuevoProducto->precio;
        $descripcion = $nuevoProducto->descripcion;
        $imagen = $nuevoProducto->imagen;
        $material = $nuevoProducto->id_material;

        if(empty($nombre) || empty($precio) || empty($descripcion) || empty($imagen) || empty($material)){
            return $this->view->response("Faltan completar campos", 401);
        }

        $productoEditado = $this->model->guardarProducto($nombre,$precio, $descripcion, $imagen, $material, $id);

        return $this->view->response($productoEditado, 200);
    }
}