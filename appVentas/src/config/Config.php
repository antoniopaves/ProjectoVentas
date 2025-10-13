<?php
Class Config{
    public static function Conectar(){
        $mysql = 'mysql:dbname=db-productos;host=localhost';
        $user = 'root';
        $password = '';
        return new PDO($mysql, $user, $password);
    }
}