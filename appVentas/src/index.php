<?php
define("BASE_URL","/appVentas/index.php");
require_once("./src/controllers/ControllerProducto.php");

$controller = $_GET['controller'];
$action = $_GET['action'];

if(empty($view) || empty($action)){

    

}
else{

$controller = new ControllerProducto();
$controller -> obtenerProducto();

}
