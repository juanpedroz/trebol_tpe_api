<?php

require_once ('model.php');

class ProductoModel extends Model{
    //conexion a la db

    public function getProductos($page){
        $pdo = $this->crearConexion();//LIMIT 2 OFFSET 2"
        $limit = 4;
        $offset = ($page-1)*$limit;
        $sql = "SELECT a.*, b.*
                FROM productos a
                INNER JOIN materiales b
                ON a.id_material = b.id_material
                LIMIT $limit OFFSET $offset";
        $query = $pdo->prepare($sql);
        $query->execute();
    
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $productos;
    }

    public function getProductosCategoria($id_material){
        $pdo = $this->crearConexion();
        $sql = "select * from productos where id_material = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id_material]);
    
        $productos = $query->fetchAll(PDO::FETCH_OBJ);

        return $productos;

    }

    public function getProductosOrdenados($campo,$sentido){
        $pdo = $this->crearConexion();

        $sql = "SELECT a.*, b.*
                FROM productos a
                INNER JOIN materiales b
                ON a.id_material = b.id_material
                ORDER BY $campo $sentido";
        $query = $pdo->prepare($sql);
        $query->execute();
    
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $productos;
    }

    public function detalleProducto($id){
        
        $pdo = $this->crearConexion();

        $sql = "select * from productos  where id_producto = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id]);
    
        $producto = $query->fetch(PDO::FETCH_OBJ);

        return $producto; 

    }

    public function eliminarProducto($producto){
        $pdo = $this->crearConexion();
        $sql = "DELETE FROM productos WHERE id_producto =?";
        $query = $pdo->prepare($sql);
        $query->execute([$producto]);
    }

    public function guardarCambios($nombre, $precio, $descripcion, $imagen, $material, $id_producto){
        $pdo = $this->crearConexion();
        
        $sql = 'UPDATE productos SET nombre=?, precio=?, descripcion=?, imagen=?, id_material=? WHERE id_producto=?';

        $query = $pdo->prepare($sql);
        $query->execute([$nombre, $precio, $descripcion, $imagen, $material, $id_producto]);
    }

    public function cargarProducto($nombre, $precio, $descripcion, $imagen, $material){
        $pdo = $this->crearConexion();
        
        $sql = 'INSERT INTO productos SET nombre=?, precio=?, descripcion=?, imagen=?, id_material=? ';

        $query = $pdo->prepare($sql);
        $query->execute([$nombre, $precio, $descripcion, $imagen, $material]);
    }

    public function guardarProducto($nombre,$precio, $descripcion, $imagen, $material, $id){
        $pdo = $this->crearConexion();

        $sql = 'UPDATE productos SET nombre=?, precio=?, descripcion=?, imagen=?, id_material=?  WHERE id_producto = ?';

        $query = $pdo->prepare($sql);
        try {
            $nuevoProducto = 
            $query->execute([$nombre,$precio, $descripcion, $imagen, $material, $id]);
        } catch (\Throwable $th) {
            return null;
        }
    }
   
    
}

?>