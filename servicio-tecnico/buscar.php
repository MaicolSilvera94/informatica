<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
<?php
	$servername = "localhost";
    $username = "root";
  	$password = "";
  	$dbname = "servdb";

	$conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }


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
    	$salida.="<div class='alert alert-warning'>
		  	<strong>¡Cuidado!</strong> No se encontro ningun Registro - Para mas informacion llame al 66660

			</div>";
    }


    echo $salida;

    $conn->close();



?>
