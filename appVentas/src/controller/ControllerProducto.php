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
        
    
}