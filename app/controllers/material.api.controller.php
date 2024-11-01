<?php

require_once 'app/models/material.model.php';
require_once 'app/views/producto.api.view.php';

class ProductoApiController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new MaterialModel();
        $this->view = new APIView();
    }

    public function getAll(){
        $materiales = $this->model->getMateriales();

        if($materiales){
            return $this->view->response($materiales, 200);
        }

        return $this->view->response("Hubo un error en la base de datos", 500);
    }

}