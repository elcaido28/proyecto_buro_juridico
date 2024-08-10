<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM genero WHERE id_genero='$id'");
header('Location:../ingreso_genero.php');
?>
