<?php
define("BASE_URL","/appVentas/index.php");
require_once("./src/controllers/ControllerProducto.php");

$controller = $_GET['controller'];
$action = $_GET['action'];

if(empty($controller)){
$controller = 'producto';
}

if(empty($action)){
$action = 'listar'
}

else{

$controller = new ControllerProducto();
$controller -> mostrarProductos();

}
