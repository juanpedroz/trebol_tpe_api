<?php

require_once 'conexion_db.php';

class MaterialModel{

    public function getMateriales(){
        $pdo = crearConexion();
        $sql = "select * from materiales";
        $query = $pdo->prepare($sql);
        $query->execute();
    
        $materiales = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $materiales;
    }

    public function detalleMaterial($id_material){
        $pdo = crearConexion();
        $sql = "SELECT * FROM materiales WHERE id_material = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id_material]);
    
        $detalleMaterial = $query->fetch(PDO::FETCH_OBJ);
    
        return $detalleMaterial;
    }

    public function confirmarCambios($material, $proveedor, $id_material){
        $pdo = crearConexion();
        
        $sql = 'UPDATE materiales SET material=?, proveedor=? WHERE id_material=?';

        $query = $pdo->prepare($sql);
        $query->execute([$material, $proveedor, $id_material]);
    }

    public function eliminarMaterial($id_material){
        $pdo = crearConexion();
        $sql = "DELETE FROM materiales WHERE id_material =?";
        $query = $pdo->prepare($sql);
        $query->execute([$id_material]);
    }

    public function cargarMaterial($material, $proveedor){
        $pdo = crearConexion();
        $sql = 'INSERT INTO materiales SET material =?, proveedor = ?';
        $query = $pdo->prepare($sql);
        $query->execute([$material, $proveedor]);
    }

}

?>