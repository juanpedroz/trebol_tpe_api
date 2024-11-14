<?php

require_once 'model.php';

class UsuariolModel extends Model{

    public function getUsuario($nombre_usuario){
        $pdo = $this->crearConexion();

        $sql = "select * from usuarios where nombre_usuario = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$nombre_usuario]);
    
        $usuario = $query->fetch(PDO::FETCH_OBJ);
    
        return $usuario;
    }

    public function crearUsuario($nombre, $apellido, $email, $nombreUsuario, $password){
        $pdo = $this->crearConexion();
        
        $sql = 'INSERT INTO usuarios (nombre, apellido, email, nombre_usuario, password) 
                VALUES (?, ?, ?, ?, ?)';

        $query = $pdo->prepare($sql);
        try {
            $query->execute([$nombre, $apellido, $email, $nombreUsuario, $password]);
        } catch (\Throwable $th) {
            return null;
        }
    }

    
}

?>