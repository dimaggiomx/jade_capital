<?php
ob_start();
session_start();
header("Content-Type: text/html;charset=utf-8");
require_once("global.config.php");
require_once("config.php");
require_once('sescheck.php'); // para la sesion


// pinto los paises
require_once(C_P_CLASES."utils/html.functions.php"); // HTML functions
$myHTML = new HTML("",$DBcon);
$myHTML->set_newInputName('c_estado');
$myHTML->fill_query('estados','','','nombre','abrev');

$selectEstados = $myHTML->set_selectBox("",0,'form-control');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('includes/iheader.php'); ?>
    <title><?php echo C_P_TITLE; ?> - Mi Perfil</title>
    <?php include ('includes/icss.php'); ?>
    <!-- Para carga de imagenes/documentos -->
    <link href="../plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <!-- Date picker plugins css -->
    <link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link type="text/css" rel="stylesheet" href="../plugins/bower_components/jsgrid/dist/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="../plugins/bower_components/jsgrid/dist/jsgrid-theme.min.css" />

</head>
<body class="fix-sidebar fix-header">
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    <!-- Mensajes de resultado -->
    <div id="r_resultErrDiv" class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-danger myadmin-alert-bottom alertbottom"> <i class="ti-user"></i> Bienvenido <a href="#" class="closed">&times;</a> </div>
    <div id="r_resultOkDiv" class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-success myadmin-alert-bottom alertbottom"> <i class="ti-user"></i> Bienvenido <a href="#" class="closed">&times;</a> </div>
    <!--div id="r_resultDebDiv" class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-dark myadmin-alert-top alerttop"> <i class="ti-user"></i> DEB <a href="#" class="closed">&times;</a> </div-->
    <div id="alerttopright" class="myadmin-alert myadmin-alert-img alert-info myadmin-alert-top-right"> <a href="#" class="closed">&times;</a>
        <h4>You have a Message!</h4>
        <b>John Doe</b> sent you a message.</div>
    <!-- END  msg -->
    <!-- Top Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="ti-menu"></i>
            </a>
            <?php include ('includes/inavvar.php'); ?>
            <!-- SEARCH Position -->
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light">
                        <i class="icon-arrow-left-circle ti-menu"></i></a></li>
                <li>
                    <form role="search" class="app-search hidden-xs">
                        <input type="text" placeholder="Search..." class="form-control">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>
                </li>
            </ul>
            <!-- END SEARCH Position -->
            <ul class="nav navbar-top-links navbar-right pull-right">
                <?php include ('includes/imsg.php'); ?>
                <?php include ('includes/imenu.php'); ?>
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!-- Left navbar-header -->

    <!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Nuevo Proyecto</h4>
                    <input type="hidden"  id="idP" name="idP" >
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">Starter Page</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>


            <!-- .negocio -->
            <div class="row">
                <div class="panel panel-info">
                    <div class="panel-heading" id="divDatosNegocio"> <i data-icon="/" class="fa fa-bank"></i> PROYECTOS</div>
                    <div class="panel-body">
                        <form id="formProyecto" action="project_nuevo.php" class="form-horizontal form-bordered">
                            <div class="form-body">

                                <div class="form-group">
                                    <label for="exampleInputpwd2">Nombre del Proyecto</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-user"></i></div>
                                        <input type="text" class="form-control" id="c_nombre" name="c_nombre" placeholder="Nombre del Proyecto">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Industria</label>
                                        <select class="form-control" id="c_sector" name="c_sector">
                                            <option>--Tipo de Industria--</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Industria</label>
                                        <?php echo $selectEstados; ?>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-success" id="btn-registro"> <i class="fa fa-check"></i> Registrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--./row-->

            <!-- .right-sidebar -->
            <?php include ('rightnav.php'); ?>
            <!-- /.right-sidebar -->
        </div>
        <!-- /.container-fluid -->
        <?php include ('includes/ifooter.php'); ?>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php include ('includes/iscripts.php'); ?>
<!-- Custom procesar -->
<script src="tproyectos/ps_nuevo.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script type="text/javascript">

  //  $(".sidebar").hide();
</script>
</body>
</html>
