<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM lugares WHERE id_lugares='$id'");
header('Location:../ingreso_lugares.php');
?>
