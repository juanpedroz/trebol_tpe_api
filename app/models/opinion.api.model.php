<?php

require_once ('model.php');


class OpinionModel extends Model{
    //conexion a la db

    public function getOpiniones(){
        $pdo = $this->crearConexion();

        $sql = "SELECT a.*, b.*
                FROM opiniones a
                INNER JOIN productos b
                ON a.id_producto = b.id_producto";
        $query = $pdo->prepare($sql);
        $query->execute();
    
        $opiniones = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $opiniones;
    }

    public function getOpinion($id){
        $pdo = $this->crearConexion();
        $sql = "SELECT * FROM opiniones WHERE id_opinion = ?" ;
        $query = $pdo->prepare($sql);
        $query->execute([$id]);

        $opinion = $query->fetch(PDO::FETCH_OBJ);

        return $opinion;
    }

    
    public function crearOpinion($calificacion, $comentario, $id_usuarios, $id_producto ){
        $pdo = $this->crearConexion();
        $sql = 'INSERT INTO opiniones SET calificacion=?, comentario=?, id_usuarios=?, id_producto=?';

        $query = $pdo->prepare($sql);
        $query->execute([$calificacion, $comentario, $id_usuarios, $id_producto ]);
    }

    public function eliminarOpinion($id){
        $pdo = $this->crearConexion();
        $sql = "DELETE FROM opiniones WHERE id_opinion =?";
        $query = $pdo->prepare($sql);
        $query->execute([$id]);
    }

    public function modificarOpinion($calificacion,$comentario, $id){
        $pdo = $this->crearConexion();
        
        $sql = 'UPDATE opiniones SET calificacion=?, comentario=? WHERE id_opinion=? ';

        $query = $pdo->prepare($sql);
        $query->execute([$calificacion,$comentario, $id]);
    }
}