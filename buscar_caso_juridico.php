<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');
?>
<body>
    <style>
    .container{
        width: 90%;
    }
    .cont_tabla{
	height: auto;
	width: 100%;
	margin-top: 20px;
	display: flex;
	align-items: center;
	justify-content: center;
	padding: 20px;
	padding-bottom: 20px;
	padding-left: 40px;
	overflow-x: scroll;
}


</style>
<div class="container delimitador">
  <div class="contenedor">

    <div class="ccf_cabecera_pantalla">
        <div class="ccfcp_contenedor_titulo">
            <div class="ccfcp_ct_icono">
              <i class="fas fa-balance-scale" style="color: #000"></i>
            </div>
            <div class="ccfcp_ct_titulo">
              <h2 style="color: #000">CASOS JURIDICOS</h2>
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
            <div class="cont_tabla" >
              <table class="tabla">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Nombres</th>
                    <th>Correos</th>
                    <th>Telefono</th>
                    <th>Tipo de Caso</th>
                    <th>Detalle Tipo de Caso</th>
                    <!-- <th>Estado</th> -->
                    <th>Agg Datos Oponente</th>
                    <th>Agg Anexo al Expediente</th>
                    <th>Asig. ABG.Ayudante</th>
                    <th>Editar / Borrar</th>
                  </tr>
                </thead>

                  <?php
$data_query="SELECT *,CJ.fecha fechacj,CJ.id_estado estadocj from casos_juridicos CJ inner join estado E on E.id_estado=CJ.id_estado inner join tipo_caso TCJ on TCJ.id_tipo_caso=CJ.id_tipo_caso inner join detalle_tipo_caso DTC on DTC.id_detalle_tipo_caso=CJ.detalle_tipo_caso inner join cotizacion C on C.id_cotizacion=CJ.id_cotizacion inner join clientes CL on CL.id_clientes=C.id_clientes where CL.id_estado='1' and CJ.id_estado!='2' ".$query_sesion;
$consulta=mysqli_query($con,$data_query);
                    while($row=mysqli_fetch_array($consulta)){
                      $id_casoJ=$row['id_casos_juridicos'];

                      $consulta2=mysqli_query($con,"SELECT * from expedientes where id_casos_juridicos='$id_casoJ' ");
                      $nrow2=mysqli_num_rows($consulta2);
                  ?>
                  <tr <?php if ($row['estadocj']=='3'){ ?> style="background:#c7f6c6;"  <?php } ?> >

                  <td><?php echo $row['fechacj']; ?> </td>
                  <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
                  <td><?php echo $row['correo']; ?> </td>
                  <td><?php echo $row['telefono']; ?> </td>
                  <td><?php echo $row['descrip_tcj']; ?> </td>
                  <td><?php echo $row['descrip_dtc']; ?> </td>
                  <!-- <td><?php echo $row['descrip']; ?> </td> -->
                  <td> <?php // if ($row['estadocj']!='3'){ ?><div class="cont_tbn_tb">
                      <a href="ingreso_oponente.php?id=<?php echo $row['id_casos_juridicos'] ?>">
                        <button type="button" title="Agregar datos del oponente" class="btn btn-default asignar" name="button">
                          <i class="far fa-share-square fa-2x"></i>
                        </button>
                      </a>
                    </div> <?php // } ?></td>

                  <td><?php// if ($row['estadocj']!='3'){ ?><div class="cont_tbn_tb">
                      <a href="ingreso_expedientes.php?id=<?php echo $row['id_casos_juridicos'] ?>">
                        <button type="button" title="Agregar Anexo a Expediente" class="btn btn-default asignar" name="button">
                          <i class="far fa-folder-open fa-2x"></i>
                        </button>
                      </a>
                    </div> <?php // } ?></td>
                    <td><?php  if ($sesion_id_emple==''){ ?><div class="cont_tbn_tb">
                        <a href="asignar_abogado.php?id=<?php echo $row['id_casos_juridicos'] ?>">
                          <button type="button" title="Asignar a Abogado" class="btn btn-default asignar" name="button">
                            <i class="far fa-share-square fa-2x"></i>
                          </button>
                        </a>
                      </div> <?php } ?></td>

                  <td><?php if ($row['estadocj']!='3' && $nrow2<'1' ){ ?>
                    <div class="cont_tbn_tb">
                      <a href="editar_casos_juridicos.php?id=<?php echo $row['id_casos_juridicos']; ?>">
                        <button type="button" title="Modificar" class="btn btn-primary modificar" name="button">
                          <i class="far fa-edit fa-2x"> </i>
                        </button>
                      </a>
                      <button type="button" class="btn btn-danger eliminar" title="Eliminar" id="<?php echo $row['id_casos_juridicos'] ?>" name="button" id="elim">
                        <i class="far fa-trash-alt fa-2x" id="<?php echo $row['id_casos_juridicos'] ?>"> </i>
                      </button>
                    </div><?php } ?>
                  </td>
                </tr>
  <script type="text/javascript">
    $('.eliminar').click(function(e){
      var id_emp= e.target.id;

      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Esta Seguro?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'No, cancelar!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          window.location.href="app/eliminarCasosJuridicos.php?id="+id_emp;
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          }
      })
    })
  </script> <?php } ?>
            </table>
          </div>



<script>
$(document).ready( function () {
    $('.tabla').DataTable();
} );
</script>


  </div>
</div>

<?php include ('footer.php'); ?>

<?php if (isset($_SESSION['confirmar'])) {
  if ($_SESSION['confirmar']==1){ ?>
<script>
function ejecutarEjemplo(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Datos Guardados'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['confirmar']=0; } }?>

<!-- EDITAR -->
<?php if (isset($_SESSION['confirmar'])) {
  if ($_SESSION['confirmar']==2){ ?>
<script>
function ejecutarEjemplo(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Datos Editados Correctamente'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['confirmar']=0; } }?>

<!-- ELIMINAR -->
<?php if (isset($_SESSION['eliminar'])) {
  if ($_SESSION['eliminar']==1){ ?>
<script>
function ejecutarEjemplo(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Empleado Eliminado'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['eliminar']=0; } }?>
