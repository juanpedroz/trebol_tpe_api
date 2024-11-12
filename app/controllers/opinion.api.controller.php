<?php

require_once 'app/models/opinion.api.model.php';
require_once 'api.controller.php';

class OpinionApiController extends ApiController {

    private $model;

    public function __construct() {
        parent::__construct();//invoco constructor ApiController 
        $this->model = new OpinionModel();
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
        $nuevaOpinion = $this->getData();
        $calificacion = $nuevaOpinion->calificacion;
        $comentario = $nuevaOpinion->comentario;
        $id_producto = $nuevaOpinion->id_producto;//hay q controlar que el producto exista
        $id_usuarios = $nuevaOpinion->id_usuarios;
        if(empty( $calificacion) || empty($comentario) || empty($id_producto)){//el id_usuario debería venir del logueo
            return $this->view->response("Faltan completar campos", 401);
        }

        $this->model->crearOpinion($calificacion, $comentario, $id_usuarios, $id_producto);
        
        return $this->view->response("todo piola", 200);
    }

}