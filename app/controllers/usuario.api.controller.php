<?php

require_once 'app/models/usuario.model.php';
require_once 'api.controller.php';

class UsuarioApiController extends ApiController{

    private $model;

    public function __construct() {

        parent::__construct();//invoco constructor ApiController
        $this->model = new UsuariolModel;
        // el view está en la clase principal
    }

    public function getUsuario ($req){
        $nombre_usuario = $req->params->nombre_usuario;
        $usuario = $this->model->getUsuario($nombre_usuario);
        if(!isset($usuario)){
            return $this->view->response("No existe un producto con el nombre de usuario = $nombre_usuario", 404);
        }

        return $this->view->response($usuario, 200);
    }

    public function autenticar() {
        if (!$this->auth_basic()) {
            $this->view->response('Acceso denegado', 400);
            die();
        }

    }

    private function auth_basic() {
        try {
        
            $basic = $this->getHeaderToken();
            if (!isset($basic) || !$basic[0] || !$basic[1]) //RESOLVER ERROR CUANDO EL TOKEN ESTÁ MAL COPIADO !!!!!!!!
                return $this->view->response('token defectuoso o vacio', 400);
            $user = $basic[0];
            $pass = $basic[1];
            // print_r($user);
            // print_r($pass);
            // $existeUsuario = $this->validaUsuarioPass($user, $pass);
            // var_dump($existeUsuario); 
            return $this->validaUsuarioPass($user, $pass);                
        } catch (\Throwable $th) {
            return false;
        }
    } 

    public function validaUsuarioPass ($usuario, $password) {
        $user = $this->model->getUsuario($usuario);
        //Si el usuario existe y las contraseñas coinciden
        if($user && password_verify($password,($user->password))){
            return true;
        }
        return false;
    }

    private function getHeaderToken() {
        $headers = apache_request_headers();       

        $token = $headers['Token'];//asigno le valor del header Token en la variable $token

        $basic = base64_decode($token);

        $basic = explode(':',$basic);
        return $basic; //retorno user:pass en formato basic
    } 


    
}