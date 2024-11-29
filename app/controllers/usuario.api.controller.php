<?php

require_once 'app/models/usuario.model.php';
require_once 'api.controller.php';

class UsuarioApiController extends ApiController{

    protected $modelUsuario;

    public function __construct() {

        parent::__construct();//invoco constructor ApiController
        $this->modelUsuario = new UsuariolModel;
        // el view está en la clase principal
    }

    public function getUsuario ($req){
        $this->autenticar();
        $nombre_usuario = $req->params->nombre_usuario;
        $usuario = $this->modelUsuario->getUsuario($nombre_usuario);
        if(!isset($usuario)){
            return $this->view->response("No existe un producto con el nombre de usuario = $nombre_usuario", 404);
        }

        return $this->view->response($usuario, 200);
    }

    public function autenticar() {
        if (!$this->auth_basic()) {
            $this->view->response('Acceso denegado', 401);
            die();
        }

    }

    private function auth_basic() {
        try {
        
            $basic = $this->getHeaderToken();
            $token = explode(':',$basic[0]);
            // print_r($basic[1]);
            // print_r("0000000000");
            // print_r(time());
            // // die;
            if (!isset($basic) || !$basic[0] || !$basic[1]) {//RESOLVER ERROR CUANDO EL TOKEN ESTÁ MAL COPIADO !!!!!!!!
                $this->view->response('token defectuoso o vacio', 401);
                die();
            }
            $user = $token[0];
            $pass = $token[1];
            if ($basic[1] < time())
                return $this->view->response('token vencido', 401);
            return $this->validaUsuarioPass($user, $pass);                
        } catch (\Throwable $th) {
            return false;
        }
    } 

    public function validaUsuarioPass ($usuario, $password) {
        $user = $this->modelUsuario->getUsuario($usuario);
        //Si el usuario existe y las contraseñas coinciden
        if($user && password_verify($password,($user->password))){
            return true;
        }
        return false;
    }

    private function getHeaderToken() {
        $headers = apache_request_headers();       

        $token = $headers['Token'];//asigno le valor del header Token en la variable $token
        $basic = explode('.',$token);
        // $basic = base64_decode($token);
        
        $token = base64_decode($basic[0]);
        $time = base64_decode($basic[1]);
        // print_r($token);
        // print_r($time);
        return [$token,$time];
        die;          
        $basic = explode(':',$basic);
        
        return $basic; //retorno user:pass en formato basic
    } 


    
}