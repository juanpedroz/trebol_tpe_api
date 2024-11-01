<?php

require_once 'app/models/producto.api.model.php';
require_once 'app/views/producto.api.view.php';

class ProductoApiController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ProductoModel();
        $this->view = new APIView();
    }

    public function getAll(){
        $productos = $this->model->getProductos();

        if($productos){
            return $this->view->response($productos, 200);
        }

        return $this->view->response("Hubo un error en la base de datos", 500);
    }

}