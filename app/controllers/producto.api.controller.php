<?php

require_once 'app/models/producto.api.model.php';
require_once 'app/views/api.view.php';

class ProductoApiController {
    
    private $model;
    private $view;

    public function __construct() {
        $this->data = file_get_contents("php://input");//hay q crear un controller general
        $this->view = new ApiView;
        $this->model = new ProductoModel;
    }

//     private function getData() {
//         return json_decode($this->data);
//     }

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
        $nuevoProducto = json_decode($this->data);
        $nombre = $nuevoProducto->nombre;
        $precio = $nuevoProducto->precio;
        $descripcion = $nuevoProducto->descripcion;
        $imagen = $nuevoProducto->imagen;
        $material = $nuevoProducto->id_material;
        $this->model->cargarProducto($nombre, $precio, $descripcion, $imagen, $material);
        $this->view->response("Producto creado", 200);//este mensaje esta mal enviado porq no hay control de si esta creado o no
    }

}