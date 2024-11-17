<?php

class MaterialModel extends Model{

    public function getMateriales($page){
        $pdo = $this->crearConexion();//LIMIT 2 OFFSET 2"
        $elementos = $this->getCount("materiales");
        $limit = 4;
        $elementos = get_object_vars($elementos); //transformo en array
        $cantpage = intval(($elementos["count(*)"])/$limit)+1;//obtengo cantidad de paginas
        $offset = ($page-1)*$limit;
        if ($page<=$cantpage){
            $sql = "SELECT * FROM materiales
                    LIMIT $limit OFFSET $offset";
            $query = $pdo->prepare($sql);
            $query->execute();
            $materiales = $query->fetchAll(PDO::FETCH_OBJ);
            return $materiales;
        }
        return null;
    }

    public function getMaterialesOrdenados ($campo,$sentido){
        $pdo = $this->crearConexion();
        if (!$this->existeCampo("materiales", $campo))
            return null;
        if (($sentido != "asc") && ($sentido != "desc"))
            return null;
        $sql = "SELECT * FROM materiales ORDER BY $campo $sentido";
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