<?php
@session_start();
include('../conexion/conexion.php');

if(isset($_POST)){

    if( $_POST['cedula'] != '' && $_POST['password'] != ''){
      $cedula = $_POST['cedula'];
      $password = $_POST['password'];


      $sql = "SELECT * FROM usuarios WHERE cedula = '$cedula' AND password = '$password' AND activo = 1";
      $query = $connection->prepare($sql);
      $query->execute();

      if($query->rowCount() > 0) {

        foreach ($query->fetchAll() as $fila) {
           $_SESSION['logueado'] = 'logueado';
           $_SESSION['usuario_id'] = $fila['id'];
           $_SESSION['usuario'] = $fila['nombre'];
           $_SESSION['apellido'] = $fila['apellido'];
           $_SESSION['cargo'] = $fila['cargo'];
           $_SESSION['dependencia'] = $fila['dependencia'];
           $_SESSION['avatar'] = $fila['avatar'];
           $_SESSION['fecha_add'] = $fila['fecha_add'];
           $_SESSION['password'] = $fila['password'];
           $_SESSION['cedula'] = $fila['cedula'];
           $_SESSION['rol'] = $fila['rol'];
           header('Location:index2.php');
        }
      } else {
        $mensaje = '<p class="alert alert-danger">Datos Incorrectos! o Cuenta Desactivada!</p>';
      }
   }
}
?>
<?php include 'includes/mensajes.php';?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Informatica | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>INFORMÁTICA PJAP</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicia sesión para comenzar</p>
    <form action="login.php" method="POST" >
      <div class="form-group has-feedback">
        <input type="name" name="cedula" required class="form-control" placeholder="Cedula">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" required class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
         <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
