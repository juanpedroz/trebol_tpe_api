<?php

class MaterialModel extends Model{

    public function getMateriales(){
        $pdo = $this->crearConexion();
        $sql = "select * from materiales";
        $query = $pdo->prepare($sql);
        $query->execute();
    
        $materiales = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $materiales;
    }

    public function detalleMaterial($id_material){
        $pdo = $this->crearConexion();
        $sql = "SELECT * FROM materiales WHERE id_material = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id_material]);
    
        $detalleMaterial = $query->fetch(PDO::FETCH_OBJ);
    
        return $detalleMaterial;
    }

    public function modificarMaterial($material, $proveedor, $id_material){
        $pdo = $this->crearConexion();
        
        $sql = 'UPDATE materiales SET material=?, proveedor=? WHERE id_material=?';

        $query = $pdo->prepare($sql);
        $query->execute([$material, $proveedor, $id_material]);
    }

    public function eliminarMaterial($id_material){
        $pdo = $this->crearConexion();
        $sql = "DELETE FROM materiales WHERE id_material =?";
        $query = $pdo->prepare($sql);
       

        try {
            $query->execute([$id_material]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function cargarMaterial($material, $proveedor){
        $pdo = $this->crearConexion();
        $sql = 'INSERT INTO materiales SET material =?, proveedor = ?';
        $query = $pdo->prepare($sql);
        $query->execute([$material, $proveedor]);
    }

}

?>