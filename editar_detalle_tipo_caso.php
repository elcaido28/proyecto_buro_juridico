<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');

$id=$_REQUEST['id'];
$idtcj=$_REQUEST['idtcj'];
$consulta=mysqli_query($con,"SELECT * from detalle_tipo_caso where id_detalle_tipo_caso='$id' ");
$row=mysqli_fetch_array($consulta);
?>
<body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form3" action="app/modificarDetalleTipo_Caso.php?id=<?php echo $id."&idtcj=".$idtcj; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Detalle Tipo de Caso</h2>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="detalle">Detalle Tipo de Caso:</label>
                          <input class="form_input" type="text" id="detalle" name="detalle" value="<?php echo $row['descrip_dtc']; ?>" onkeypress="return sololetras(event)" required placeholder="Escriba Genero">
                      </div>

                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <input type="submit" class="btn_submit" value="GUARDAR">
                        </div>
                        <div class="col-md-5">
                            <a href="ingreso_detalle_tipo_caso.php?id=<?php echo $idtcj; ?>"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>


            <br><br><br><br><br><br><br>


<?php include ('footer.php'); ?>
