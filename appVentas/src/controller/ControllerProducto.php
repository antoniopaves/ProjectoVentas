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
    
    $nombre   = trim($_POST["nombre"]);
    $empresa  = trim($_POST["empresa"]);
    $precio   = trim($_POST["precio"]);
    $cantidad = trim($_POST["cantidad"]);
    if(empty($nombre) || empty($empresa) || empty($precio) || empty($cantidad)){
        echo "Por Favor complete todos los campos.";
        return;
    }
    
    if(!isset($_FILES["img"]) || $_FILES["img"]["error"] !== 0){
        echo "Debe seleccionar una imagen válida.";
        return;
    }

    $nombreImg = $_FILES["img"]["name"];
    $tmpImg    = $_FILES["img"]["tmp_name"];

    $carpeta = "./src/img/";
    $nombreFinal = time() . "_" . $nombreImg;
    $rutaFinal   = $carpeta . $nombreFinal;

    if(!move_uploaded_file($tmpImg, $rutaFinal)){
        echo "Error al guardar la imagen.";
        return;
    }
    $producto->nombre   = $nombre;
    $producto->empresa  = $empresa;
    $producto->precio   = $precio;
    $producto->cantidad = $cantidad;
    $producto->img      = $nombreFinal;

    $model = new ProductoModel();
    $model->insertarProducto($producto);

    
    header("Location: " . BASE_URL . "?controller=ControllerProducto&action=mostrarProductos");
    exit();
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
        
        $id        = $_POST['id_producto'];
        $nombre    = trim($_POST["nombre"]);
        $empresa   = trim($_POST["empresa"]);
        $precio    = trim($_POST["precio"]);
        $cantidad  = trim($_POST["cantidad"]);
        $imgActual = $_POST['img_actual']; 

        if(empty($nombre) || empty($empresa) || empty($precio) || empty($cantidad)){
            echo "Por Favor complete todos los campos.";
            return;
        }

        $nombreFinal = $imgActual; 
        $carpeta     = "./src/img/";

    
        if(isset($_FILES["img"]) && $_FILES["img"]["error"] === 0){
            $nombreImg = $_FILES["img"]["name"];
            $tmpImg    = $_FILES["img"]["tmp_name"];
            $rutaFinal = $carpeta . $nombreImg;

            if(!file_exists($rutaFinal)){
                if(!move_uploaded_file($tmpImg, $rutaFinal)){
                    echo "Error al guardar la imagen.";
                    return;
                }
            }

            $nombreFinal = $nombreImg;

            
            if($imgActual !== $nombreImg && file_exists($carpeta . $imgActual)){
                unlink($carpeta . $imgActual);
            }
        }

        $producto->id_producto = $id;
        $producto->nombre      = $nombre;
        $producto->empresa     = $empresa;
        $producto->precio      = $precio;
        $producto->cantidad    = $cantidad;
        $producto->img         = $nombreFinal;

        $model = new ProductoModel();
        $model->editarProducto($producto, $id);

        header("Location: " . BASE_URL . "?controller=ControllerProducto&action=mostrarProductos");
        exit();
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

    //echo "Producto con ID " . $id_producto . " añadido al carro."; // util para debugging

    header("Location: " . BASE_URL . "?controller=ControllerProducto&action=mostrarProductos");
    exit();
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
        // echo "Producto con ID " . $id_producto . " eliminado del carro."; // util para debugging
    } else {
        // echo "El producto con ID " . $id_producto . " no está en el carro."; // util para debugging
        }
        header("Location: " . BASE_URL . "?controller=ControllerProducto&action=viewCarro");
        exit();
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
        // echo "El producto con ID " . $id_producto . " no está en el carro."; // util para debugging
        }
        header("Location: " . BASE_URL . "?controller=ControllerProducto&action=viewCarro");
        exit();
    }

    function Comprar() {
        session_start();
        if (!isset($_SESSION["carrito"]) || count($_SESSION["carrito"]) === 0) {
            echo "El carrito está vacío. No se puede completar la compra.";
            return;
        }
        $model = new ProductoModel();
        foreach ($_SESSION["carrito"] as $id_producto => $cantidad) {
            $filasAfectadas = $model->descontarStock($id_producto, $cantidad);
            if ($filasAfectadas === 0) {
                echo "No hay suficiente stock para el producto con ID " . $id_producto . ". Compra no completada.";
                return;
            }
        }
        unset($_SESSION["carrito"]);
        include("./src/views/productos/viewCompra.php");
    }

    
}