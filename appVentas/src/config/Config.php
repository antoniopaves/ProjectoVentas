<?php
Class Config{
    public static function conectar(){
        $sql = 'mysql:dbname=db-productos;host=localhost';
        $user = 'root';
        $password = '';
        return new PDO($sql, $user, $password);
    }
}