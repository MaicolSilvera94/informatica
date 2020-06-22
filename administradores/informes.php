<?php
session_start();
if( !isset($_SESSION['logueado']) ){
    header('Location:login.php');
}
//include('../funciones/funciones.php');
?>


<!DOCTYPE html>
<html lang="es_PY">
<head>
	<title>Informes</title>
  <meta name="theme-color" content="#1a2d90">
	<meta name="description" content="">
	<?php include '../includes/head.php'; ?>
  <link rel="stylesheet" href="dist/css/estilos.css">
</head>
<body>
	<!-- Inicio encabezado del sitio -->
	<?php include 'includes/header.php'; ?>
	<!-- Fin encabezado del sitio -->

	<!-- Inicio cuerpo del sitio -->
	<main>


		<!-- INICIO SECTION TEAM -->
      <section class="section-team">
        <div class="container">
          <h3 class="title">Lista de Servicios Tecnicos Procesados por <?php echo $_SESSION['usuario'];?> <?php echo $_SESSION['apellido']; ?></h3>
          <div class="row">
            <div class="infobuscar col-xs-3">
              <input name="caja_busqueda" id="caja_busqueda" type="text" class="buscar form-control" placeholder="BUSCAR" />
            </div>
          </div>
          <div id="datos" class="tab panel">
          </div>
        </div>

      </section>
<!--****************************************************************************************************************************-->
<section class="section-team">
  <div class="container">
    <h3 class="title">CANTIDAD DE SERVICIOS REALIZADOS POR <?php echo $_SESSION['usuario'];?> <?php echo $_SESSION['apellido']; ?></h3>


    <div class="row">
      <div class="col-sm-4">
        <div class="box-teamb">
          <h4>SERVICIOS DE EQUIPOS</h4>
          <a class="bg-a">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos = 'montaje' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Montaje: ' .$row['quantity'] ;
            ?>
          </a>

          <a class="bg-b">
              <?php
               include '../conexion/conexion.php';
               $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos = 'configuracion' and cedulaprocesado = ".$_SESSION['cedula'];
               $stmt = $connection->prepare($sql);
               $stmt->execute();
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
               echo ' Configuracion: ' .$row['quantity'] ;
              ?>
          </a>

          <a class="bg-a">
              <?php
               include '../conexion/conexion.php';
               $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos = 'verificacion' and cedulaprocesado = ".$_SESSION['cedula'];
               $stmt = $connection->prepare($sql);
               $stmt->execute();
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
               echo ' Verificacion: ' .$row['quantity'] ;
              ?>
          </a>
          <a class="bg-b">
              <?php
               include '../conexion/conexion.php';
               $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos = 'instalacion de software' and cedulaprocesado = ".$_SESSION['cedula'];
               $stmt = $connection->prepare($sql);
               $stmt->execute();
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
               echo ' Instalacion de Software: ' .$row['quantity'] ;
              ?>
          </a>
          <a class="bg-a">
              <?php
               include '../conexion/conexion.php';
               $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos = 'mantenimeito' and cedulaprocesado = ".$_SESSION['cedula'];
               $stmt = $connection->prepare($sql);
               $stmt->execute();
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
               echo ' Mantenimieto: ' .$row['quantity'] ;
              ?>
          </a>
          <a class="bg-b">
              <?php
               include '../conexion/conexion.php';
               $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos = 'otros' and cedulaprocesado = ".$_SESSION['cedula'];
               $stmt = $connection->prepare($sql);
               $stmt->execute();
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
               echo ' Otros: ' .$row['quantity'] ;
              ?>
          </a>
          <a class="bg-a">
              <?php
               include '../conexion/conexion.php';
               $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos != '' and cedulaprocesado = ".$_SESSION['cedula'];
               $stmt = $connection->prepare($sql);
               $stmt->execute();
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
               echo ' Total: ' .$row['quantity'] ;
              ?>
          </a>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="box-teamb">
          <h4>SERVICIOS DE SISTEMAS</h4>
          <a class="bg-a">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas = 'creacion de usuario' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Creacion de Usuario: ' .$row['quantity'] ;
            ?>
          </a>

          <a class="bg-b">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas = 'cambio/reseteo de contraseña' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Cambio/Reseteo de Contraseña: ' .$row['quantity'] ;
            ?>
          </a>

          <a class="bg-a">
              <?php
               include '../conexion/conexion.php';
               $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas = 'deshabilitacion de usuario' and cedulaprocesado = ".$_SESSION['cedula'];
               $stmt = $connection->prepare($sql);
               $stmt->execute();
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
               echo ' Deshabilitacion de Usuario: ' .$row['quantity'] ;
              ?>
          </a>
          <a class="bg-b">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas = 'instalación de sistema' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Instalacion de Sistema: ' .$row['quantity'] ;
            ?>
          </a>
          <a class="bg-a">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas = 'actualización de sistema' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Actualizacion de Sistema: ' .$row['quantity'] ;
            ?>
          </a>
          <a class="bg-b">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas = 'otros' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Otros: ' .$row['quantity'] ;
            ?>
          </a>
          <a class="bg-a">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas != '' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Total: ' .$row['quantity'] ;
            ?>
          </a>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="box-teamb">
          <h4>SERVICIOS DE REDES</h4>
          <a class="bg-a">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes = 'creacion de usuario' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Creacion de Usuario: ' .$row['quantity'] ;
            ?>
          </a>

          <a class="bg-b">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes = 'cambio/reseteo de clave' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Cambio/Reseteo de Contraseña: ' .$row['quantity'] ;
            ?>
          </a>

          <a class="bg-a">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes = 'deshabilitacion de usuario' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Deshabilitacion de Usuario: ' .$row['quantity'] ;
            ?>
          </a>
          <a class="bg-b">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes = 'configuracion de red' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Instalacion de Sistema: ' .$row['quantity'] ;
            ?>
          </a>
          <a class="bg-a">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes = 'compartir recursos de red' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Actualizacion de Sistema: ' .$row['quantity'] ;
            ?>
          </a>
          <a class="bg-b">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes = 'otros' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Otros: ' .$row['quantity'] ;
            ?>
          </a>
          <a class="bg-a">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes != '' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Total: ' .$row['quantity'] ;
            ?>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>











<!--****************************************************************************************************************************-->

				<section class="section-team">
					<div class="container">
            <!--<div class="boxinfo col-md-4">
              <h4>INFORME DE SERVICIOS DE EQUIPOS</h4>
              <div class="col-md-12">
                <?php
                 /*include '../conexion/conexion.php';
                 $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos = 'montaje' and cedulaprocesado = ".$_SESSION['cedula'];
                 $stmt = $connection->prepare($sql);
                 $stmt->execute();
                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 echo ' Montaje: ' .$row['quantity'] ;
                ?>
              </div>
              <div class="col-md-12">
                <?php
                 include '../conexion/conexion.php';
                 $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos = 'configuracion' and cedulaprocesado = ".$_SESSION['cedula'];
                 $stmt = $connection->prepare($sql);
                 $stmt->execute();
                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 echo ' Configuracion: ' .$row['quantity'] ;
                ?>
              </div>
              <div class="col-md-12">
                <?php
                 include '../conexion/conexion.php';
                 $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos = 'verificacion' and cedulaprocesado = ".$_SESSION['cedula'];
                 $stmt = $connection->prepare($sql);
                 $stmt->execute();
                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 echo ' Verificacion: ' .$row['quantity'] ;
                ?>
              </div>
              <div class="col-md-12">
                <?php
                 include '../conexion/conexion.php';
                 $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos = 'instalacion de software' and cedulaprocesado = ".$_SESSION['cedula'];
                 $stmt = $connection->prepare($sql);
                 $stmt->execute();
                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 echo ' Instalacion de Software: ' .$row['quantity'] ;
                ?>
              </div>
              <div class="col-md-12">
                <?php
                 include '../conexion/conexion.php';
                 $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos = 'mantenimeito' and cedulaprocesado = ".$_SESSION['cedula'];
                 $stmt = $connection->prepare($sql);
                 $stmt->execute();
                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 echo ' Mantenimieto: ' .$row['quantity'] ;
                ?>
              </div>
              <div class="col-md-12">
                <?php
                 include '../conexion/conexion.php';
                 $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos = 'otros' and cedulaprocesado = ".$_SESSION['cedula'];
                 $stmt = $connection->prepare($sql);
                 $stmt->execute();
                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 echo ' Otros: ' .$row['quantity'] ;
                ?>
              </div>
              <div class="col-md-12">
                <?php
                 include '../conexion/conexion.php';
                 $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE equipos != '' and cedulaprocesado = ".$_SESSION['cedula'];
                 $stmt = $connection->prepare($sql);
                 $stmt->execute();
                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 echo ' Total: ' .$row['quantity'] ;
                ?>
              </div>
            </div>-->

              <!--<div class="boxinfo col-md-4">
                <h4>INFORME DE SERVICIOS DE SISTEMAS</h4>
                <div class="col-md-12">
                  <?php
                   include '../conexion/conexion.php';
                   $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas = 'creacion de usuario' and cedulaprocesado = ".$_SESSION['cedula'];
                   $stmt = $connection->prepare($sql);
                   $stmt->execute();
                   $row = $stmt->fetch(PDO::FETCH_ASSOC);
                   echo ' Creacion de Usuario: ' .$row['quantity'] ;
                  ?>
                </div>
                <div class="col-md-12">
                  <?php
                   include '../conexion/conexion.php';
                   $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas = 'cambio/reseteo de contraseña' and cedulaprocesado = ".$_SESSION['cedula'];
                   $stmt = $connection->prepare($sql);
                   $stmt->execute();
                   $row = $stmt->fetch(PDO::FETCH_ASSOC);
                   echo ' Cambio/Reseteo de Contraseña: ' .$row['quantity'] ;
                  ?>
                </div>
                <div class="col-md-12">
                  <?php
                   include '../conexion/conexion.php';
                   $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas = 'deshabilitacion de usuario' and cedulaprocesado = ".$_SESSION['cedula'];
                   $stmt = $connection->prepare($sql);
                   $stmt->execute();
                   $row = $stmt->fetch(PDO::FETCH_ASSOC);
                   echo ' Deshabilitacion de Usuario: ' .$row['quantity'] ;
                  ?>
                </div>
                <div class="col-md-12">
                  <?php
                   include '../conexion/conexion.php';
                   $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas = 'instalación de sistema' and cedulaprocesado = ".$_SESSION['cedula'];
                   $stmt = $connection->prepare($sql);
                   $stmt->execute();
                   $row = $stmt->fetch(PDO::FETCH_ASSOC);
                   echo ' Instalacion de Sistema: ' .$row['quantity'] ;
                  ?>
                </div>
                <div class="col-md-12">
                  <?php
                   include '../conexion/conexion.php';
                   $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas = 'actualización de sistema' and cedulaprocesado = ".$_SESSION['cedula'];
                   $stmt = $connection->prepare($sql);
                   $stmt->execute();
                   $row = $stmt->fetch(PDO::FETCH_ASSOC);
                   echo ' Actualizacion de Sistema: ' .$row['quantity'] ;
                  ?>
                </div>
                <div class="col-md-12">
                  <?php
                   include '../conexion/conexion.php';
                   $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas = 'otros' and cedulaprocesado = ".$_SESSION['cedula'];
                   $stmt = $connection->prepare($sql);
                   $stmt->execute();
                   $row = $stmt->fetch(PDO::FETCH_ASSOC);
                   echo ' Otros: ' .$row['quantity'] ;
                  ?>
                </div>
                <div class="col-md-12">
                  <?php
                   include '../conexion/conexion.php';
                   $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE sistemas != '' and cedulaprocesado = ".$_SESSION['cedula'];
                   $stmt = $connection->prepare($sql);
                   $stmt->execute();
                   $row = $stmt->fetch(PDO::FETCH_ASSOC);
                   echo ' Total: ' .$row['quantity'] ;
                  ?>
                </div>
              </div>-->
                <!--<div class="boxinfo col-md-4">
                  <h4>INFORME DE SERVICIOS DE REDES</h4>
                  <div class="col-md-12">
                    <?php
                     include '../conexion/conexion.php';
                     $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes = 'creacion de usuario' and cedulaprocesado = ".$_SESSION['cedula'];
                     $stmt = $connection->prepare($sql);
                     $stmt->execute();
                     $row = $stmt->fetch(PDO::FETCH_ASSOC);
                     echo ' Creacion de Usuario: ' .$row['quantity'] ;
                    ?>
                  </div>
                  <div class="col-md-12">
                    <?php
                     include '../conexion/conexion.php';
                     $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes = 'cambio/reseteo de clave' and cedulaprocesado = ".$_SESSION['cedula'];
                     $stmt = $connection->prepare($sql);
                     $stmt->execute();
                     $row = $stmt->fetch(PDO::FETCH_ASSOC);
                     echo ' Cambio/Reseteo de Contraseña: ' .$row['quantity'] ;
                    ?>
                  </div>
                  <div class="col-md-12">
                    <?php
                     include '../conexion/conexion.php';
                     $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes = 'deshabilitacion de usuario' and cedulaprocesado = ".$_SESSION['cedula'];
                     $stmt = $connection->prepare($sql);
                     $stmt->execute();
                     $row = $stmt->fetch(PDO::FETCH_ASSOC);
                     echo ' Deshabilitacion de Usuario: ' .$row['quantity'] ;
                    ?>
                  </div>
                  <div class="col-md-12">
                    <?php
                     include '../conexion/conexion.php';
                     $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes = 'configuracion de red' and cedulaprocesado = ".$_SESSION['cedula'];
                     $stmt = $connection->prepare($sql);
                     $stmt->execute();
                     $row = $stmt->fetch(PDO::FETCH_ASSOC);
                     echo ' Instalacion de Sistema: ' .$row['quantity'] ;
                    ?>
                  </div>
                  <div class="col-md-12">
                    <?php
                     include '../conexion/conexion.php';
                     $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes = 'compartir recursos de red' and cedulaprocesado = ".$_SESSION['cedula'];
                     $stmt = $connection->prepare($sql);
                     $stmt->execute();
                     $row = $stmt->fetch(PDO::FETCH_ASSOC);
                     echo ' Actualizacion de Sistema: ' .$row['quantity'] ;
                    ?>
                  </div>
                  <div class="col-md-12">
                    <?php
                     include '../conexion/conexion.php';
                     $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes = 'otros' and cedulaprocesado = ".$_SESSION['cedula'];
                     $stmt = $connection->prepare($sql);
                     $stmt->execute();
                     $row = $stmt->fetch(PDO::FETCH_ASSOC);
                     echo ' Otros: ' .$row['quantity'] ;
                    ?>
                  </div>
                  <div class="col-md-12">
                    <?php
                     include '../conexion/conexion.php';
                     $sql = "SELECT COUNT(id) as quantity FROM servicios WHERE redes != '' and cedulaprocesado = ".$_SESSION['cedula'];
                     $stmt = $connection->prepare($sql);
                     $stmt->execute();
                     $row = $stmt->fetch(PDO::FETCH_ASSOC);
                     echo ' Total: ' .$row['quantity'] ;
                    ?>
                  </div>
                </div>
                  <div class="boxinfo col-md-4">
                    <h4>INFORME DE GESTION DE EXPEDIENTES</h4>
                    <div class="col-md-12">
                      <?php
                       include '../conexion/conexion.php';
                       $sql = "SELECT COUNT(id) as quantity FROM transferencias WHERE tipo = 'Transferencia Penal' and cedulaprocesado = ".$_SESSION['cedula'];
                       $stmt = $connection->prepare($sql);
                       $stmt->execute();
                       $row = $stmt->fetch(PDO::FETCH_ASSOC);
                       echo ' Tranferencia Penal: ' .$row['quantity'];
                      ?>
                    </div>
                    <div class="col-md-12">
                      <?php
                       include '../conexion/conexion.php';
                       $sql = "SELECT COUNT(id) as quantity FROM transferencias WHERE tipo = 'transferencia no penal' and cedulaprocesado = ".$_SESSION['cedula'];
                       $stmt = $connection->prepare($sql);
                       $stmt->execute();
                       $row = $stmt->fetch(PDO::FETCH_ASSOC);
                       echo ' Transferencia no Penal: ' .$row['quantity'];
                      ?>
                    </div>
                    <div class="col-md-12">
                      <?php
                       include '../conexion/conexion.php';
                       $sql = "SELECT COUNT(id) as quantity FROM transferencias WHERE tipo = 'activacion de expediente' and cedulaprocesado = ".$_SESSION['cedula'];
                       $stmt = $connection->prepare($sql);
                       $stmt->execute();
                       $row = $stmt->fetch(PDO::FETCH_ASSOC);
                       echo ' Activacion de Expediente: ' .$row['quantity'];
                      ?>
                    </div>
                    <div class="col-md-12">
                      <?php
                       include '../conexion/conexion.php';
                       $sql = "SELECT COUNT(id) as quantity FROM transferencias WHERE tipo != '' and cedulaprocesado = ".$_SESSION['cedula'];
                       $stmt = $connection->prepare($sql);
                       $stmt->execute();
                       $row = $stmt->fetch(PDO::FETCH_ASSOC);
                       echo ' Total: ' .$row['quantity'];*/
                      ?>
                    </div>
                    </div>
					</div>
				</section>-->

 </main>

 <script type="text/javascript" src="js/jquery.min.js"></script>
 <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
