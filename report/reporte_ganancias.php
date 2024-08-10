<?php
include('TD_reportes.php');
include('../config/conexion.php');

if (isset($_POST['fecha_ini']) && isset($_POST['fecha_fin'])) {
  if ($_POST['fecha_ini']!="" && $_POST['fecha_fin']!="") {
    $desde=$_POST['fecha_ini'];
    $hasta=$_POST['fecha_fin'];
    $queryr=" AND CJ.fecha BETWEEN '$desde' and '$hasta'";
  }else{
    $queryr="";
  }
}else{
  $queryr="";
}





$pdf=new PDF('P','mm','A4');#(orizontal L o vertical P,medida cm mm, A3-A4)
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$y=$pdf->GetY();
$pdf->SetY($y);
$pdf->Cell(190,10,'REPORTE DE GANANCIAS',0,1,'C');#(ancho,alto,texto,borde,salto linea,alineacion L C R)
$pdf->SetFont('arial','',10);
// $pdf->Cell(100,10,$fechas ,0,1,'C');

$y=$pdf->GetY();
$pdf->SetY($y+5);
$consulta=mysqli_query($con,"SELECT *,CJ.fecha fechacj ,E.nombres nombree,E.apellidos apellidoe FROM casos_juridicos CJ INNER JOIN empleados E ON E.id_empleados=CJ.id_empleados  WHERE  E.id_estado!='2' ".$queryr);
while($row5=mysqli_fetch_array($consulta)){
  $pdf->SetFont('arial','B',8);
  $pdf->SetFillColor(255, 189, 40);
   $pdf->SetTextColor(255, 255, 255);
   $pdf->Cell(20,10,utf8_decode('Fecha'),1,0,'C',true);
   $pdf->Cell(20,10,utf8_decode('Nº caso'),1,0,'C',true);
  $pdf->Cell(60,10,utf8_decode('Abogado'),1,0,'C',true);
  $pdf->Cell(60,10,utf8_decode('Abgd. Ayudante'),1,0,'C',true);
  $pdf->Cell(20,10,utf8_decode('Deuda'),1,1,'C',true);
  $pdf->SetFont('arial','B',8);
   $pdf->SetTextColor(0, 0, 0);

  $id_cj=$row5['id_casos_juridicos'];

  $consulta1=mysqli_query($con,"SELECT *, EMPL.nombres nombrep ,EMPL.apellidos apellidop from casos_juridicos CJ INNER JOIN empleados EMPL ON EMPL.id_empleados=CJ.id_abg_ayudante where CJ.id_casos_juridicos='$id_cj' ");
  $row1=mysqli_fetch_array($consulta1);


  $consulta2=mysqli_query($con,"SELECT SUM(valor_deuda) deudat from deudas where id_casos_juridicos='$id_cj' ");
  $row2=mysqli_fetch_array($consulta2);
  $deudat=$row2['deudat'];

$pdf->Cell(20,10,utf8_decode($row5['fechacj']),1,0,'C');
$pdf->Cell(20,10,utf8_decode($row5['codigo']),1,0,'C');
$pdf->Cell(60,10,utf8_decode($row5['nombree']." ".$row5['apellidoe']),1,0,'C');
$pdf->Cell(60,10,utf8_decode($row1['nombrep']." ".$row1['apellidop']),1,0,'C');
$pdf->Cell(20,10,utf8_decode($deudat),1,1,'C');

$pdf->Cell(20,10,utf8_decode('Pagos'),1,0,'C',true);
$pdf->Cell(20,10,utf8_decode('Pagos Abgd.'),1,0,'C',true);
$pdf->Cell(20,10,utf8_decode('Recaudación'),1,1,'C',true);
$pagosvt=0;
$pabt=0;
$paret=0;
$consulta3=mysqli_query($con,"SELECT * from pago_abono where id_casos_juridicos='$id_cj' ");
while($row3=mysqli_fetch_array($consulta3)){
  $pagosv=$row3['abono'];
  $pab=$pagosv*0.70;
  $pare=$pagosv*0.30;

  $pdf->Cell(20,10,utf8_decode($pagosv),1,0,'C');
  $pdf->Cell(20,10,utf8_decode($pab),1,0,'C');
  $pdf->Cell(20,10,utf8_decode($pare),1,1,'C');

  $pagosvt+=$pagosv;
  $pabt+=$pab;
  $paret+=$pare;
}
$pdf->Cell(20,10,utf8_decode($pagosvt),1,0,'C');
$pdf->Cell(20,10,utf8_decode($pabt),1,0,'C');
$pdf->Cell(20,10,utf8_decode($paret),1,1,'C');
}
/*
$pdf->SetFont('arial','B',15);
$pdf->SetXY(10,70);
$pdf->MultiCell(60,5,'hola mundo como estan todo aqui',1,'C',0);
$pdf->MultiCell(100,5,'hola mundo como estan todo aqui',1,'C',0);
*/
$pdf->Output();
 ?>
