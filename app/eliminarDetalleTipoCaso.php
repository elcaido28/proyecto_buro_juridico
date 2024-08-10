<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];
$id_tcj=$_REQUEST['id_tcj'];

$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM detalle_tipo_caso WHERE id_detalle_tipo_caso='$id'");
header("Location:../ingreso_detalle_tipo_caso.php?id=$id_tcj");
?>
