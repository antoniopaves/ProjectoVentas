<?php 
require_once("./src/models/ProductoModel.php");
require_once("./src/clases/Producto.php");
Class ControllerProducto{

    function mostrarProductos(){
        $producto = new ProductoModel();
        $productos = $producto->obtenerProductos();
        include("./src/views/productos/viewProductos.php");
    }

    function viewNuevoProducto(){
        include("./src/views/productos/viewNuevoProducto.php");
    }

    function postNuevoProducto(){
        $producto = new Producto();
        
        $nombre=trim($_POST["nombre"]);
        $empresa=trim($_POST["empresa"]);
        $precio=trim($_POST["precio"]);
        $cantidad=trim($_POST["cantidad"]);
        $img=trim($_POST["img"]);

        if(empty($nombre) || empty($empresa) || empty($precio) || empty($cantidad) || empty($img)){
            echo "Por Favor complete todos los campos.";
            return 0;
        }else{
        $producto->nombre=$_POST["nombre"];
        $producto->empresa=$_POST["empresa"];
        $producto->precio=$_POST["precio"];
        $producto->cantidad=$_POST["cantidad"];
        $producto->img=$_POST["img"];

        $model = new ProductoModel();
        echo $model->insertarProducto($producto);
        }
    
    }

    function viewEditarProducto(){
        $id_producto = $_GET["id_producto"];
        $productoModel = new ProductoModel();
        $producto = $productoModel->buscarProductoPorId($id_producto);
        include("./src/views/productos/viewEditarProducto.php");
    }

    function buscarProductoID() {
    if (!isset($_POST["id_producto"]) || empty($_POST["id_producto"])) {
        die("Error: No se recibió ID del producto, Por Favor ingrese un ID Valido");
    }

    $id_producto = trim($_POST["id_producto"]);

    $model = new ProductoModel();
    $producto = $model->buscarProductoPorId($id_producto);

    if (!$producto) {
        echo ("Producto no encontrado");
    }

    if ($producto) {
        $productos = [$producto]; 
    } else {
        $productos = [];
    }


    include("./src/views/productos/viewProductos.php");
    }


    function EliminarProducto(){
        $id_producto=trim($_GET["id_producto"]);
        $model = new ProductoModel();
        echo $model->eliminarProducto($id_producto);
    }

    function postEditarProducto(){
        $producto = new Producto();
        
        $nombre=trim($_POST["nombre"]);
        $empresa=trim($_POST["empresa"]);
        $precio=trim($_POST["precio"]);
        $cantidad=trim($_POST["cantidad"]);
        $img=trim($_POST["img"]);

        if(empty($nombre) || empty($empresa) || empty($precio) || empty($cantidad) || empty($img)){
            echo "Por Favor complete todos los campos.";
            return 0;
        }else{

        $id_producto = $_POST["id_producto"];
        $producto = new Producto();
        $producto->nombre=$_POST["nombre"];
        $producto->empresa=$_POST["empresa"];
        $producto->precio=(int)$_POST["precio"];
        $producto->cantidad=(int)$_POST["cantidad"];
        $producto->img=$_POST["img"];

        $model = new ProductoModel();
        echo $model->editarProducto($producto,$id_producto);
        }

    }

    function viewCarro(){
        session_start();

        $productosCarro = [];
    
        if (isset($_SESSION["carrito"]) && count($_SESSION["carrito"]) > 0) {
            $model = new ProductoModel();

            foreach ($_SESSION["carrito"] as $id_producto => $cantidad) {
                $producto = $model->buscarProductoPorId($id_producto);
                if ($producto) {
                    $producto->cantidad_carrito = $cantidad; 
                    $productosCarro[] = $producto;
            }
        }
    }
        include("./src/views/productos/viewCarro.php");
    }



   function añadirCarro() {
    session_start(); 
    
    if (!isset($_GET["id_producto"])) {
        echo "No se recibió el ID del producto.";
        return;
    }

    $id_producto = trim($_GET["id_producto"]);

    
    if (!isset($_SESSION["carrito"])) {
        $_SESSION["carrito"] = [];
    }

    
    if (isset($_SESSION["carrito"][$id_producto])) {
        $_SESSION["carrito"][$id_producto]++; 
    } else {
        $_SESSION["carrito"][$id_producto] = 1;
    }

    echo "Producto con ID " . $id_producto . " añadido al carro.";
}
        

    function eliminarDelCarro() {
    session_start();
    if (!isset($_GET["id_producto"])) {
        echo "No se recibió el ID del producto.";
        return;
    }    

    $id_producto = trim($_GET["id_producto"]);

    if (isset($_SESSION["carrito"][$id_producto])) {
        unset($_SESSION["carrito"][$id_producto]);
        echo "Producto con ID " . $id_producto . " eliminado del carro.";
    } else {
        echo "El producto con ID " . $id_producto . " no está en el carro.";
        }
    }

    function eliminarUnoDelCarro() {
    session_start();
    if (!isset($_GET["id_producto"])) {
        echo "No se recibió el ID del producto.";
        return;
    }    

    $id_producto = trim($_GET["id_producto"]);

      if (isset($_SESSION["carrito"][$id_producto])) {
        $_SESSION["carrito"][$id_producto]--; 
    } else {
        $_SESSION["carrito"][$id_producto] = 0;
    }

    if (isset($_SESSION["carrito"][$id_producto])) {
        if ($_SESSION["carrito"][$id_producto] <= 0) {
            unset($_SESSION["carrito"][$id_producto]);
            echo "Producto con ID " . $id_producto . " eliminado del carro.";
        } else {
            echo "Se eliminó 1 unidad del producto con ID " . $id_producto . " del carro.";
        }
        echo "El producto con ID " . $id_producto . " no está en el carro.";
        }
    }
}