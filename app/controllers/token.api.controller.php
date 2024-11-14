<?php

require_once 'api.controller.php';

class TokenApiController extends ApiController{


    public function __construct() {

        parent::__construct();//invoco constructor ApiController
        // el view está en la clase principal
    }


    public function getToken (){
        $basic = $this->getBasic();
        $token = array(
            'time' => time() + 1000,
            'token' => $basic
        );
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
    
//     private function getJWT($bearer) {
//         $header = array(
//             'alg' => 'HS256',
//             'typ' => 'JWT'
//         );
//         $header = base64_encode(json_encode($header));
//         // print_r($header);
//         // print_r("-------------");
    
//         $payload = base64_decode($bearer);
//         // print_r($payload);
//         // die;
//         $payloadarr = explode(':', $payload);
//         $user = $payloadarr[0];
//         $pass = $payloadarr[1];
//         print_r($user);
//         die;
//         $payload = json_encode($payload);
//         var_dump($payload);
//         // $payloadArray = array(
//         //     'nombre_usuario'=> '$payload[0]',
//         //     'password' => '$payload[1]'
//         // );
//         // var_dump($payloadArray);
//         die;
//         // $hp = "$header.$payload";
//         // print_r($hp);

//         // $signature =  hash_hmac('sha256', "$header.$payload", "secret");
//         // //$signature = base64_encode($signature);
//         // print_r($signature);
//         // $signature = base64_encode($signature);
//         // print_r("+++++++++");
//         // print_r($signature);




//         // die;
//         // $payload = json_encode($payload);
//         // $payloadArray = array(
//         //     'nombre_usuario'=> $payload[0],
//         //     'password' => $payload[1]
//         // );
//         // $payloadArray = base64url_encode(json_encode($payloadArray));
//         // print_r($payloadArray);
//         // die();
//         // // $header = array(
//         // //     'alg' => 'HS256',
//         // //     'typ' => 'JWT'
//         // // );

//         $header = $jwt[0];
//         $payload = $jwt[1];
//         $signature = $jwt[2];

//         return [$header, $payload, $signature];
//     }

//     public function autenticar() {
//         if (!$this->auth_bearer()) {
//             $this->view->response('Acceso denegado', 400);
//             die();
//         }

//     }

//     private function auth_bearer() {
//         try {
        
//             $bearer = $this->getBearer();
//             // print_r(base64_decode($bearer));
//             // die;
//             $jwt = $this->getJWT($bearer);
//             // print_r($jwt);
//             $decoded = $this->decodificar($jwt);
//             // print_r($decoded);
//             $payload = $decoded[1];
//             // $json = json_decode($payload);
//             // print_r($json);
//             if (!$json || !$json->usuario || !$json->clave)
//             {
//                 return null;
//             }

//             $usuario = $json->usuario;
//             $password = $json->clave;
//             print_r($usuario);
//             print_r($password);

//             return $this->validaUsuarioPass($usuario, $password);                
//         } catch (\Throwable $th) {
//             return false;
//         }
//     } 

    

    

//     private function decodificar($jwt) {

//         $header = base64_decode($jwt[0]);
//         $payload = base64_decode($jwt[1]);
//         $signature = base64_decode($jwt[2]);


//         return [$header, $payload, $signature];
//     }

//     public function validaUsuarioPass ($usuario, $password) {
//         $user = $this->usuario->getUsuario($usuario);
//         //Si el usuario existe y las contraseñas coinciden
//         if($user && password_verify($password,($user->password))){
//             return true;
//         }
//         return false;
//     }
// }