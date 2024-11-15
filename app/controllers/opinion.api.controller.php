<?php

require_once 'app/models/opinion.api.model.php';
require_once 'app/controllers/usuario.api.controller.php';
require_once 'api.controller.php';

class OpinionApiController extends ApiController {

    private $model;
    private $user;

    public function __construct() {
        parent::__construct();//invoco constructor ApiController 
        $this->model = new OpinionModel();
        $this->user = new UsuarioApiController();
        $this->view = new APIView;
        $this->modelProducto = new ProductoModel();

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
        $this->user->autenticar();
        $nuevaOpinion = $this->getData();
        $calificacion = $nuevaOpinion->calificacion;
        $comentario = $nuevaOpinion->comentario;
        $id_usuarios = $nuevaOpinion->id_usuarios;
        $id_producto = $nuevaOpinion->id_producto;//hay q controlar que el producto exista
        $verificarProducto = $this->modelProducto->detalleProducto($id);
        if(!$verificarProducto ){
            return $this->view->response("No existe el producto", 404);
        }
        
        if(empty( $calificacion) || empty($comentario) || empty($id_producto)){//el id_usuario debería venir del logueo
            return $this->view->response("Faltan completar campos", 401);
        }

        $this->model->crearOpinion($calificacion, $comentario, $id_usuarios, $id_producto);
        
        return $this->view->response("Opinion creada", 201);
    }

    public function eliminarOpinion($req){
        $id = $req->params->id;

        $opinion = $this->model->getOpinion($id);
        if(!$opinion){
            return $this->view->response("No existe la opinion", 404);
        }
        else{
            $this->model->eliminarOpinion($id);
            return $this->view->response("La opinion se elimino correctamente", 200);
        }
    }

    public function modificarOpinion($req){
        $id = $req->params->id;

        $opinion = $this->model->getOpinion($id);
        if(!$opinion){
            return $this->view->response("No existe la opinion", 404);
        }

        $nuevaOpinion = $this->getData();
        $calificacion = $nuevaOpinion->calificacion;
        $comentario = $nuevaOpinion->comentario;
        $id_producto = $nuevaOpinion->id_producto;
        $id_usuarios = $nuevaOpinion->id_usuarios;
        if(empty( $calificacion) || empty($comentario) || empty($id_producto)){//el id_usuario debería venir del logueo
            return $this->view->response("Faltan completar campos", 401);
        }
        $opinionEditada = $this->model->modificarOpinion($calificacion,$comentario, $id_producto, $id_usuarios, $id);

        return $this->view->response($OpinionEditada, 200);
    }
    
}