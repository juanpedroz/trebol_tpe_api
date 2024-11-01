<?php

require_once ('model.php');

class ProductoModel extends Model{
    //conexion a la db

    public function getProductos(){
        $pdo = $this->crearConexion();

        $sql = "SELECT a.*, b.*
                FROM productos a
                INNER JOIN materiales b
                ON a.id_material = b.id_material";
        $query = $pdo->prepare($sql);
        $query->execute();
    
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $productos;
    }
}