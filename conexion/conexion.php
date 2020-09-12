<?php
    $user = 'root';
    $password = '';
    $host = 'localhost';
    $dbname = 'servdb';
    $parametros = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
    try {
        $connection = new PDO("mysql:host=$host;dbname=$dbname;", $user, $password, $parametros);
    } catch(PDOException $e){
        echo $e->getMessage();
    }
?>

