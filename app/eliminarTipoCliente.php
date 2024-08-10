<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM tipo_cliente WHERE id_tipo_cliente='$id'");
header('Location:../ingreso_tipo_cliente.php');
?>
