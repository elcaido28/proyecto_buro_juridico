<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['confirmar']=1;
mysqli_query($con,"UPDATE empleado SET estado_id='1' WHERE empleado_id='$id'");
header('Location:../lista_empleados_inactivos.php');
?>