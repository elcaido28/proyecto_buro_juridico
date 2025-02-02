<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');

?>
<body>
<div class="container delimitador">
  <div class="contenedor">
    <div class="ccf_cabecera_pantalla">
        <div class="ccfcp_contenedor_titulo">
            <div class="ccfcp_ct_icono">
              <i class="fas fa-cash-register" style="color: #000"></i>
            </div>
            <div class="ccfcp_ct_titulo">
              <h2 style="color: #000">BUSCAR FACTURAS</h2>
            </div>
            <div class="ccfcp_ct_titulo2">
              <p style="color: #000"></p>
            </div>
            <!-- <div class="ccfcp_ct_boton">
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#contenido_mostrar" aria-expanded="false" aria-controls="collapseExample">Agregar Empleado <i class="fas fa-angle-down"></i></button>
            </div> -->
        </div>

        <div class="camino">
            <div class="camino_cuerpo">

              <div class="camino_cuerpo_opcion">
                <a href="inicio.php"><i class="fas fa-home"></i>Inicio</a>
              </div>
              <!-- <i class="fas fa-angle-right"></i>
              <div class="camino_cuerpo_opcion active_camino">
                <a href="ingreso_empleado.php">Ingresar Empleado</a>
              </div> -->
            </div>
        </div>
    </div>


            <br><br>

            <!-- TABLA -->
            <div class="cont_tabla">
              <table class="tabla">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>NºFactur</th>
                    <th>Clientes</th>
                    <th>Cedula</th>
                    <th>Sub-Total</th>
                    <th>IVA</th>
                    <th>TOTAL</th>
                    <th>Imprimir </th>
                  </tr>
                </thead>
                <tr>
                  <?php
                    $consulta=mysqli_query($con,"SELECT * ,F.fecha fechaf ,F.hora horaf from facturas F inner join clientes CL on CL.id_clientes=F.id_clientes where F.id_estado='1' ");
                    while($row=mysqli_fetch_array($consulta)){
                  ?>

                  <td><?php echo $row['fechaf']." ".$row['horaf']; ?> </td>
                  <td><?php echo $row['num_fact']; ?> </td>
                  <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
                  <td><?php echo $row['cedula']; ?> </td>
                  <td><?php echo $row['sub_total']; ?> </td>
                  <td><?php echo $row['iva']; ?> </td>
                  <td><?php echo $row['total']; ?> </td>

                  <td><div class="cont_tbn_tb">
                    <a href="report/factura.php?id=<?php echo $row['id_facturas'] ?>" target="_blank">
                      <button type="button" title="Imprimir" class="btn btn-default asignar" name="button"> <i class="fas fa-print fa-2x"></i></button>
                    </a>
                  </div></td>
                </tr>
<?php } ?>
            </table>
          </div>

  </div>
</div>

<script>
$(document).ready( function () {
    $('.tabla').DataTable();
} );
</script>


<?php include ('footer.php'); ?>
