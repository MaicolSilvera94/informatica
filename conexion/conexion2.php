<?php
  $servidor="localhost";
  $usuario="root";
  $password="";
  $db="servdb";
  $conexion=mysqli_connect($servidor,$usuario,$password,$db) or die(mysqli_error());
  mysqli_connect("SET NAMES 'utf8'");
 ?>
