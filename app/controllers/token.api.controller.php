<?php

require_once 'api.controller.php';

class TokenApiController extends ApiController{


    public function __construct() {

        parent::__construct();//invoco constructor ApiController
        // el view está en la clase principal
    }


    public function getToken (){
        $basic = $this->getBasic();
        $time = base64_encode(time() + 250);
        $token ="$basic.$time";
        // $token = array(
        //     'time' => time() + 1000,
        //     'token' => $basic
        // );
        return $this->view->response($token,200);
    }

    private function getBasic() {
        $headers = apache_request_headers();

        $autorization = $headers['Authorization'];
        
        $bearerArray = explode(' ', $autorization);
        $bearer = $bearerArray[1];
        return $bearer; //retorno user:pass en formato basic
    }
}
