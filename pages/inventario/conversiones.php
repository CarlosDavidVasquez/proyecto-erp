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
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
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
        Conversiones
        <small>Inventario</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Inventario</a></li>
        <li class="active">Conversiones</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-floppy-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><h4>Ingresos</h4></span>
              <span class="info-box-number">
                <?php 
                  $queryConversiones=mysqli_query($db, "SELECT COUNT(*) AS Conversiones_Ingresos FROM conversiones WHERE Tipo = 1") or die(mysqli_error());
                  $rowCoversionesIngresadas=mysqli_fetch_array($queryConversiones);
                  echo $rowCoversionesIngresadas['Conversiones_Ingresos'];
                  //mysqli_close($queryEmpleadosDesabilitados);
                ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-list-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><h4>Total Registros</h4></span>
              <span class="info-box-number">
                <?php 
                  $queryTotalConversiones=mysqli_query($db, "SELECT COUNT(*) AS Total_Conversiones FROM conversiones") or die(mysqli_error());
                  $rowCoversiones=mysqli_fetch_array($queryTotalConversiones);
                  echo $rowCoversiones['Total_Conversiones'];
                  // mysqli_close($queryTotalEmpleados);
                ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa  fa-cut (alias)"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><h4>Rebajas</h4></span>
              <span class="info-box-number">
                <?php 
                  $queryConversiones=mysqli_query($db, "SELECT COUNT(*) AS Conversiones_Ingresos FROM conversiones WHERE Tipo = 0") or die(mysqli_error());
                  $rowCoversionesIngresadas=mysqli_fetch_array($queryConversiones);
                  echo $rowCoversionesIngresadas['Conversiones_Ingresos'];
                  //mysqli_close($queryEmpleadosDesabilitados);
                ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Entradas y Salidas de Inventario</h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                <button type="button" class="btn btn-info"><a href="conversiones_registrar.php">
                  <i class="fa fa-plus"></i> <b>Registrar Nuevo</b></button></a>
              </div>
              <!-- /. tools -->
            </div>

            <div class="box-body">
              <table id="lista-conversiones" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Código</th>
                    <th>Código de Artículo</th>
                    <th>Cantidad Inicial</th>
                     <th>Cantidad Final</th>
                    <th>Cantidad Convertida</th>
                    <th>Tipo de Transacción</th>
                    <th>Fecha Emisión</th>
                    <th>Justificación</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $queryConversiones=mysqli_query($db, "SELECT * FROM conversiones") or die(mysqli_error());
                    while ($rowCoversiones=mysqli_fetch_array($queryConversiones)) {
                      $etiqueta = null;
                      $tootip = null;
                      $icono = null;
                      $color = null;
                      switch ($rowCoversiones["Tipo"]) {
                        case 1:
                          $etiqueta = "<small class='label bg-blue'>Entradas</small>";
                          $tootip = "Salidas";
                          $icono = "fa fa-times-circle";
                          $color = "danger";
                          break;
                        case 0:
                          $etiqueta = "<small class='label bg-red'>Salidas</small>";
                          $tootip = "Entradas";
                          $icono = "fa fa-check-circle";
                          $color = "info";
                          break;
                      }
                      echo '
                        <tr>
                            <td>'.$rowCoversiones['Id_Conversion'].'</td>
                            <td>'.$rowCoversiones['Id_Articulo'].'</td>
                            <td>'.$rowCoversiones['Cantidad_Inicial'].'</td>
                             <td>'.$rowCoversiones['Cantidad_Final'].'</td>
                             <td>'.$rowCoversiones['Cantidad'].'</td>
                            <td>'.$etiqueta.'</td>
                             <td>'.$rowCoversiones['Fecha'].'</td>
                             <td>'.$rowCoversiones['Justificacion'].'</td>
                            <td>
                              
                            </td>
                          </form>
                        </tr>
                      ';
                    }
                  ?>
                </tbody>
                <!-- <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                </tfoot> -->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

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
<!-- SlimScroll -->
<script src="<?php echo $cd;?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $cd;?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- Sweet Alert -->
<script src="<?php echo $cd;?>plugins/sweet-alert/sweetalert.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $cd;?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $cd;?>dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#lista-conversiones').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
  })
  $(document).ready(function () {
    $('.sidebar-menu').tree();
    // $('#lista-empleados').DataTable();


  $('.sweetalert').click(function(){
    var codigoEmpleado = $(this).attr('id');
    var accion = $(this).attr('class');
    accion = accion.split(" ");
    var nuevoEstado;
    if (accion[4]=='Habilitar') {
      nuevoEstado = 1;
    } else {
      nuevoEstado = 0;
    }
    // alert(accion[4] + " - " + nuevoEstado);
    swal({
        title: "¿Esta seguro?",
        text: "Esta accion " + accion[4] + "á el elemento seleccionado",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        $.ajax({
          //Direccion destino
          url: "empleados_cambiar_estado.php",
          // Variable con los datos necesarios
          data: "codigo_empleado=" + codigoEmpleado + "&estado=" + nuevoEstado,
          type: "POST",     
          dataType: "html",
          //cache: false,
          //success
          success: function (data) {
            // alert(data);
            setTimeout(function () {
              if (data) {
                swal({
                  title: "¡Realizado!",
                  text: "La acción se ha completado con éxito.",
                  type: "success",
                  showCancelButton: false,
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false
                }, function(isConfirm) {
                  if (isConfirm) {
                    window.setTimeout('location.href="empleados.php"', 3);
                  }
                });
              }
              if (!data) {
                swal({
                  title: "¡Error!",
                  text: "Ha ocurrido un problema, inténtelo más tarde.",
                  type: "error",
                  showCancelButton: false,
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: true
                });
              }
            }, 2000);
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
    });
  })
</script>
</body>
</html>
<?php
}
?>
