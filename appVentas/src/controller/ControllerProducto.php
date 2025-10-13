<?php 
require_once("../src/models/ProductoModel.php");
Class ControllerProducto{
    public static function mostrarProductos(){
        $productoModel = new ProductoModel();
        $producto = $productoModel->obtenerProductos();
        
        require_once("../src/views/productos/viewProductos.php");
    }


}