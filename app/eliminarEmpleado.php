<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"UPDATE empleados SET id_estado='2' WHERE id_empleados='$id'");
header('Location:../Buscar_empleados.php');
?>
