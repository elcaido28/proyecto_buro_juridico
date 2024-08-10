<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');

$id=$_REQUEST['id'];
$consulta=mysqli_query($con,"SELECT * from oponente O inner join casos_juridicos CJ on CJ.id_casos_juridicos=O.id_casos_juridicos where O.id_casos_juridicos='$id'");
$nrow=mysqli_num_rows($consulta);
$nombre='';
$cedula='';
$abogado='';
$estadoCJ='0';
if ($nrow>0) {
  $row=mysqli_fetch_array($consulta);
  $nombre=$row['nombres_persona'];
  $cedula=$row['cedula_persona'];
  $abogado=$row['nombres_abogado'];
  $estadoCJ=$row['id_estado'];
}
?>
<body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form3" action="app/guardarOponente.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Datos de Oponente</h2>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="cedulap">Cedula Persona:</label>
                          <input class="form_input" type="text" id="cedula" name="cedulap" value="<?php echo $cedula; ?>" maxlength="10" onchange="validarCedula(this.value);" required onkeypress="return solonumeros(event)" placeholder="Escriba Cedula Persona">
                      </div>
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="nombrep">Nombre Persona:</label>
                          <input class="form_input" type="text" id="nombrep" name="nombrep" value="<?php echo $nombre; ?>" placeholder="Escriba Nombre Persona" required onkeypress="return sololetras(event)">
                      </div>
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="abogado">Nombre Abogado:</label>
                          <input class="form_input" type="text" id="abogado" name="abogado" value="<?php echo $abogado; ?>" placeholder="Escriba Nombre Abogado" required onkeypress="return sololetras(event)">
                      </div>

                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <input type="submit" class="btn_submit" value="GUARDAR" <?php if ($estadoCJ=="3") { ?>disabled title="Este caso ya a Finalizado" <?php } ?> >
                        </div>
                        <div class="col-md-5">
                            <a href="buscar_caso_juridico.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>


            <br><br>



  </div>
</div>
<script>
$(buscar_cedula());
function buscar_cedula(consulta){
  $.ajax({
    url: 'ajax_cedula_empleado.php',
    type: 'POST',
    dataType: 'html',
    data: {consulta: consulta},
  })
  .done(function(respuesta){
    if(respuesta==''){

    }else{
    if(respuesta>0){
      $("#cedula").css({
        "background-color": "rgba(255,87,87,0.5)"
      });
      document.getElementById('cedula').value='';
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
        title: 'Error es un Empleado, conflicto de intereses'
      })
    }else{
      $("#cedula").css({
        "background-color": "rgba(56,208,49,0.5)"
      });
    }
    }
    // document.getElementById('cedula').value=respuesta;
  })
  .fail(function(){
    console.log("error")
  })
}
$(document).on('change','#cedula', function(){
  var valr= $(this).val();
  if(valr!=""){
    buscar_cedula(valr);
  }
});
</script>

<script>
    $(document).on('keyup','#nombrep', function(){
        var valr= $('#nombrep').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('nombrep').value=texto;
        }
    });
    $(document).on('keyup','#abogado', function(){
        var valr= $('#abogado').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('abogado').value=texto;
        }
    });


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
