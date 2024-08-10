<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM tipo_caso WHERE id_tipo_caso='$id'");
header('Location:../ingreso_tipo_caso.php');
?>
