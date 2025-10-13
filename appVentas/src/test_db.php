<?php
require_once("./config/Config.php");

try {
    $db = Config::conectar();
    echo "1";
} catch (Exception $e) {
    echo "0" . $e->getMessage();
}
