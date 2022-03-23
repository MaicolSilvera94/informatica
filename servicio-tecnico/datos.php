<?php
include '../conexion/conexion2.php';
$juzgados=$_POST['juzgados'];

	$sql="SELECT id,
			 juzgados,
			 despachos
		from juzgadodetransferencia
		where juzgados='$juzgados'";

	$result=mysqli_query($conexion,$sql);

	$cadena="<label>Juzgado de Destino:</label>
			<select id='lista2' name='juzgado' class='form-control input-lg' required>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
	}

	echo  $cadena."</select>";

?>
