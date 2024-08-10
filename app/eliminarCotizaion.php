<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM cotizacion WHERE id_cotizacion='$id'");
header('Location:../buscar_cotizacion.php');
?>
