<?php
	session_start();
	include ("../config/conexion.php");

	$id = $_REQUEST["id"];
	$_SESSION['confirmar']=1;

	$usuario = $_POST["usuario"];
	$clave = $_POST["clave"];

	$configuracion= $_POST["configuracion"];
	$registrar= $_POST["registrar"];
	$cotizacion= $_POST["cotizacion"];
	$judiciales= $_POST["judiciales"];
	$cuentas= $_POST["cuentas"];
	$facturas= $_POST["facturas"];
	$reportes= $_POST["reportes"];


	$consulta2="SELECT * FROM usuarios U INNER JOIN empleados E ON U.id_empleados=E.id_empleados WHERE U.id_empleados='$id'";
  $ejec2=mysqli_query($con,$consulta2);
  $nrow2=mysqli_num_rows($ejec2);

  if ($nrow2>0) {
		  $row2=mysqli_fetch_assoc($ejec2);
			$idU=$row2['id_usuarios'];

		$consulta=mysqli_query($con,"UPDATE usuarios SET usuario='$usuario', clave='$clave', configuracion='$configuracion',registrar='$registrar', cotizacion='$cotizacion', caso_juridico='$judiciales', cuenta='$cuentas', factura='$facturas', reporte='$reportes' WHERE id_usuarios='$idU'") or die ("error".mysqli_error());
	}else{
		// $tipo_usuario = 1;
		$consulta=mysqli_query($con,"INSERT INTO usuarios (usuario, clave, configuracion,registrar, cotizacion, caso_juridico, cuenta, factura, reporte, id_empleados) VALUES
		('$usuario', '$clave', '$configuracion', '$registrar', '$cotizacion', '$judiciales', '$cuentas', '$facturas', '$reportes', '$id')") or die ("error".mysqli_error());
	}

	// unset($_SESSION['exis']);

	mysqli_close($con);
	header("Location:../buscar_empleados.php");

?>
