<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');
?>
<body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form3" action="app/guardarServicio.php" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Servicios</h2>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="servicios">Servicios:</label>
                          <input class="form_input" type="text" id="servicios" name="servicios" required onkeypress="return sololetras(event)" placeholder="Escriba Servicios">
                      </div>
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="valor">Valor:</label>
                          <input class="form_input" type="text" id="valor" name="valor" placeholder="Escriba Valor" required onkeypress="return solonumeros(event)">
                      </div>

                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <input type="submit" class="btn_submit" value="GUARDAR" disabled>
                        </div>
                        <div class="col-md-5">
                            <a href="inicio.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>
                <script>
                                $(buscar_servicio());
                                function buscar_servicio(consulta){
                                  $.ajax({
                                    url: 'ajax_servicio.php',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {consulta: consulta},
                                  })
                                  .done(function(respuesta){
                                    if(respuesta==''){

                                    }else{
                                    if(respuesta>0){

                                      document.getElementById('servicios').value='';
                                      const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 5000,
                                        timerProgressBar: true,
                                        onOpen: (toast) => {
                                          toast.addEventListener('mouseenter', Swal.stopTimer)
                                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                                        }
                                      })

                                      Toast.fire({
                                        icon: 'warning',
                                        title: 'Ya existe ese registro!!'
                                      })
                                      document.getElementById('guardar').setAttribute("disabled", "");
                                    }else{
                                      document.getElementById('guardar').removeAttribute("disabled");
                                    }
                                    }
                                    // document.getElementById('cedula').value=respuesta;
                                  })
                                  .fail(function(){
                                    console.log("error")
                                  })
                                }
                                $(document).on('change','#servicios', function(){
                                  var valr= $(this).val();
                                  if(valr!=""){
                                    buscar_servicio(valr);
                                  }
                                });
                            </script>

            <br><br>

            <!-- TABLA -->
            <div class="cont_tabla">
              <table class="tabla">
                <thead>
                  <tr>
                    <th>Servicios</th>
                    <th>Valor</th>
                    <th>Editar / Borrar</th>
                  </tr>
                </thead>
                <tr>
                  <?php
                    $consulta=mysqli_query($con,"SELECT * from servicios ");
                    while($row=mysqli_fetch_array($consulta)){
                  ?>
                  <td><?php echo $row['descrip_s']; ?> </td>
                  <td><?php echo $row['valor']; ?> </td>
                  <td>
                    <div class="cont_tbn_tb">
                      <a href="editar_servicios.php?id=<?php echo $row['id_servicios']; ?>">
                        <button type="button" title="Modificar" class="btn btn-primary modificar" name="button">
                          <i class="far fa-edit fa-2x"> </i>
                        </button>
                      </a>
                      <button type="button" class="btn btn-danger eliminar" title="Eliminar" id="<?php echo $row['id_servicios'] ?>" name="button" id="elim">
                        <i class="far fa-trash-alt fa-2x" id="<?php echo $row['id_servicios'] ?>"> </i>
                      </button>
                    </div>
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
          document.location.href="app/eliminarServicios.php?id="+id_emp;
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





  </div>
</div>

<script>
$(document).ready( function () {
    $('.tabla').DataTable();
} );
</script>
<script>
    // $(document).on('keyup','#nombres', function(){
    //     var valr= $('#nombres').val();
    //     if(valr!=""){
    //        // var texto = MaysPrimera(valr.tolowerCase());
    //        var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
    //        // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
    //         document.getElementById('nombres').value=texto;
    //     }
    // });

    $(document).on('keyup','#servicios', function(){
        var valr= $('#servicios').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = MaysPrimera(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('servicios').value=texto;
        }
    });
    function toTitleCase(str){
    return str.replace(/(?:^|\s)\w/g, function(match){
      return match.toUpperCase();
    });
  }

  function MaysPrimera(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
  }
</script>



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
  title: 'Registro Eliminado'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['eliminar']=0; } }?>
