<?php

require_once ('model.php');


class OpinionModel extends Model{
    //conexion a la db

    public function getOpiniones($page){
        $pdo = $this->crearConexion();
        $limit = 4;
        $offset = ($page-1)*$limit;
        $sql = "SELECT * FROM opiniones
                LIMIT $limit OFFSET $offset";
        $query = $pdo->prepare($sql);
        $query->execute();
    
        $opiniones = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $opiniones;
    }

    public function getOpinionesOrdenadas($campo,$sentido){
        $pdo = $this->crearConexion();

        $sql = "SELECT * FROM opiniones ORDER BY $campo $sentido";
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