<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM iva WHERE id_iva='$id'");
header('Location:../ingreso_iva.php');
?>
