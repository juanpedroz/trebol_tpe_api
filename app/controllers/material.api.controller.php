<?php

require_once 'app/models/material.model.php';
require_once 'api.controller.php';
require_once 'app/controllers/usuario.api.controller.php';

class MaterialesApiController extends ApiController {

    private $model;

    public function __construct() {
        parent::__construct();//invoco constructor ApiController        
        $this->model = new MaterialModel();
        $this->user = new UsuarioApiController();
    }

    public function getMateriales($req){
        $page = $req->params->page;
        $materiales = $this->model->getMateriales($page);

        if(!isset($materiales))
            return $this->view->response("Página no existe",404);
        return $this->view->response($materiales,200);
    }

    public function getMaterialesOrdenados ($req){
        $campo = $req->query->campo;
        $sentido = $req->query->sentido;
        
        $materiales = $this->model->getMaterialesOrdenados($campo,$sentido);
        return $this->view->response($materiales,200);
    }

    public function getMaterial($req){
        $id = $req->params->id;
        $material = $this->model->detalleMaterial($id);

        if(!$material){
            return $this->view->response("No existe el material", 404);
        }
        return $this->view->response($material, 200);
    }

    public function crearMaterial(){
        $this->user->autenticar();
        $nuevoMaterial = $this->getData();//json_decode($this->data);
        $material = $nuevoMaterial->material;
        $proveedor = $nuevoMaterial->proveedor;
        
        if(empty( $material) || empty($proveedor) ){
            return $this->view->response("Faltan completar campos", 401);
        }

        $this->model->cargarMaterial($material, $proveedor);
        $this->view->response("Material creado", 201);
    }

   public function eliminarMaterial($req){
        $this->user->autenticar();
        $id = $req->params->id;

        $material = $this->model->detalleMaterial($id);
        if(!$material){
            return $this->view->response("No existe el material", 404);
        }
        else {
            $eliminado=$this->model->eliminarMaterial($id);
            if($eliminado){
                return $this->view->response("El material se elimino correctamente", 200);
            }
            else{
                return $this->view->response("El material no se puede eliminar porque esta siendo usado por un producto", 500);
            }
        }
   }

   public function modificarMaterial($req){
        $this->user->autenticar();
        $id = $req->params->id;

        $opinion = $this->model->detalleMaterial($id);
        if(!$opinion){
            return $this->view->response("No existe la opinion", 404);
        }

        $nuevoMaterial = $this->getData();
        $material = $nuevoMaterial->material;
        $proveedor = $nuevoMaterial->proveedor;
        
        if(empty( $material) || empty($proveedor) ){
            return $this->view->response("Faltan completar campos", 401);
        }
        $materialEditado = $this->model->modificarMaterial($material, $proveedor, $id);

        return $this->view->response("Material editado", 200);
   }
   

}