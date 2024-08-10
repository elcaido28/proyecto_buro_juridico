<?php
include('config/conexion.php');
$salida="";
if(isset($_POST['consulta'])){
  $dia=$_POST['consulta'];

    if($dia=='1' || $dia=='2' || $dia=='3' || $dia=='4'){

    $salida.='<select class="form_input" id="turno" name="turno" required><option value="" >-TURNO-</option>';
    $salida.='<option  >1</option><option  >2</option><option  >3</option><option  >4</option><option  >5</option><option  >6</option><option  >7</option><option  >8</option><option  >9</option><option  >10</option>';
    $salida.='<option  >11</option><option  >12</option><option  >13</option><option  >14</option><option  >15</option>';
    $salida.='<option  >16</option><option  >17</option><option  >18</option><option  >19</option><option  >20</option>';
    $salida.='</select>';
  }
  if($dia=='5'){
    $salida.='<select class="form_input" id="turno" name="turno" required><option value="" >-TURNO-</option>';
    $salida.='<option  >1</option><option  >2</option><option  >3</option><option  >4</option><option  >5</option><option  >6</option><option  >7</option><option  >8</option><option  >9</option><option  >10</option>';
    $salida.='</select>';
  }

echo $salida;
mysqli_close($con);

 ?>
