<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM tipo_empleado WHERE id_tipo_empleado='$id'");
header('Location:../ingreso_tipo_empleado.php');
?>
