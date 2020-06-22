<link rel="stylesheet" href="../servicio-tecnico/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../servicio-tecnico/bower_components/font-awesome/css/font-awesome.min.css">
<?php
		include '../conexion/conexion3.php';
    $salida = "";

    $query = "SELECT * FROM funcionarios ORDER By id LIMIT 1";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM funcionarios WHERE id LIKE '%$q%' OR nombre LIKE '%$q%' OR cedula LIKE '%$q%'  ";
    }

    $resultado = $conn->query($query);

   if ($resultado->num_rows>0) {
    	$salida.= "<table border=1 class='tabla_datos'>
    			<thead>
    				<tr id='titulo'>
    					<td>CEDULA</td>
    					<td>NOMBRE</td>
    					<td>CARGO</td>
    					<td>DEPENDENCIA</td>
							<td class='text-center' width='10%'>
              <i class='fa fa-cogs'></i>
            </th>
    				</tr>
    			</thead>


    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td>".$fila['cedula']."</td>
    					<td>".$fila['nombre']."</td>
    					<td>".$fila['cargo']."</td>
    					<td>".$fila['dependencia']."</td>
							<td class='text-center' style='vertical-align:middle;'>
							<a class='btn btn-success btn-xs' href='tipo_solicitud.php?id=".$fila['id']."'> <i class='fa fa-check-circle'></i></a>

            </td>
    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }else{
			$salida.="<div class='alert alert-warning col-md-12'>
		  						<strong>No se encontro ningun Registro!!</strong>
							  </div>";
    }


    echo $salida;

    $conn->close();



?>
