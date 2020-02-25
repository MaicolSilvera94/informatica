<link rel="stylesheet" type="text/css" href="../servicio-tecnico/css/estilo.css">
<link rel="stylesheet" href="../servicio-tecnico/bower_components/bootstrap/dist/css/bootstrap.min.css">
<?php require '../conexion/conexion.php';?>
<?php
      $total = 0;
      if(isset($_POST['id'])){

          if($_POST['id'] > 0){

              $sql = "SELECT * FROM funcionarios WHERE id = " . $_POST['id'];
              $query = $connection->prepare($sql);
              $query->execute();
              $total = $query->rowCount();

          }

      }
      ?>

<div class="container">
  <div class="alert alert-danger">
    <strong>¡ERROR!</strong> Contraseña Incorrecta o No esta habilitado para Realizar Transferencias!!
    <a href="index.php" class="alert-link">Procesar Solicitud</a>
  </div>
</div>
