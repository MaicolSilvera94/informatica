<?php require '../conexion/conexion.php';?>
<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <!--<div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>-->
        <div class="pull-left info">
          <p><?php if (isset($_SESSION['usuario'])) {
          echo $_SESSION['usuario'];
          } ?></p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">

        <li class="active"><a href="usuarioadmin.php">
          <i class="fa fa-home"></i> <span>Inicio</span></a>
        </li>


        <li>
          <a href="conformidad.php"><i class="fa fa-link"></i> <span>Pendientes de Conformidad</span></a>
        </li>

        <li>
          <a href="listsolicitud.php"><i class="fa fa-link"></i> <span>Pendientes de Procesamiento</span></a>
        </li>
        <li>
          <a href="listprocesados.php"><i class="fa fa-link"></i> <span>Solicitud Procesados</span></a>
        </li>
        <li>
          <a href="usuarios_edit.php"><i class="fa fa-link"></i> <span>Actualizaion de Datos</span></a>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
