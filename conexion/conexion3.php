<?php
$servername = "localhost";
  $username = "root";
  $password = "LANwen.2018";
  $dbname = "servdb";

$conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
      die("Conexión fallida: ".$conn->connect_error);
    }
 ?>
