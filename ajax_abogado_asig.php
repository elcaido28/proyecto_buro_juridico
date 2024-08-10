<?php
include ("config/conexion.php");
$salida="";
if(isset($_POST['consul'])){
  $repartidor=$_POST['consul'];
$consulta=mysqli_query($con,"SELECT * from  empleados WHERE id_empleados='$repartidor'");
$row=mysqli_fetch_array($consulta);


  $salida.="<center><img src='".$row['foto']."' alt='' width='200' height='200'></center><br>";




}else {
  $salida="";
}

echo $salida;
mysqli_close($con);

 ?>
