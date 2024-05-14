<?php
    $server = 'db';
    $username = 'root';
    $password = '';
    $database  = 'betan';

    try{
        $conn = new  PDO("mysql:host=$server;dbname=$database;", $username, $password);

    }catch(PDOException $e){
        die('Conexion fallidaaaa: ' .$e->getMessage());
    }
?>