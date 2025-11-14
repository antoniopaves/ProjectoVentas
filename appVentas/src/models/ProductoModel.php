<?php 
require_once("./src/config/Config.php");
require_once("./src/clases/Producto.php");
Class ProductoModel{
    function obtenerProductos(){
        $sql = "SELECT * FROM productos";
        $stm = Config::conectar()->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS,"Producto");
    }

    function insertarProducto($producto){
        $sql = "INSERT INTO productos (nombre, empresa, precio, cantidad, img) VALUES (:nombre,:empresa,:precio,:cantidad,:img)";
        $stm = Config::conectar()->prepare($sql);
        $stm->bindValue(":nombre",$producto->nombre,PDO::PARAM_STR);
        $stm->bindValue(":empresa",$producto->empresa,PDO::PARAM_STR);
        $stm->bindValue(":precio",$producto->precio,PDO::PARAM_STR);
        $stm->bindValue(":cantidad",$producto->cantidad,PDO::PARAM_STR);
        $stm->bindValue(":img",$producto->img,PDO::PARAM_STR);
        return $stm->execute();
    }

    function eliminarProducto($id_producto){
        $sql = "DELETE FROM productos WHERE id_producto=:id_producto";
        $stm = Config::conectar()->prepare($sql);
        $stm->bindValue(":id_producto",$id_producto,PDO::PARAM_INT);
        return $stm->execute();
    }

    function editarProducto(Producto $producto,$id_producto){
        $sql = "UPDATE productos SET nombre=:nombre, empresa=:empresa, precio=:precio, cantidad=:cantidad, img=:img WHERE id_producto = :id_producto";
        $stm = Config::conectar()->prepare($sql);
        $stm->bindValue(":nombre",$producto->nombre,PDO::PARAM_STR);
        $stm->bindValue(":empresa",$producto->empresa,PDO::PARAM_STR);
        $stm->bindValue(":precio",$producto->precio,PDO::PARAM_STR);
        $stm->bindValue(":cantidad",$producto->cantidad,PDO::PARAM_STR);
        $stm->bindValue(":img",$producto->img,PDO::PARAM_STR);
        $stm->bindValue(":id_producto",$id_producto,PDO::PARAM_INT);
        $stm->execute();
        return $stm->rowCount();
    }

    function buscarProductoPorId($id_producto){
        $sql = "SELECT * FROM productos WHERE id_producto = :id_producto";
        $stm = Config::conectar()->prepare($sql);
        $stm->bindValue(':id_producto',$id_producto,PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_OBJ);
            if (!$producto) {
                die("Producto no encontrado");
            }
        return $producto;
    }
}