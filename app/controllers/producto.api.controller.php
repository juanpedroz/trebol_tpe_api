<?php

require_once 'app/models/producto.api.model.php';
require_once 'api.controller.php';

class ProductoApiController extends ApiController {
    
    private $model;

    public function __construct() {
        parent::__construct();//invoco constructor ApiController
        $this->model = new ProductoModel;
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
        $nuevoProducto = $this->getData();//json_decode($this->data);
        $nombre = $nuevoProducto->nombre;
        $precio = $nuevoProducto->precio;
        $descripcion = $nuevoProducto->descripcion;
        $imagen = $nuevoProducto->imagen;
        $material = $nuevoProducto->id_material;// hay q controlar q el material exista
        $this->model->cargarProducto($nombre, $precio, $descripcion, $imagen, $material);
        $this->view->response("Producto creado", 200);//este mensaje esta mal enviado porq no hay control de si esta creado o no
    }

    public function modificarProducto($req){
        
    }

}