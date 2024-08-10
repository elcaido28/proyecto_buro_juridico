<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=1;


	$nombres = $_POST["nombres"];
	$apellidos = $_POST["apellidos"];
	$cedula = $_POST["cedula"];
	$genero = $_POST["genero"];
	$correo = $_POST["correo"];
	$telefono = $_POST["telefono"];
	$direccion = $_POST["direccion"];
	$estado_civil = $_POST["estado_civil"];
	$tipo_cliente = $_POST["tipo_cliente"];
	$estado = "1";
	// CLAVE ALEATORIA
	$charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	$cad = "";
	for($p=0;$p<10;$p++){
		$cad .= substr($charset, rand(0, 62), 1);
	}
	$clave = $cad;
	// FIN CLAVE ALEATORIA
	include('../ENVIAR_CORREOS/env_pass_cli_correo.php');

	$consulta=mysqli_query($con,"INSERT INTO clientes (fecha, cedula, nombres, apellidos, id_genero, id_estado_civil, correo, telefono, direccion,clave, id_estado, id_tipo_cliente) VALUES
	('$fecha', '$cedula', '$nombres', '$apellidos', '$genero', '$estado_civil', '$correo', '$telefono', '$direccion','$clave', '$estado', '$tipo_cliente')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_clientes.php");

?>
