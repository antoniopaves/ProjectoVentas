<?php 
require_once("./src/models/ProductoModel.php");
Class ControllerProducto{
    public static function mostrarProductos(){
        $producto = new ProductoModel();
        $productos = $producto->obtenerProductos();
        
        require_once("./src/views/productos/viewProductos.php");
    }


}