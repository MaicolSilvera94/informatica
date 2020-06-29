<!--<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">-->
<?php
@session_start();
?>
<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
<?php
		include '../conexion/conexion3.php';
    $salida = "";

    $query = "SELECT * FROM servicios WHERE cedulaprocesado = ".$_SESSION['cedula']." ORDER By fechaprocesado DESC";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
      $query = "SELECT * FROM servicios WHERE cedulaprocesado = ".$_SESSION['cedula']." AND (id LIKE '%$q%' OR nombreapellido LIKE '%$q%' OR cedula LIKE '%$q%') ORDER By ID DESC";
    }
    $resultado = $conn->query($query);

   if ($resultado->num_rows>0) {
    	$salida.= "<table border=1 class='tabla_datos table table-bordered table-striped table-hover'>
            			<thead>
            				<tr id='titulo'>
                      <th>ID</th>
            					<th>CEDULA</th>
            					<th>FUNCIONARIO</th>
            					<th>FECHA SOLICITUD</th>
                      <th>SERVICIOS</th>
                      <th>FECHA PROCESADA</th>
        							<th>ESTADO</th>
											<th>VER</th>
            				</tr>
            			</thead>
          	    <tbody>";


          while ( $fila = $resultado->fetch_assoc() ) {
            $salida .= "<tr>" .
            "<td>{$fila['id']}</td>" .
            "<td>{$fila['cedula']}</td>" .
            "<td>{$fila['nombreapellido']}</td>" .
            "<td>{$fila['fecha_add']}</td>" .
            "<td>{$fila['sistemas']}{$fila['equipos']}{$fila['redes']}</td>" .
            "<td>{$fila['fechaprocesado']}</td>" .
            "<td>" . (
              0 == $fila['conformidad'] ?
              "<i class='fa fa-check text-green'>FINALIZADO</i>" :
              "<i class='fa fa-remove text-red'>PENDIENTE</i>"
            ) . "</td>" .
						"<td class='text-center' style='vertical-align:middle;'>
							<a class='btn btn-success btn-xs' href='ver_solicitud.php?id=".$fila['id']."'> <i class='fa fa-check-circle'></i></a>
						</td>".

            "</tr>";
          }
    	$salida.="</tbody></table>";
    }else{
    	$salida.="<div class='alert alert-warning col-md-12'>
		  						<strong>No se encontro ningun Registro</strong>
							  </div>";
    }
    echo $salida;
    $conn->close();
?>
