<?php
ob_start();
session_start();
header("Content-Type: text/html;charset=utf-8");
require_once("global.config.php");
require_once("config.php");
require_once('sescheck.php'); // para la sesion

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('includes/iheader.php'); ?>
    <title><?php echo C_P_TITLE; ?> - BACKOFFICE</title>
    <?php include ('includes/icss.php'); ?>
    <!-- para las tablas -->
    <link href="../plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="fix-sidebar fix-header"  onload="paginateMe(1)">
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    <!-- Top Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="ti-menu"></i>
            </a>
            <?php include ('includes/inavvar_alt.php'); ?>
            <!-- SEARCH Position -->
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light">
                        <i class="icon-arrow-left-circle ti-menu"></i></a></li>
                <li>
                    <form role="search" class="app-search hidden-xs" name="searchMe" id="searchMe">
                        <input type="text" placeholder="Search..." class="form-control">
                        <input type="hidden" placeholder="Search..." class="form-control" name="page" id="page">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>
                </li>
            </ul>
            <!-- END SEARCH Position -->
            <ul class="nav navbar-top-links navbar-right pull-right">
                <?php //include ('includes/imsg.php'); ?>
                <?php include ('includes/imenu.php'); ?>
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!-- Left navbar-header -->
    <?php include ('leftnav.php'); ?>
    <!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Starter Page</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">Starter Page</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- .row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Proyectos Aprobados</h3>
                        <!--p class="text-muted m-b-30">Data table example</p-->
                        <div class="table-responsive" id="resDiv" name="resDiv">

                        </div>
                    </div>
                </div>
            </div>
            <!-- end Row -->
            <!-- /.modal -->
            <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Crear Subasta</h4>
                        </div>
                        <form id="formSubasta" name="formSubasta" action="project_aprob.php" method="post">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="message-text" class="control-label">Fecha de Inicio:</label>
                                    <input type="text" class="form-control" id="cinicio" name="cinicio"></input>
                                </div>
                                <div class="form-group">
                                    <label for="message-text2" class="control-label">Fecha de Fin:</label>
                                    <input type="text" class="form-control" id="cfin" name="cfin"></input>
                                </div>
                                <div class="form-group">
                                    <label for="message-text3" class="control-label">Monto:</label>
                                    <input type="text" class="form-control" id="cmonto" name="cmonto"></input>
                                </div>
                                <input type="hidden" class="form-control" id="cidproyecto" name="cidproyecto"></input>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="btn-rechazar">Close</button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light" id="btn-subasta">Generar Subasta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
<!-- Custom Theme JavaScript -->
<script src="tvalidar/ps_aprobados.js"></script>
<!-- para las tablas -->
<script src="../plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
