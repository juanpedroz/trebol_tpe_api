<?php

require_once 'app/models/opinion.api.model.php';
require_once 'app/views/opinion.api.view.php';

class OpinionApiController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new OpinionModel();
        $this->view = new APIView();
    }

    public function getAll(){
        $opiniones = $this->model->getOpiniones();

        if($opiniones){
            return $this->view->response($opiniones, 200);
        }

        return $this->view->response("Hubo un error en la base de datos", 500);
    }

    public function getOpinion($req){
        $id = $req->params->id;
        $opinion = $this->model->getOpinion($id);

        if(!$opinion){
            return $this->view->response("No existe un producto con el id = $id", 404);
        }

        return $this->view->response($opinion, 200);
    }

    public function crearOpinion($req){
        $calificacion = $req->body->calificacion;
        $comentario = $req->body->comentario;
        $id_producto = $req->body->id_producto;
        if(empty( $calificacion) || empty($comentario) || empty($id_producto)){
            return $this->view->response("Faltan completar campos", 401);
        }

        $dato = $this->model->crearOpinion($calificacion,  $comentario, $id_producto);

        return $this->view->response($dato, 200);
    }

}