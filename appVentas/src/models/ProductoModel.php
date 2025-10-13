<?php 
require_once("./src/config/Config.php");
require_once("./src/clases/Producto.php");
Class ProductoModel{
    
    function obtenerProductos(){
        $conexion = Config::Conectar();

        $sql = "SELECT * FROM productos";
        $stm = $conexion->prepare($sql);
        $stm ->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

}