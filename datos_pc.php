<?php
include('config/conexion.php');
$provincia=$_POST['provincia'];
$sql="SELECT * from ciudades where provincia_id='$provincia' order by ciudad_nombre ASC";

$result=mysqli_query($con,$sql);

$cadena="  <label class='form_label' for='ciudades'>Ciudades:</label> <select id='listaciudad' class='form_input' name='ciudades'>";

	while ($ver=mysqli_fetch_array($result)) {
		$cadena=$cadena.'<option value='.$ver['ciudad_id'].'>'.utf8_encode($ver['ciudad_nombre']).'</option>';
	}

echo  $cadena."</select>";
?>
