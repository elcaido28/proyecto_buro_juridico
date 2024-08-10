<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM estado_civil WHERE id_estado_civil='$id'");
header('Location:../ingreso_estado_civil.php');
?>
