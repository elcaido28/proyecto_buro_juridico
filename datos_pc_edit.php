<?php
include('config/conexion.php');
$provincia=$_POST['provincia'];
$ciudad=$_POST['ciudad'];
$sql="SELECT * from ciudades where provincia_id='$provincia' order by ciudad_nombre ASC";

$result=mysqli_query($con,$sql);

$cadena="  <label class='form_label' for='ciudades'>Ciudades:</label> <select id='listaciudad' class='form_input' name='ciudades'>";

	while ($ver=mysqli_fetch_array($result)) {
    if($ciudad==$ver['ciudad_id']){$sel="selected='selected'";}else{$sel="";}
		$cadena=$cadena.'<option '.$sel.' value='.$ver['ciudad_id'].'>'.utf8_encode($ver['ciudad_nombre']).'</option>';
	}

echo  $cadena."</select>";
?>
