<?php


  $cd = "http://" . $_SERVER['HTTP_HOST'];
  $uri = explode("/", $_SERVER['REQUEST_URI']);
  if (in_array('proyecto-erp', $uri)) {
    foreach ($uri as $key => $value) {
      if ($value == 'proyecto-erp') {
        $cd .= "/" . $value . '/';
        break;
      } else {
        if(!empty($value) ){
          $cd .= '/' . $value;
        }
      }
    }
  } else {
    $cd .= '/';
  }

  $thisFileName = end($uri);
  $thisFileName = explode(".", $thisFileName);
  $thisFileName = $thisFileName[0];
  $relative;
  if ($thisFileName=='index'||$thisFileName=='lockscreen'||$thisFileName=='login'){
    $relative = '';
  } else {
    $relative = '../../';
  }

 

  include($relative.'inc/conexion.php');
  include($relative.'inc/util.php');
  include($relative.'inc/constructor.php');

  // echo $relative.'inc/constructor.php';
  // exit();
  session_start();
  $_SESSION['detalle'] = array();
  if (!isset($_SESSION['Id_Usuario'])&&!isset($_SESSION['Tipo_Usuario'])&&!isset($_SESSION['Codigo_Empleado'])) {
    
    header("Location: ".$cd."login.php", true);
    
     
    die();
  } else {
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MaterialAdminLTE 2 | Empleados</title>
 
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $cd;?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $cd;?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Sweet Alert CSS -->
  <link rel="stylesheet" href="<?php echo $cd;?>plugins/sweet-alert/sweetalert.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $cd;?>bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $cd;?>dist/css/AdminLTE.min.css">
  <!-- Material Design -->
  <link rel="stylesheet" href="<?php echo $cd;?>dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="<?php echo $cd;?>dist/css/ripples.min.css">
  <link rel="stylesheet" href="<?php echo $cd;?>dist/css/MaterialAdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $cd;?>dist/css/skins/all-md-skins.min.css">
 
 <script>
  function evaluacion(){
 var txt_costo =document.getElementById('txt_costo').value;
  var txt_porcentaje=document.getElementById('txt_porcentaje').value;
  var preci01;
   var preciof=document.getElementById('txt_precio').value;
if (txt_costo=='') {
    var num1=0; 
  }
  if (txt_costo!='') {
    var num1=parseFloat(txt_costo);
  }
if (txt_porcentaje=='') {
    var num2=0; 
  }
  if (txt_porcentaje!='') {
    var num2=parseFloat(txt_porcentaje);
  }

var preciof=((num1*num2)/100)+num1;
     document.frmdatos.txt_precio.value=preciof;
}
  </script>
<script>
  function numeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 0123456789";
    especiales = [8,37,39,46];
 
    tecla_especial = false
    for(var i in especiales){
 if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}

</script>
  
    


























  
   <!-- Alertity -->
    <link rel="stylesheet" href="libs/js/alertify/themes/alertify.core.css" />
  <link rel="stylesheet" href="libs/js/alertify/themes/alertify.bootstrap.css" id="toggleCSS" />
    <script src="libs/js/alertify/lib/alertify.min.js"></script>
   <script src="<?php echo $cd;?>bower_components/jquery/dist/jquery.js"></script>
  <script type="text/javascript" src="libs/ajax_compras.js"></script>



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="skin-blue sidebar-mini fixed">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo $cd;?>index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">M<b>A</b>L</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Material<b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $cd;?>dist/img/user-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['Nombre']." ".$_SESSION['Apellido'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $cd;?>dist/img/user-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                <?php echo $_SESSION['Id_Usuario']." - ".$_SESSION['Tipo_Usuario'] ;?>
                  <small>Miembro desde <?php $foo = $_SESSION['Fecha_Ingreso']; $foo = fechaBDAEsp($foo); $foo = fechaFormato($foo); echo $foo;;?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="<?php echo $cd;?>pages/configuraciones/perfil.php">Perfil</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="<?php echo $cd;?>lockscreen.php">Bloquear</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="<?php echo $cd;?>logout.php">Salir</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <!-- <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat"><i class="fa fa-user"></a>
                </div>
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat"><i class="fa fa-lock"></i></a>
                </div>
                <div class="pull-right">
                  <a href="<?php //echo $cd;?>logout.php" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></a>
                </div>
              </li> -->
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $cd;?>dist/img/user-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
        <p><?php echo $_SESSION['Nombre']." ".$_SESSION['Apellido'];?></p>
          <a href="#"><i class="fa fa-user"></i> <?php echo $_SESSION['Codigo_Empleado'];?></a>          
        </div>
      </div>
     
      <?php
        menu($_SESSION['Tipo_Usuario'], $thisFileName, $cd);
      ?>
    </section>
    <!-- /.sidebar -->
  </aside>


  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registrar Compras
        <small>Compras</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Compras</a></li>
        <li class="active">Registrar Compras</li>
      </ol>
    </section>

 <!-- Main content -->
    <section class="content">
    <div class="row">
      <!-- columna izq -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Datos Administrativos</h3>
          </div>
          

<form class="form-horizontal">
            <div class="box-body">
              <div class="form-group" id="form_codigo">
                <label for="codigo" class="col-sm-2 control-label">Codigo*</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Codigo" value="<?php echo nuevoCodigo(obtenerUltimoCodigoRegistro_Compra());?>" readonly>
                </div>
              </div>




              <div class="form-group" id="form_proveedor">
                <label for="proveedor_articulo" class="col-sm-2 control-label">Proveedor*</label>

                <div class="col-sm-9">
                   <select class="form-control select2" id="proveedor_articulo" name="proveedor_articulo" style="width: 100%;" p>
                   <option value="">Seleccione un proveedor</option>
                   <?php 
                          $queryListaProv=mysqli_query($db, "SELECT * FROM proveedores") or die(mysqli_error());
                          while ($rowProv=mysqli_fetch_array($queryListaProv)) {
                            echo '<option value="'.$rowProv['Id_Proveedor'].'">'.$rowProv['Nombre_Proveedor'].'</option>';  
                          }
                        ?>
                  
                </select>
                </div>
              </div>



          <div class="form-group" id="form_codigo_factura">
                <label for="codigo_factura" class="col-sm-2 control-label">Codigo Factura*</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="codigo_factura" name="codigo_factura" placeholder="Ingrese el numero..">
                </div>
              </div>


<div class="form-group" id="form_usuario">
                  <label for="usuario" class="col-sm-2 control-label">Usuario*</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="usuario" placeholder="Usuario" value="<?php echo $_SESSION['Nombre'];?>" readonly>
                    <input type="hidden" id="codigo_usuario" value="<?php echo $_SESSION['Id_Usuario'];?>">
                  </div>
                </div>

             <div class="form-group" id="form_codigo_orden">
                <label for="orden_compra" class="col-sm-2 control-label">Codigo Orden Compra*</label>

                <div class="col-sm-9">
                   <select class="form-control select2" id="orden_compra" name="orden_compra" style="width: 100%;" p>
                   <option value="">Seleccione Orden Compra</option>
                   <?php 
                          $queryListaProv=mysqli_query($db, "SELECT * FROM ordenes_compra") or die(mysqli_error());
                          while ($rowProv=mysqli_fetch_array($queryListaProv)) {
                            echo '<option value="'.$rowProv['Id_Orden_Compra'].'">'.$rowProv['Id_Orden_Compra'].'</option>';  
                          }
                        ?>
                  
                </select>
                </div>
                </div>
              </div>
              
            <!-- /.box-body -->
            <div class="box-footer">
              <!-- <button type="submit" class="btn btn-default">Cancel</button>
              <button type="submit" class="btn btn-info pull-right">Sign in</button> -->
            </div>
            <!-- /.box-footer -->
          </form>
        </div>




<div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Datos de Producto</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form  name="frmdatos" class="form-horizontal">
            <div class="box-body">





      
<div class="col-md-4" style="margin-left: 40px;">
  <div class="form-group">Producto:
       <select class="form-control select2" id="txt_producto" name="txt_producto" style="width: 100%;" p>
                   <option value="">Seleccione Producto</option>
                   <?php 
                          $queryListaProv=mysqli_query($db, "SELECT * FROM articulos") or die(mysqli_error());
                          while ($rowProv=mysqli_fetch_array($queryListaProv)) {
                            echo '<option value="'.$rowProv['Id_Articulo'].'">'.$rowProv['Descripcion'].'</option>';  
                          }
                        ?>
                  
                </select>
        </div>
      </div>
     <div class="col-md-2" style="margin-left: 40px;">
        <div class="form-group">Cantidad:
          <input id="txt_cantidad"  style="width: 200px;  "  name="txt_cantidad" type="text" class="col-md-2 form-control" placeholder="Ingrese cantidad" autocomplete="off" onkeypress="return numeros(event)" />
        </div>
      </div>
       <div class="col-md-2" style="margin-left: 40px;">
        <div class="form-group" >Existencia Minima:
          <input id="txt_existencia"   style="width: 200px;" name="txt_existencia" type="text" class="col-md-2 form-control" placeholder="Ingrese Existencia" autocomplete="off" onkeypress="return numeros(event)"onkeyup="evaluacion()"/>
        </div>
      </div>
      <div class="col-md-2" style="margin-left: 40px;">
        <div class="form-group" >Costo:
          <input id="txt_costo"   style="width: 200px;" name="txt_costo" type="text" class="col-md-2 form-control" placeholder="Ingrese costo" autocomplete="off" onkeypress="return numeros(event)"onkeyup="evaluacion()"/>
        </div>
      </div>
      <div class="col-md-2" style="margin-left: 40px;">
        <div class="form-group">Porcentaje:
          <input id="txt_porcentaje"   style="width: 200px;" name="txt_porcentaje" type="text" class="col-md-2 form-control" placeholder="Ingrese porcentaje" autocomplete="off" onkeypress="return numeros(event)" onkeyup="evaluacion()"/>
        </div>
      </div>
      <div class="col-md-2" style="margin-left: 40px;">
        <div class="form-group">Precio Final:
          <input id="txt_precio"   style="width: 200px;"  name="txt_precio" type="text" class="col-md-2 form-control" readonly="" />
        </div>
      </div>



      <div class="col-md-2">
        <div style="margin-top: 19px;">
        <button type="button" class="btn btn-success btn-agregar-producto">Agregar</button>
          
        </div>
      </div>
      
      </div>
    
    </div>
       </div>
              </div>
            
            
          </form>

<br>
<div class="panel panel-info">
 <div class="panel-heading">
  <h3 class="panel-title">Productos</h3>


   </div>
   <button type="button" id="btnDetalle" name="btnDetalle" class="btn btn-success guardar-carrito">Cargar Detalle</button>
   <div class="panel-body detalle-producto">
        <?php if(count($_SESSION['detalle'])>0){?>
          <table class="table">
              <thead>
                  <tr>
                     <th>C&oacute;digo</th>
                      <th>Compra</th>
                      <th>Descripci&oacute;n</th>
                      <th>Cantidad</th>
                       <th>Existencia</th>
                      <th>Costo</th>
                      <th>Porcentaje</th>
                       <th>Precio Final</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                foreach($_SESSION['detalle'] as $k => $detalle){ 
                ?>
                  <tr>
                  <td><?php echo $detalle['codigo'];?></td> 
                  <td><?php echo $detalle['proveedor'];?></td>
                    <td><?php echo $detalle['producto'];?></td>
                      <td><?php echo $detalle['cantidad'];?></td>
                       <td><?php echo $detalle['existencia'];?></td>
                       <td><?php echo $detalle['costo'];?></td>
                        <td><?php echo $detalle['porcentaje'];?></td>
                      <td><?php echo $detalle['precio'];?></td>
                      <td><button type="button" class="btn btn-sm btn-danger eliminar-producto" id="<?php echo $detalle['id'];?>">Eliminar</button></td>
                  </tr>
                  <?php }?>
              </tbody>
          </table>
        <?php }else{?>
        <div class="panel-body"> No hay productos agregados</div>
        <?php }?>
      </div>
    </div>







         
        <div class="box box-info">
          <!-- <div class="box-header with-border"> -->
            <!-- <h3 class="box-title">Acciones</h3> -->
          <!-- </div> -->
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="col-sm-4"></div>
              <div class="col-sm-4">
                <button type="button" id="btnCancelar" class="btn btn-default">Cancelar</button>

                

                <button type="button" id="btnRegistrar" class="btn btn-success"> Registrar</button>


              </div>
              <div class="col-sm-4"></div>
            </div>
            <!-- /.box-body -->
          </form>
        </div>
      </div>
      <!--/.col (izq) -->
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->  

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>, <a href="https://fezvrasta.github.io">Federico Zivolo</a> and <a href="https://ducthanhnguyen.github.io">Thanh Nguyen</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<script src="<?php echo $cd;?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $cd;?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Material Design -->
<script src="<?php echo $cd;?>dist/js/material.min.js"></script>
<script src="<?php echo $cd;?>dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>
<!-- DataTables -->
<script src="<?php echo $cd;?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $cd;?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo $cd;?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap notify -->
<script src="<?php echo $cd;?>plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo $cd;?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $cd;?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- InputMask -->
<script src="<?php echo $cd;?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo $cd;?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo $cd;?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $cd;?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $cd;?>dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#lista-empleados').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
    //Date picker
  
  })
  $(document).ready(function () {
    $('.sidebar-menu').tree();
    $('[data-mask]').inputmask()
    // $('#lista-empleados').DataTable();

    function alertaIngresarDatos(){
      $.notify({
        title: "Error : ",
        message: "Por favor, complete los campos obligatorios",
        icon: 'fa fa-times' 
      },{
        type: "danger"
      });
    }

    $("#btnCancelar").click(function(){
      $(location).attr('href', 'registro_compras.php');
    });

    $("#btnRegistrar").click(function(){
      //Obtencion de valores en los inputs
     var codigo=$('#txt_codigo').val();
     var proveedor_articulo=$('#proveedor_articulo').val();
     var codigo_factura=$('#codigo_factura').val();
     var orden_compra=$('#orden_compra').val();
     var usuario=$('#usuario').val();

   


      
      // Validaciones
      if (codigo=='') {
        $("#codigo").attr('required',true);
        document.getElementById("codigo").focus();
        $("#form_codigo").removeClass('has-success');
        $("#form_codigo").removeClass('has-error');
        $("#form_codigo").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#codigo").attr('required',false);
        $("#form_codigo").removeClass('has-success');
        $("#form_codigo").removeClass('has-error');
        $("#form_codigo").addClass('has-success');
      }

      
      if (proveedor_articulo=='') {
        $("#proveedor_articulo").attr('required',true);
        document.getElementById("proveedor_articulo").focus();
        $("#form_proveedor").removeClass('has-success');
        $("#form_proveedor").removeClass('has-error');
        $("#form_proveedor").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#proveedor_articulo").attr('required',false);
        $("#form_proveedor").removeClass('has-success');
        $("#form_proveedor").removeClass('has-error');
        $("#form_proveedor").addClass('has-success');
      }
       if (codigo_factura=='') {
        $("#codigo_factura").attr('required',true);
        document.getElementById("codigo_factura").focus();
        $("#form_codigo_factura").removeClass('has-success');
        $("#form_codigo_factura").removeClass('has-error');
        $("#form_codigo_factura").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#codigo_factura").attr('required',false);
        $("#form_codigo_factura").removeClass('has-success');
        $("#form_codigo_factura").removeClass('has-error');
        $("#form_codigo_factura").addClass('has-success');
      }

 if (usuario=='') {
        $("#usuario").attr('required',true);
        document.getElementById("usuario").focus();
        $("#form_usuario").removeClass('has-success');
        $("#form_usuario").removeClass('has-error');
        $("#form_usuario").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#usuario").attr('required',false);
        $("#form_usuario").removeClass('has-success');
        $("#form_usuario").removeClass('has-error');
        $("#form_usuario").addClass('has-success');
      }

      if (orden_compra=='') {
        $("#orden_compra").attr('required',true);
        document.getElementById("orden_compra").focus();
        $("#form_codigo_orden").removeClass('has-success');
        $("#form_codigo_orden").removeClass('has-error');
        $("#form_codigo_orden").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#orden_compra").attr('required',false);
        $("#form_codigo_orden").removeClass('has-success');
        $("#form_codigo_orden").removeClass('has-error');
        $("#form_codigo_orden").addClass('has-success');
      }

      //Fin validaciones

      // Variable con todos los valores necesarios para la consulta
      var datos = 'codigo=' + codigo + '&proveedor_articulo=' + proveedor_articulo + '&codigo_factura=' + codigo_factura + '&usuario='+ usuario +'&orden_compra=' + orden_compra;

      //alert(datos);
      $.ajax({
        //Direccion destino
        url: "registrar_compras.php",
        // Variable con los datos necesarios
        data: datos,
        type: "POST",     
        dataType: "html",
        //cache: false,
        //success
        success: function (data) {
        //alert(data);
          if (data) {
            $.notify({
              title: "Correcto : ",
              message: "¡La Compra se registró exitosamente!",
              icon: 'fa fa-check' 
            },{
              type: "success"
            });
           window.setTimeout('location.href="registro_compras.php"', 5);
          }
          if (!data) {
            $.notify({
              title: "Error : ",
              message: "¡El numero de Factura ingresado ya existe!",
              icon: 'fa fa-times' 
            },{
              type: "danger"
            });
            document.getElementById("codigo_factura").focus();
            $("#form_codigo_factura").removeClass('has-success');
            $("#form_codigo_factura").removeClass('has-error');
            $("#form_codigo_factura").addClass('has-error');
          }
          
        },
        error : function(xhr, status) {
          //  alert('Disculpe, existió un problema');
        },
        complete : function(xhr, status) {
          // alert('Petición realizada');
          // $.notify({
          //    title: "Informacion : ",
          //    message: "Petición realizada!",
          //    icon: 'fa fa-check' 
          //  },{
          //    type: "info"
          // });
        }   
      });

    });
  })
</script>
</body>
</html>
<?php
  }
?>
