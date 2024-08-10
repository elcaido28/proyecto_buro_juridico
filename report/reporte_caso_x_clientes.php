<?php
include('TD_reportes.php');
include('../config/conexion.php');

$id=$_POST['clientes'];

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


$consul=mysqli_query($con,"SELECT * FROM clientes WHERE  id_clientes='$id' ");
$rowc=mysqli_fetch_array($consul);

//$consulta=mysqli_query($con,"SELECT * from tareas T INNER JOIN empleados E on T.id_empleado=E.id_empleado INNER JOIN actividades A on A.id_actividad=T.id_actividad INNER JOIN parcelas P on P.id_parcela=T.id_parcela where T.fecha BETWEEN '$desde' and '$hasta' ORDER BY T.fecha ASC");

$pdf=new PDF('P','mm','A4');#(orizontal L o vertical P,medida cm mm, A3-A4)
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$y=$pdf->GetY();
$pdf->SetY($y);
$pdf->Cell(190,10,'REPORTE CASOS POR CLIENTES',0,1,'C');#(ancho,alto,texto,borde,salto linea,alineacion L C R)
$pdf->SetFont('arial','',10);
// $pdf->Cell(100,10,$fechas ,0,1,'C');

$y=$pdf->GetY();
$pdf->SetY($y+5);
$pdf->SetFont('arial','B',8);
$pdf->Cell(110,6,utf8_decode('Nombres: '.$rowc['nombres'].' '.$rowc['apellidos']),0,0,'L');
$pdf->Cell(70,6,utf8_decode('Cédula: '.$rowc['cedula']),0,1,'L');

$pdf->Cell(110,6,utf8_decode('Dirección: '.$rowc['direccion']),0,0,'L');
$pdf->Cell(70,6,utf8_decode('Teléfono: '.$rowc['telefono']),0,1,'L');



$consulta=mysqli_query($con,"SELECT * FROM cotizacion C inner join servicios S on S.id_servicios=C.id_servicios inner join casos_juridicos CJ on CJ.id_cotizacion=C.id_cotizacion inner join estado E on E.id_estado=C.id_estado where CJ.id_clientes='$id' ".$queryr);
while($row=mysqli_fetch_array($consulta)){
  $pdf->SetFillColor(255, 189, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(30,10,utf8_decode('COTIZACIÓN'),1,1,'C',true);

  $pdf->SetFillColor(152, 152, 152);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(17,8,utf8_decode('Fecha'),1,0,'C',true);
  $pdf->Cell(30,8,utf8_decode('Nº Cotización'),1,0,'C',true);
  $pdf->Cell(20,8,utf8_decode('Sub Total'),1,0,'C',true);
  $pdf->Cell(20,8,utf8_decode('I.V.A.'),1,0,'C',true);
  $pdf->Cell(30,8,utf8_decode('Total Pagar'),1,0,'C',true);
  $pdf->Cell(20,8,utf8_decode('Estado'),1,1,'C',true);
  $pdf->SetFont('arial','B',8);
   $pdf->SetTextColor(0, 0, 0);
  $pdf->Cell(17,8,utf8_decode($row['fecha']),1,0,'C');
  $pdf->Cell(30,8,utf8_decode($row['num_cotizacion']),1,0,'C');
  $pdf->Cell(20,8,utf8_decode('$ '.$row['sub_total']),1,0,'C');
  $pdf->Cell(20,8,utf8_decode('$ '.$row['iva']),1,0,'C');
  $pdf->Cell(30,8,utf8_decode('$ '.$row['total_pagar']),1,0,'C');
  $pdf->Cell(20,8,utf8_decode($row['descrip']),1,1,'C');
  $pdf->Cell(190,8,utf8_decode('SERVICIO PRESTADO'),1,1,'C',true);
  $pdf->MultiCell(190,5,utf8_decode($row['descrip_s']),'LRB','C',0);


  $pdf->SetFillColor(255, 189, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(30,10,utf8_decode('CASO JURIDICO'),1,1,'C',true);
  $id_cotiza=$row['id_cotizacion'];
  $consulta2=mysqli_query($con,"SELECT * FROM casos_juridicos CJ inner join provincias P on P.provincia_id=CJ.provincia inner join ciudades C on C.ciudad_id=CJ.ciudad  inner join tipo_caso TC on TC.id_tipo_caso=CJ.id_tipo_caso inner join detalle_tipo_caso DTC on DTC.id_detalle_tipo_caso=CJ.detalle_tipo_caso  inner join estado E on E.id_estado=CJ.id_estado where CJ.id_cotizacion='$id_cotiza' and CJ.id_clientes='$id' ");
  $row2=mysqli_fetch_array($consulta2);
  $pdf->SetFillColor(152, 152, 152);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(17,8,utf8_decode('Fecha'),1,0,'C',true);
  $pdf->Cell(35,8,utf8_decode('Ciudad'),1,0,'C',true);
  $pdf->Cell(20,8,utf8_decode('Nº Caso J.'),1,0,'C',true);
  $pdf->Cell(78,8,utf8_decode('Tipo de Caso'),1,0,'C',true);
  $pdf->Cell(20,8,utf8_decode('Pago Inicial'),1,0,'C',true);
  $pdf->Cell(20,8,utf8_decode('Estado'),1,1,'C',true);
  $pdf->SetFont('arial','B',8);
   $pdf->SetTextColor(0, 0, 0);
  $pdf->Cell(17,8,utf8_decode($row2['fecha']),1,0,'C');
  $pdf->Cell(35,8,utf8_decode($row2['provincia_nombre']." - ".$row2['ciudad_nombre']),1,0,'C');
  $pdf->Cell(20,8,utf8_decode($row2['codigo']),1,0,'C');
  $pdf->Cell(78,8,utf8_decode($row2['descrip_tcj'].": ".$row2['descrip_dtc']),1,0,'C');
  $pdf->Cell(20,8,utf8_decode('$ '.$row2['valor_pago_inicial']),1,0,'C');
  $pdf->Cell(20,8,utf8_decode($row2['descrip']),1,1,'C');




  $pdf->SetFillColor(255, 189, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(30,10,utf8_decode('DEUDAS Y PAGOS'),1,1,'C',true);
  $id_casos=$row2['id_casos_juridicos'];
  $pdf->SetFillColor(152, 152, 152);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(20,8,utf8_decode('Fecha'),1,0,'C',true);
  $pdf->Cell(50,8,utf8_decode('Descripción'),1,0,'C',true);
  $pdf->Cell(20,8,utf8_decode('Deuda'),1,0,'C',true);
  $pdf->Cell(20,8,utf8_decode('Fecha'),1,0,'C',true);
  $pdf->Cell(20,8,utf8_decode('Pago'),1,1,'C',true);
  $pdf->SetFont('arial','B',8);
  $pdf->SetTextColor(0, 0, 0);


  $acu_deuda=0;
$consulta3=mysqli_query($con,"SELECT * FROM deudas where id_casos_juridicos='$id_casos'");
while($row3=mysqli_fetch_array($consulta3)){

$pdf->Cell(20,8,utf8_decode($row3['fecha']),1,0,'C');
$pdf->Cell(50,8,utf8_decode($row3['descripcion']),1,0,'C');
$pdf->Cell(20,8,utf8_decode('$ '.$row3['valor_deuda']),1,1,'C');
if ($acu_deuda==0) {
  $y2=$pdf->GetY();
}
$acu_deuda+=$row3['valor_deuda'];
}
$acu_pagos=0;
$consulta4=mysqli_query($con,"SELECT * FROM pago_abono where id_casos_juridicos='$id_casos'");
while($row4=mysqli_fetch_array($consulta4)){
  $pdf->SetXY(100,$y2-8);
$pdf->Cell(20,8,utf8_decode($row4['fecha']),1,0,'C');
$pdf->Cell(20,8,utf8_decode('$ '.$row4['abono']),1,1,'C');
$y2+=8;
$acu_pagos+=$row4['abono'];
}


$y2=$pdf->GetY();
$pdf->Cell(50,8,utf8_decode(''),1,0,'C');
$pdf->Cell(20,8,utf8_decode('Deuda Total'),1,0,'C');
$pdf->Cell(20,8,utf8_decode('$ '.$acu_deuda),1,0,'C');
$pdf->Cell(20,8,utf8_decode('Total Pagado'),1,0,'C');
$pdf->Cell(20,8,utf8_decode('$ '.$acu_pagos),1,1,'C');

$pdf->Cell(180,10,utf8_decode(''),0,1,'L');
}



// $pdf->SetFillColor(255, 189, 40);
//  $pdf->SetTextColor(255, 255, 255);
//  $pdf->Cell(17,10,utf8_decode('Fecha'),1,0,'C',true);
// $pdf->Cell(60,10,utf8_decode('Nombres'),1,0,'C',true);
// $pdf->Cell(20,10,utf8_decode('Cedula'),1,0,'C',true);
// $pdf->Cell(20,10,utf8_decode('Telefono'),1,0,'C',true);
// $pdf->Cell(50,10,utf8_decode('Correo'),1,0,'C',true);
// $pdf->Cell(20,10,utf8_decode('Estado'),1,1,'C',true);
//
// $pdf->SetFont('arial','B',8);
//  $pdf->SetTextColor(0, 0, 0);
// while($row5=mysqli_fetch_array($consulta)){
//
// $pdf->Cell(17,10,utf8_decode($row5['fecha']),1,0,'C');
// $pdf->Cell(60,10,utf8_decode($row5['nombres']." ".$row5['apellidos']),1,0,'C');
// $pdf->Cell(20,10,utf8_decode($row5['cedula']),1,0,'C');
// $pdf->Cell(20,10,utf8_decode($row5['telefono']),1,0,'C');
// $pdf->Cell(50,10,utf8_decode($row5['correo']),1,0,'C');
// $pdf->Cell(20,10,utf8_decode($row5['descrip']),1,1,'C');
// }
/*
$pdf->SetFont('arial','B',15);
$pdf->SetXY(10,70);
$pdf->MultiCell(60,5,'hola mundo como estan todo aqui',1,'C',0);
$pdf->MultiCell(100,5,'hola mundo como estan todo aqui',1,'C',0);
*/
$pdf->Output();
 ?>
