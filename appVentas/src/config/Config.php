<?php
Class Config{
    public static function conectar(){
        $sql = 'mysql:dbname=db-productos;host=localhost';
        $user = 'root';
        $password = '';
        try {
        $conection = new PDO($sql, $user, $password);
        return $conection;
            } catch (PDOException $e){
                error_log("Error DB: " . $e->getMessage());
                die ("Error de conexion");
            }



    }
}