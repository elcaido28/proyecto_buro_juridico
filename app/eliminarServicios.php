<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM servicios WHERE id_servicios='$id'");
header('Location:../ingreso_servicios.php');
?>
