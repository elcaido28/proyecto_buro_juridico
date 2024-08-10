
<header id="header">
        <!-- <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="top-number">
                            <p><i class="fa fa-phone-square"></i> +0123 456 70 90</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li> -->
                                <!-- <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li> -->
                            <!-- </ul> -->
                            <!-- <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                            </div> -->
                       <!--  </div>
                    </div>
                </div>
            </div> -->
            <!--/.container-->
        <!-- </div> -->
        <!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container" style="width:95%;">
                <div class="navbar-header" >
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- <a class="navbar-brand" href="index.html"><img src="img/logo.png" alt="logo"></a> -->
                    <a class="navbar-brand" href="inicio.php"><img src="img/logo_editado.png" alt="logo" style="width: 180px; height: 70px; margin-left: 0px; padding: 0px;"></a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- <li class="active"><a href="index.php">Inicio</a></li> -->
                        <?php if($_SESSION['TIPO_EMPLE']=='1' || $_SESSION['TIPO_EMPLE']=='3' || $_SESSION['TIPO_EMPLE']=='13' || $_SESSION['CONF']=='1'){ ?>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Configuración <i class="fas fa-cogs"></i> <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                              <?php if($_SESSION['TIPO_EMPLE']=='1'){ ?>
                                <li><a href="ingreso_tipo_empleado.php">Tipo de empleado</a></li>
                                <li><a href="ingreso_tipo_cliente.php">Tipo de cliente</a></li>
                                <li><a href="ingreso_estado_civil.php">Estado civil</a></li>
                                <li><a href="ingreso_genero.php">Género</a></li>
                                <li><a href="ingreso_servicios.php">Servicios</a></li>
                                <li><a href="ingreso_lugares.php">Lugares</a></li>
                                <li><a href="ingreso_tipo_caso.php">Tipo de casos</a></li>
                                <?php } ?>
                                <?php if($_SESSION['TIPO_EMPLE']=='1' || $_SESSION['TIPO_EMPLE']=='3' || $_SESSION['TIPO_EMPLE']=='13'){ ?>
                                <li><a href="ingreso_iva.php">I.V.A.</a></li>
                                <li><a href="ingreso_digitalizar.php">Cargar documentación</a></li>
                                <?php } ?>
                                <?php if($_SESSION['TIPO_EMPLE']=='1'){ ?>
                                <hr>
                                  <li><a href="lista_Restaurar_empleado.php">Restaurar Empleados</a></li>
                                  <li><a href="lista_Restaurar_cliente.php">Restaurar Clientes</a></li>
                                  <?php  } ?>
                            </ul></li><?php  } ?>

                          <?php if($_SESSION['TIPO_EMPLE']=='1' || $_SESSION['TIPO_EMPLE']=='3' || $_SESSION['TIPO_EMPLE']=='13' || $_SESSION['REG']=='1'){ ?>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Registrar <i class="fa fa-pencil"></i> <i class="fa fa-angle-down"></i></a>
                           <ul class="dropdown-menu">
                             <?php if($_SESSION['TIPO_EMPLE']=='1' ){ ?>
                               <li><a href="ingreso_empleados.php">Nuevo empleado</a></li>
                               <li><a href="buscar_empleados.php">Buscar empleados</a></li>
                               <?php } ?>
                               <?php if($_SESSION['TIPO_EMPLE']=='1' || $_SESSION['TIPO_EMPLE']=='3' || $_SESSION['TIPO_EMPLE']=='13'){ ?>
                                 <hr>
                               <li><a href="ingreso_clientes.php">Nuevo cliente</a></li>
                               <li><a href="buscar_clientes.php">Buscar clientes</a></li>
                               <?php } ?>
                           </ul></li><?php } ?>


                           <?php if($_SESSION['TIPO_EMPLE']=='1' || $_SESSION['TIPO_EMPLE']=='3' || $_SESSION['COT']=='1'){ ?>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Cotización <i class="fas fa-search-dollar"></i> <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="ingreso_cotizacion.php">Nuevo</a></li>
                                <li><a href="buscar_cotizacion.php">Buscar</a></li>
                            </ul></li><?php } ?>


                            <?php if($_SESSION['TIPO_EMPLE']=='1' || $_SESSION['TIPO_EMPLE']=='13' || $_SESSION['CJ']=='1'){ ?>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Caso Juridico <i class="fas fa-balance-scale"></i> <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="ingreso_caso_juridico.php">Nuevo</a></li>
                                <li><a href="buscar_caso_juridico.php">Buscar</a></li>
                            </ul></li> <?php } ?>
                        <!-- <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Expedientes <i class="far fa-folder-open"></i> <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="ingreso_expedientes.php">Nuevo</a></li>
                                <li><a href="buscar_expedientes">Buscar</a></li>
                            </ul></li> -->
                            <?php if($_SESSION['TIPO_EMPLE']=='1' || $_SESSION['TIPO_EMPLE']=='13' || $_SESSION['CUEN']=='1'){ ?>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Cuentas x Cobrar <i class="fas fa-hand-holding-usd"></i> <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                              <li><a href="lista_deuda_clienteXcaso.php">Deuda de clientes</a></li>
                              <li><a href="lista_casos_pagos.php">Pagos de clientes</a></li>
                            </ul> </li> <?php } ?>

                          <?php if($_SESSION['TIPO_EMPLE']=='1' || $_SESSION['FACT']=='1'){ ?>
                       <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Facturas <i class="fas fa-cash-register"></i> <i class="fa fa-angle-down"></i></a>
                           <ul class="dropdown-menu">
                             <li><a href="lista_factura_casos.php">Facturar caso</a></li>
                             <li><a href="ingreso_factura_x_clientes.php">Nueva factura</a></li>
                             <li><a href="buscar_facturas.php">Buscar</a></li>
                           </ul> </li> <?php } ?>

                           <?php if($_SESSION['TIPO_EMPLE']=='1' || $_SESSION['TIPO_EMPLE']=='3' || $_SESSION['REPO']=='1'){ ?>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <i class="far fa-file-pdf"></i> <i class="fa fa-angle-down"></i></a>
                           <ul class="dropdown-menu">
                               <li><a href="vista_report_x_fecha_empleados.php">Empleados</a></li>
                               <li><a href="vista_report_x_fecha_clientes.php">Clientes</a></li>
                               <li><a href="vista_report_x_cliente.php">Casos x Cliente</a></li>
                               <li><a href="vista_report_x_fecha_ganacias.php">Ganacias</a></li>
                               <li><a href="#">Reporte 5</a></li>
                           </ul></li> <?php } ?>


                      <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Sesión <i class="fa fa-angle-down"></i></a>
                          <ul class="dropdown-menu">
                            <li><a href="inicio.php">Perfil <i class="fas fa-user-edit"></i></a></li>
                            <li><a href="config\logout.php">Salir <i class="fas fa-sign-out-alt"></i></a></li>
                          </ul> </li>

                    </ul>
                </div>
            </div>
            <!--/.container-->
        </nav>
        <!--/nav-->

    </header>
    <!--/header-->
