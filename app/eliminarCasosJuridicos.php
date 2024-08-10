<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"UPDATE casos_juridicos SET id_estado='2' WHERE id_casos_juridicos='$id'");

//########## REGRESAR ACTIVA LA COTIZACION
$consulta3=mysqli_query($con,"SELECT * from casos_juridicos where id_casos_juridicos='$id' ");
$row3=mysqli_fetch_array($consulta3);
$id_cotizacion=$row3['id_cotizacion'];
$modificar=mysqli_query($con,"UPDATE cotizacion SET id_estado='1'  where id_cotizacion='$id_cotizacion' ") or die ("error".mysqli_error());
mysqli_query($con,"UPDATE casos_juridicos SET id_cotizacion='0' WHERE id_casos_juridicos='$id'");


header('Location:../buscar_caso_juridico.php');
?>
