<?php

require_once 'app/models/material.model.php';
require_once 'api.controller.php';

class MaterialesApiController extends ApiController {

    private $model;

    public function __construct() {
        parent::__construct();//invoco constructor ApiController        
        $this->model = new MaterialModel();
    }

    public function getAll(){
        $materiales = $this->model->getMateriales();

        if($materiales){
            return $this->view->response($materiales, 200);
        }

        return $this->view->response("Hubo un error en la base de datos", 500);
    }

   

}