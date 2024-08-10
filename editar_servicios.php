<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');

$id=$_REQUEST['id'];
$consulta=mysqli_query($con,"SELECT * from servicios where id_servicios='$id' ");
$row=mysqli_fetch_array($consulta);
?>
<body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form3" action="app/modificarServicios.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Servicios</h2>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="servicios">Servicios:</label>
                          <input class="form_input" type="text" id="servicios" name="servicios" value="<?php echo $row['descrip_s']; ?>" onkeypress="return sololetras(event)" required placeholder="Escriba Servicios">
                      </div>
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="valor">Valor:</label>
                          <input class="form_input" type="text" id="valor" name="valor" placeholder="Escriba Valor">
                      </div>

                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <input type="submit" class="btn_submit" value="GUARDAR">
                        </div>
                        <div class="col-md-5">
                            <a href=""> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>


            <br><br><br><br><br><br><br>


<?php include ('footer.php'); ?>
