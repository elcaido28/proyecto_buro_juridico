<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=1;

  $id=$_REQUEST['id'];
	$abogado = $_POST["abogado"];

	$consulta=mysqli_query($con,"INSERT INTO asig_caso_abogado (fecha, id_empleados,id_casos_juridicos) VALUES ('$fecha','$abogado','$id')") or die ("error".mysqli_error());

$ingreso=mysqli_query($con,"UPDATE casos_juridicos SET id_abg_ayudante='$abogado' where id_casos_juridicos='$id' ") or die ("error".mysqli_error());
	mysqli_close($con);
	header("Location:../buscar_caso_juridico.php");

?>
