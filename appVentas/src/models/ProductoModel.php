<?php 
require_once("./src/config/Config.php");
require_once("./src/clases/Producto.php");
Class ProductoModel{
    function obtenerProductos(){
        $sql = "SELECT * FROM productos";
        $stm = Config::conectar()->prepare($sql);
        $stm ->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS, "Producto");
    }

}