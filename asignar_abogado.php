
<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');


  $id=$_REQUEST['id'];
  $consulta=mysqli_query($con,"SELECT * from asig_caso_abogado where id_casos_juridicos='$id'");
    $np=mysqli_num_rows($consulta);

  if($np>0){
    $row1=mysqli_fetch_assoc($consulta);
    $id_emp_rep=$row1['id_empleados'];

    $consulta2=mysqli_query($con,"SELECT * from empleados where id_empleados='$id_emp_rep'");
    $row2=mysqli_fetch_assoc($consulta2);
    $img_ufoto=$row2['foto'];
  }else{
    $id_emp_rep="0";
    $img_ufoto="img_empleados\defoult.jpg";
  }

  $consul=mysqli_query($con,"SELECT * from casos_juridicos where id_casos_juridicos='$id'");
  $nrow=mysqli_num_rows($consul);
  $estadoCJ='0';
  if ($nrow>0) {
    $rowcj=mysqli_fetch_array($consul);
    $estadoCJ=$rowcj['id_estado'];
  }
  ?>

  <body>
  <div class="container delimitador">
    <div class="contenedor">

      <div class="contet_asig">

        <div class="asignador">

          <div class="cabecera_asig">
            <h3>ASIGNAR ABOGADO AL CASO</h3>
            <hr>
            <div class="" id="caja_img_f">
                <center> <img src="<?php echo $img_ufoto; ?>" alt="" width="200" height="200"></center>
            </div>


          </div>
          <form class="formu_asig" action="app/guardarAsignarAbogado.php?id=<?php echo $id; ?>" method="post">
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 content_cajas">
                  <label class="form_label" for="provincias">Abogado Ayudante:</label>
                  <select class="form_input" id="abogado" name="abogado" required> <option value="" >-Seleccionar-</option>
                          <?php
                              $consulta4=mysqli_query($con,"SELECT * from empleados where id_tipo_empleado='13' order by nombres ASC");
                               while($row4=mysqli_fetch_array($consulta4)){
                                 if($row4['id_empleados']==$id_emp_rep){$sel="selected='selected'";}else{$sel="";}
                              echo "<option ".$sel." value='".$row4['id_empleados']."'>"; echo $row4['nombres']." ".$row4['apellidos']; echo "</option>"; $contad++; }  ?> </select>
            </div>
          </div><br>
            <div class="row">
                <div class="col-md-1"></div>
                  <div class="col-md-5">
                      <input type="submit" class="btn_submit" value="ASIGNAR" <?php if ($estadoCJ=="3") { ?> disabled title="Este caso ya a Finalizado" <?php } ?> >
                  </div>
                  <div class="col-md-5">
                      <a href="buscar_caso_juridico.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                  </div>

            </div>
          </form>



        </div>

      </div>


<script type="text/javascript">

  $(buscar_abog_asig());

  function buscar_abog_asig(consul){
    $.ajax({
      url: 'ajax_abogado_asig.php',
      type: 'POST',
      dataType: 'html',
      data: {consul: consul},
    })
    .done(function(respuesta){
    if(respuesta!=0 || respuesta!=""){
      $('#caja_img_f').html(respuesta);
    }
    })
    .fail(function(){
      console.log("error")
    })
  }
  $(document).on('change','#abogado', function(){
    var valr= $(this).val();
    if(valr!=""){
      buscar_abog_asig(valr);
    }
  });
</script>

<?php include "footer.php" ?>
