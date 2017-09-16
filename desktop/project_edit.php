<?php
ob_start();
session_start();
header("Content-Type: text/html;charset=utf-8");
require_once("global.config.php");
require_once("config.php");
require_once('sescheck.php'); // para la sesion

$idProyecto = $_GET["id"];

if(isset($_SESSION["ses_idP"]))
{
    unset($_SESSION["ses_idP"]);
}
$_SESSION["ses_idP"] = $idProyecto;

require_once(C_P_CLASES."actions/a.proyectos.php"); // PROYECTO functions
$miProyecto = new A_PRO("");
$datosProy = $miProyecto->get_datosproyecto($DBcon, $idProyecto);
$datosFiscales = $miProyecto->get_datosfiscales($DBcon, $idProyecto);
$datosBancarios = $miProyecto->get_datosbancarios($DBcon, $idProyecto);


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
    <?php include ('projectnav.php'); ?>
    <!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title"><?php echo $datosProy->cname; ?></h4>
                    <input type="hidden"  id="idP" name="idP" value="<?php echo $idProyecto; ?>" >
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">Starter Page</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- .datos generales -->
            <div class="row">
                <div class="panel panel-info" id="divDatosGenerales">
                <div class="panel-heading"> <i data-icon="/" class="fa fa-book"></i> Datos Generales</div>
                <div class="col-md-6">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Datos Generales</h3>
                        <div id="graf-generales">

                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form id="formGenerales" action="project_edit.php">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Nombre Proyecto</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-folder"></i></div>
                                            <input type="text" class="form-control" id="cg_nombrep" name="cg_nombrep" placeholder="Nombre del proyecto" value="<?php echo $datosProy->cname; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>Industria</label>
                                            <select class="form-control" id="cg_sector" name="cg_sector">
                                                <option>--Tipo de Industria--</option>
                                                <option>A</option>
                                                <option>B</option>
                                                <option>C</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputpwd1">Video</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-control-play"></i></div>
                                            <input type="text" class="form-control" id="cg_video" name="cg_video" placeholder="URL del video de Youtube" value="<?php echo $datosProy->cvideo; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputpwd2">Sitio Web del Proyecto</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-world"></i></div>
                                            <input type="text" class="form-control" id="cg_www" name="cg_www" placeholder="www" value="<?php echo $datosProy->cwww; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputpwd2">Facebook  del Proyecto</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-facebook"></i></div>
                                            <input type="text" class="form-control" id="cg_fb" name="cg_fb" placeholder="Fb" value="<?php echo $datosProy->cfb; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputpwd2">Twitter  del Proyecto</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-twitter-alt"></i></div>
                                            <input type="text" class="form-control" id="cg_tw" name="cg_tw" placeholder="tw" value="<?php echo $datosProy->ctw; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputpwd2">Instagram  del Proyecto</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-instagram"></i></div>
                                            <input type="text" class="form-control" id="cg_insta" name="cg_insta" placeholder="Instagram" value="<?php echo $datosProy->cins; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputpwd2">LinkedIn del Proyecto</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-linkedin"></i></div>
                                            <input type="text" class="form-control" id="cg_linkedin" name="cg_linkedin" placeholder="Linkedin" value="<?php echo $datosProy->clinkedin; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">Representante Legal</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-folder"></i></div>
                                            <input type="text" class="form-control" id="cg_replegal" name="cg_replegal" placeholder="Nombre del Representante Legal" value="<?php echo $datosFiscales->creplegal; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">CURP Rep. Legal</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-folder"></i></div>
                                            <input type="text" class="form-control" id="cg_curp" name="cg_curp" placeholder="CURP del Representante Legal" value="<?php echo $datosFiscales->creplegalcurp; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">Tel. Rep. Legal </label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-folder"></i></div>
                                            <input type="text" class="form-control" id="cg_tel" name="cg_tel" placeholder="Tel. del Representante Legal" value="<?php echo $datosFiscales->creplegaltel; ?>">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-cg">Submit</button>
                                    <button type="submit" class="btn btn-inverse waves-effect waves-light" id="btn-cgcancel">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Datos Fiscales</h3>
                        <div id="graf-fiscales">

                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form id="formFiscales" action="project_edit.php">
                                    <div class="form-group">
                                        <label for="exampleInputuname">RFC</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cf_rfc" name="cf_rfc" placeholder="Registro Federal de Causantes" value="<?php echo $datosFiscales->crfc; ?>">
                                            <div class="input-group-addon"><i class="ti-file"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">Nombre</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cf_nombre" name="cf_nombre" placeholder="Nombre" value="<?php echo $datosFiscales->cnombre; ?>">
                                            <div class="input-group-addon"><i class="ti-flag"></i></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>País</label>
                                            <select class="form-control" id="cf_pais" name="cf_pais">
                                                <option>--Selecciona el País--</option>
                                                <option>A</option>
                                                <option>B</option>
                                                <option>C</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>Estado</label>
                                            <select class="form-control" id="cf_estado" name="cf_estado">
                                                <option>--Seleccione Estado--</option>
                                                <option>A</option>
                                                <option>B</option>
                                                <option>C</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">Calle</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cf_calle" name="cf_calle" placeholder="Calle" value="<?php echo $datosFiscales->ccalle; ?>">
                                            <div class="input-group-addon"><i class="ti-map-alt"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">No. Ext</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cf_noext" name="cf_noext" placeholder="Numero exterior" value="<?php echo $datosFiscales->cnoext; ?>">
                                            <div class="input-group-addon"><i class="ti-home"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">No. Int</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cf_noint" name="cf_noint" placeholder="Numero interior" value="<?php echo $datosFiscales->cnoint; ?>">
                                            <div class="input-group-addon"><i class="ti-home"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">Colonia</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cf_colonia" name="cf_colonia" placeholder="Colonia" value="<?php echo $datosFiscales->ccolonia; ?>">
                                            <div class="input-group-addon"><i class="ti-home"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">Municipio</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cf_municipio" name="cf_municipio" placeholder="Municipio" value="<?php echo $datosFiscales->cmunicipio; ?>">
                                            <div class="input-group-addon"><i class="ti-home"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">C.P.</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cf_cp" name="cf_cp" placeholder="Codigo Postal" value="<?php echo $datosFiscales->ccp; ?>">
                                            <div class="input-group-addon"><i class="ti-home"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">Fecha de registro</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cf_regdate" name="cf_regdate" placeholder="Registro de la empresa" value="<?php echo $datosFiscales->cfecharegistro; ?>">
                                            <div class="input-group-addon"><i class="ti-calendar"></i></div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-cf">Submit</button>
                                        <button type="submit" class="btn btn-inverse waves-effect waves-light" id="btn-cfcancel">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Logo del Proyecto</h3>
                        <div  id="graf-logo">
                            <p> <strong>Avance:</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                            </div>
                        </div>
                        <form action="documents/ps_logoproyecto.php" class="dropzone" id="dropzoneLogo">
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Credencial / ID digitalizada</h3>
                        <div  id="graf-idproyecto">
                            <p> <strong>Avance:</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                            </div>
                        </div>
                        <form action="documents/ps_idproyecto.php" class="dropzone" id="dropzoneid">
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            <!--./row-->
            <!--.datos inversion-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading" id="divDatosInversion"> <i data-icon="/" class="fa fa-money"></i> Datos de Inversión y Bancarios</div>
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">

                                    <div class="form-body">
                                        <form class="form-horizontal" id="formInversion" action="project_edit.php">
                                        <h3 class="box-title">Datos de Inversión</h3>
                                        <div id="graf-inversion">

                                        </div>
                                        <hr class="m-t-0 m-b-40">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Monto ($)</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" placeholder="Monto de inversión solicitado" id="ci_monto" name="ci_monto"  value="<?php echo $datosProy->cmetamin; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Fin de los Recursos </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" placeholder="Fin de los recursos" id="ci_finrecursos" name="ci_finrecursos"  value="<?php echo $datosProy->cfinrecursos; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">¿Startup?</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" id="ci_startup" name="ci_startup">
                                                            <option value="1">SI</option>
                                                            <option value="0">NO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Duración</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" placeholder="dias" id="ci_dias" name="ci_dias"  value="<?php echo $datosProy->cmeses; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button type="submit" class="btn btn-success" id="btn-ci">Submit</button>
                                                            <button type="button" class="btn btn-default" id="btn-cicancel">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> </div>
                                            </div>
                                        </div>
                                        </form>

                                        <form class="form-horizontal" id="formBancarios" action="project_edit.php">
                                        <h3 class="box-title">Datos Bancarios</h3>
                                        <div id="graf-bancarios">

                                        </div>
                                        <hr class="m-t-0 m-b-40">
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Banco</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="cb_banco" name="cb_banco" value="<?php echo $datosBancarios->cp_nombre; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">E-mail</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="cb_email" name="cb_email" value="<?php echo $datosBancarios->cp_email; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">CLABE</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="cb_clabe" name="cb_clabe"  value="<?php echo $datosBancarios->cp_clabe; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Titular</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="cb_titular" name="cb_titular"  value="<?php echo $datosBancarios->cp_titular; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">RFC Titular</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="cb_rfctitular" name="cb_rfctitular"  value="<?php echo $datosBancarios->cp_rfc; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>

                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn btn-success" id="btn-cb">Submit</button>
                                                                <button type="button" class="btn btn-default" id="btn-cbcancel">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"> </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="white-box">
                                            <h3 class="box-title m-b-0">Recibo Banco</h3>
                                            <form action="documents/ps_bankproyecto.php" class="dropzone" id="dropzoneMyBank">
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--./row-->
            <!-- .idea -->
            <div class="row">
                <div class="panel panel-info">
                    <div class="panel-heading" id="divDatosIdea"> <i data-icon="/" class="fa fa-lightbulb-o"></i> Idea y Producto</div>
                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Producto</h3>
                            <div>
                                <p> <strong>Avance:</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form id="formProducto" action="project_edit.php">
                                        <div class="form-group">
                                            <label for="exampleInputuname">Descripción</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-comment-alt"></i></div>
                                                <textarea class="form-control" rows="5" id="cid_descripcion" name="cid_descripcion"><?php echo $datosProy->cproducto; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label>Tipo</label>
                                                <select class="form-control" id="cid_tipo" name="cid_tipo">
                                                    <option>--Tipo de Producto--</option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputpwd1">Etapa</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-target"></i></div>
                                                <input type="text" class="form-control" id="cid_etapa" name="cid_etapa" placeholder="Etapa" value="<?php echo $datosProy->cetapa; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputpwd2">Patentes</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-pencil"></i></div>
                                                <textarea class="form-control" rows="5" id="cid_patentes" name="cid_patentes"><?php echo $datosProy->cpatente; ?></textarea>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-cid">Submit</button>
                                        <button type="submit" class="btn btn-inverse waves-effect waves-light" id="btn-cidcancel">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Idea</h3>
                            <div>
                                <p> <strong>Avance:</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form id="formIdea" action="project_edit.php">
                                        <div class="form-group">
                                            <label for="exampleInputuname">Problema</label>
                                            <div class="input-group">
                                                <textarea class="form-control" rows="5" id="cp_problema" name="cp_problema"><?php echo $datosProy->cproblema; ?></textarea>
                                                <div class="input-group-addon"><i class="ti-comment-alt"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputuname">Solución</label>
                                            <div class="input-group">
                                                <textarea class="form-control" rows="5" id="cp_solucion" name="cp_solucion"><?php echo $datosProy->csolucion; ?></textarea>
                                                <div class="input-group-addon"><i class="ti-comment-alt"></i></div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputuname">Plan de Negocio</label>
                                            <div class="input-group">
                                                <textarea class="form-control" rows="5" id="cp_negocio" name="cp_negocio"><?php echo $datosProy->cplannegocios_st; ?></textarea>
                                                <div class="input-group-addon"><i class="ti-comment-alt"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputuname">Resultados</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="cp_resultados" name="cp_resultados" placeholder="Resultados esperados" value="<?php echo $datosProy->cresultados_st; ?>">
                                                <div class="input-group-addon"><i class="ti-home"></i></div>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-cp">Submit</button>
                                            <button type="submit" class="btn btn-inverse waves-effect waves-light" id="btn-cpcancel">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--./row-->
            <!--.galeria-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading" id="divDatosGaleria"> <i data-icon="/" class="fa fa-image"></i> Galeria </div>

                        <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="white-box">
                                            <h3 class="box-title m-b-0">Showcase</h3>
                                            <div>
                                                <p> <strong>Avance:</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                                </div>
                                            </div>
                                            <form action="documents/ps_galeriaproyecto.php" class="dropzone" id="dropzoneMyGaleria">
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--./row-->

            <!-- .mercado -->
            <div class="row">
                <div class="panel panel-info">
                    <div class="panel-heading" id="divDatosMercado"> <i data-icon="/" class="fa fa-barcode"></i> Mercado</div>
                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Competencia</h3>
                            <div>
                                <p> <strong>Avance:</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form id="formCompetencia" action="project_edit.php">
                                        <div class="form-group">
                                            <label for="exampleInputuname">Competidor</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-user"></i></div>
                                                <input type="text" class="form-control" id="cc_competidor" name="cc_competidor" placeholder="Competidor">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label>Diferenciador</label>
                                                <select class="form-control" id="cc_diferenciador" name="cc_diferenciador">
                                                    <option>-- seleccionar --</option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputpwd1">Propuesta</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-comment-alt"></i></div>
                                                <textarea class="form-control" rows="5" id="cc_propuesta" name="cc_propuesta"></textarea>

                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-cc">Submit</button>
                                        <button type="submit" class="btn btn-inverse waves-effect waves-light" id="btn-cccancel">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Mercado Objetivo</h3>
                            <div>
                                <p> <strong>Avance:</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form id="formMercado" action="project_edit.php">
                                        <div class="form-group">
                                            <label for="exampleInputuname">Cliente</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="cm_cliente" name="cm_cliente" placeholder="Cliente">
                                                <div class="input-group-addon"><i class="ti-user"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputuname">Segmento</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="cm_segmento" name="cm_segmento" placeholder="Segmento">
                                                <div class="input-group-addon"><i class="ti-zoom-in"></i></div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputuname">Mercado</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="cm_mercado" name="cm_mercado" placeholder="Mercado Objetivo">
                                                <div class="input-group-addon"><i class="ti-layout-media-right"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputuname">Marketing</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="cm_marketing" name="cm_marketing" placeholder="Marketing">
                                                <div class="input-group-addon"><i class="ti-headphone-alt"></i></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputuname">Ventas Totales</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="cm_ventas" name="cm_ventas" placeholder="Ventas Totales ">
                                                <div class="input-group-addon"><i class="ti-pulse"></i></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputuname">Precio</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="cm_precio" name="cm_precio" placeholder="Precio ">
                                                <div class="input-group-addon"><i class="ti-money"></i></div>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-cm">Submit</button>
                                            <button type="submit" class="btn btn-inverse waves-effect waves-light" id="btn-cmcancel">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Competidores:</h3>

                            <div id="gridcompetencia"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Objetivos:</h3>

                            <div id="gridobjetivos"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--./row-->

            <!-- .negocio -->
            <div class="row">
                <div class="panel panel-info">
                    <div class="panel-heading" id="divDatosNegocio"> <i data-icon="/" class="fa fa-bank"></i> Negocio</div>
                    <div class="panel-body">
                        <form id="formNegocio" action="project_edit.php" class="form-horizontal form-bordered">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Supuestos Clave</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Supuestos clave" id="cn_supuestos" name="cn_supuestos" class="form-control" value="<?php echo $datosProy->csupuestosclave; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Modelo de Ingresos </label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Modelo de Ingresos" id="cn_modelo" name="cn_modelo" class="form-control" value="<?php echo $datosProy->cmodeloingresos; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Unidades Vendidas </label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Unidades Vendidas" id="cn_vendidas" name="cn_vendidas" class="form-control" value="<?php echo $datosProy->cunidades; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Precio </label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Precio" id="cn_precio" name="cn_precio" class="form-control" value="<?php echo $datosProy->cprecio; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Ingresos </label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Ingresos" id="cn_ingresos" name="cn_ingresos" class="form-control" value="<?php echo $datosProy->cingreso; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3"> Costos </label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Costos" id="cn_costos" name="cn_costos" class="form-control" value="<?php echo $datosProy->ccostos; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">CAPEX </label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="CAPEX"  id="cn_capex" name="cn_capex" class="form-control" value="<?php echo $datosProy->ccapex; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Ventas </label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Ventas" id="cn_ventas" name="cn_ventas" class="form-control" value="<?php echo $datosProy->cventas; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">EEFF </label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="EEFF" id="cn_eeff" name="cn_eeff" class="form-control" value="<?php echo $datosProy->ceeff; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Utilidad </label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Utilidad" id="cn_utilidad" name="cn_utilidad" class="form-control" value="<?php echo $datosProy->cutilidad; ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-success" id="btn-cn"> <i class="fa fa-check"></i> Submit</button>
                                                <button type="button" class="btn btn-default" id="btn-cncancel">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Fuente de Ingresos</h3>
                            <div>
                                <p> <strong>Avance:</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form id="formFuente" action="project_edit.php">
                                        <div class="form-group">
                                            <label for="exampleInputuname">Descripcion</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-comment-alt"></i></div>
                                                <textarea class="form-control" rows="5" id="cfu_descripcion" name="cfu_descripcion"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputpwd1">Valor</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-money"></i></div>
                                                <input type="text" class="form-control" id="cfu_valor" name="cfu_valor" placeholder="Valor">

                                            </div>
                                        </div>
                                        <!--div class="form-group">
                                            <label for="exampleInputpwd1">Condiciones</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-list-ol"></i></div>
                                                <input type="text" class="form-control" id="exampleInputpwd1" placeholder="Condiciones">

                                            </div>
                                        </div-->


                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn_cfu">Submit</button>
                                        <button type="submit" class="btn btn-inverse waves-effect waves-light" id="btn-cfucancel">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Distribución de Costos </h3>
                            <div>
                                <p> <strong>Avance:</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form id="formCostos" action="project_edit.php">
                                        <div class="form-group">
                                            <label for="exampleInputuname">Descripcion</label>
                                            <div class="input-group">
                                                <textarea class="form-control" rows="5" id="cco_descripcion" name="cco_descripcion"></textarea>
                                                <div class="input-group-addon"><i class="ti-comment-alt"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputuname">Valor</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="cco_valor" name="cco_valor" placeholder="Valor">
                                                <div class="input-group-addon"><i class="ti-money"></i></div>
                                            </div>
                                        </div>


                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-cco">Submit</button>
                                            <button type="submit" class="btn btn-inverse waves-effect waves-light" id="btn-ccocancel">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Fuente de Ingresos:</h3>

                            <div id="gridingresos"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Distribucion de Costos:</h3>

                            <div id="gridcostos"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!--./row-->


            <!-- .hitoria -->
            <div class="row">
                <div class="panel panel-info">
                    <div class="panel-heading" id="divDatosHistoria"> <i data-icon="/" class="fa fa-archive"></i> Historia</div>

                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Acontecimientos </h3>
                            <div>
                                <p> <strong>Avance:</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form id="formHistoria" action="project_edit.php">
                                        <div class="form-group">
                                            <label for="exampleInputuname">Descripcion</label>
                                            <div class="input-group">
                                                <textarea class="form-control" rows="5" id="ch_descripcion" name="ch_descripcion"></textarea>
                                                <div class="input-group-addon"><i class="ti-comment-alt"></i></div>
                                            </div>
                                        </div>



                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-ch">Submit</button>
                                            <button type="submit" class="btn btn-inverse waves-effect waves-light" id="btn-chcancel">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Equipo</h3>
                            <div>
                                <p> <strong>Avance:</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form id="formEquipo" action="project_edit.php">
                                        <div class="form-group">
                                            <label for="exampleInputuname">Nombre</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-comment-alt"></i></div>
                                                <input type="text" class="form-control" id="ce_nombre" name="ce_nombre" placeholder="Nombre">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputpwd1">Puesto</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-money"></i></div>
                                                <input type="text" class="form-control" id="ce_puesto" name="ce_puesto" placeholder="Puesto">

                                            </div>
                                        </div>
                                        <!--div class="form-group">
                                            <label for="exampleInputpwd1">Condiciones</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-list-ol"></i></div>
                                                <input type="text" class="form-control" id="exampleInputpwd1" placeholder="Condiciones">

                                            </div>
                                        </div-->


                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-ce">Submit</button>
                                        <button type="submit" class="btn btn-inverse waves-effect waves-light" id="btn-cecancel">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Acontecimientos:</h3>

                            <div id="gridacontecimiento"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Equipo:</h3>

                            <div id="gridequipo"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--./row-->


            <!-- .plan -->
            <div class="row">
                <div class="panel panel-info">
                    <div class="panel-heading" id="divDatosPlan"> <i data-icon="/" class="fa fa-calendar"></i> Plan</div>
                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Riesgos</h3>
                            <div>
                                <p> <strong>Avance:</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form id="formRiesgos" action="project_edit.php">
                                        <div class="form-group">
                                            <label for="exampleInputuname">Indicador</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-comment-alt"></i></div>
                                                <input type="text" class="form-control" id="cr_indicador" name="cr_indicador" placeholder="Valor">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputpwd1">Explicacion</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-money"></i></div>
                                                <input type="text" class="form-control" id="cr_explicacion" name="cr_explicacion" placeholder="Valor">

                                            </div>
                                        </div>
                                        <!--div class="form-group">
                                            <label for="exampleInputpwd1">Condiciones</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-list-ol"></i></div>
                                                <input type="text" class="form-control" id="exampleInputpwd1" placeholder="Condiciones">

                                            </div>
                                        </div-->


                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-cr">Submit</button>
                                        <button type="submit" class="btn btn-inverse waves-effect waves-light" id="btn-crcancel">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Plan Asignacion </h3>
                            <div>
                                <p> <strong>Avance:</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form id="formPlan" action="project_edit.php">
                                        <div class="form-group">
                                            <label for="exampleInputuname">Explicacion</label>
                                            <div class="input-group">
                                                <textarea class="form-control" rows="5" id="cpl_explicacion" name="cpl_explicacion"></textarea>
                                                <div class="input-group-addon"><i class="ti-comment-alt"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputuname">porcentaje</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="cpl_porcentaje" name="cpl_porcentaje" placeholder="Valor">
                                                <div class="input-group-addon"><i class="ti-money"></i></div>
                                            </div>
                                        </div>


                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-cpl">Submit</button>
                                            <button type="submit" class="btn btn-inverse waves-effect waves-light" id="btn-cplcancel">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Riesgos:</h3>

                            <div id="gridriesgos"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Plan de asignacion:</h3>

                            <div id="gridplan"></div>
                        </div>
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
<script src="tproyectos/ps_editar.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Editable -->
<script src="../plugins/bower_components/jsgrid/db.js"></script>
<script type="text/javascript" src="../plugins/bower_components/jsgrid/dist/jsgrid.min.js"></script>
<!-- para la carga de documentos -->
<script src="../plugins/bower_components/dropzone-master/dist/dropzone.js"></script>
<script type="text/javascript">

    $(function(){
        Dropzone.options.dropzoneLogo = {
            maxFilesize: 1,
            addRemoveLinks: true,
            dictResponseError: 'Server not Configured',
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            maxFiles: 1,
            init:function(){
                var self = this;
                // config
                self.options.addRemoveLinks = true;
                self.options.dictRemoveFile = "Delete";
                //New file added
                self.on("addedfile", function (file) {
                    console.log('new file added ', file);
                });
                // Send file starts
                self.on("sending", function (file, xhr, formData) {

                    //var name = this.element.querySelector('input[name=idP]').value;

                    //formData.append('idProyecto', name);

                    console.log('upload started', file);
                    $('.meter').show();
                });

                // File upload Progress
                self.on("totaluploadprogress", function (progress) {
                    console.log("progress ", progress);
                    $('.roller').width(progress + '%');
                });

                self.on("queuecomplete", function (progress) {
                    $('.meter').delay(999).slideUp(999);
                });

                // On removing file
                self.on("removedfile", function (file) {
                    console.log(file);
                });
            }
        };
    })

    $(function(){
        Dropzone.options.dropzoneid = {
            maxFilesize: 1,
            addRemoveLinks: true,
            dictResponseError: 'Server not Configured',
            acceptedFiles: ".png,.pdf,.jpg,.gif,.bmp,.jpeg",
            maxFiles: 1,
            init:function(){
                var self = this;
                // config
                self.options.addRemoveLinks = true;
                self.options.dictRemoveFile = "Delete";
                //New file added
                self.on("addedfile", function (file) {
                    console.log('new file added ', file);
                });
                // Send file starts
                self.on("sending", function (file, xhr, formData) {

                    //var name = this.element.querySelector('input[name=idP]').value;

                    //formData.append('idProyecto', name);

                    console.log('upload started', file);
                    $('.meter').show();
                });

                // File upload Progress
                self.on("totaluploadprogress", function (progress) {
                    console.log("progress ", progress);
                    $('.roller').width(progress + '%');
                });

                self.on("queuecomplete", function (progress) {
                    $('.meter').delay(999).slideUp(999);
                });

                // On removing file
                self.on("removedfile", function (file) {
                    console.log(file);
                });
            }
        };
    })

    //
    $(function(){
        Dropzone.options.dropzoneMyBank = {
            maxFilesize: 1,
            addRemoveLinks: true,
            dictResponseError: 'Server not Configured',
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.pdf",
            maxFiles: 1,
            init:function(){
                var self = this;
                // config
                self.options.addRemoveLinks = true;
                self.options.dictRemoveFile = "Delete";
                //New file added
                self.on("addedfile", function (file) {
                    console.log('new file added ', file);
                });
                // Send file starts
                self.on("sending", function (file, xhr, formData) {

                    //var name = this.element.querySelector('input[name=idP]').value;

                    //formData.append('idProyecto', name);

                    console.log('upload started', file);
                    $('.meter').show();
                });

                // File upload Progress
                self.on("totaluploadprogress", function (progress) {
                    console.log("progress ", progress);
                    $('.roller').width(progress + '%');
                });

                self.on("queuecomplete", function (progress) {
                    $('.meter').delay(999).slideUp(999);
                });

                // On removing file
                self.on("removedfile", function (file) {
                    console.log(file);
                });
            }
        };
    })

    //
    //
    $(function(){
        Dropzone.options.dropzoneMyGaleria = {
            maxFilesize: 1,
            addRemoveLinks: true,
            dictResponseError: 'Server not Configured',
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            maxFiles: 8,
            init:function(){
                var self = this;
                // config
                self.options.addRemoveLinks = true;
                self.options.dictRemoveFile = "Delete";
                //New file added
                self.on("addedfile", function (file) {
                    console.log('new file added ', file);
                });
                // Send file starts
                self.on("sending", function (file, xhr, formData) {

                    //var name = this.element.querySelector('input[name=idP]').value;

                    //formData.append('idProyecto', name);

                    console.log('upload started', file);
                    $('.meter').show();
                });

                // File upload Progress
                self.on("totaluploadprogress", function (progress) {
                    console.log("progress ", progress);
                    $('.roller').width(progress + '%');
                });

                self.on("queuecomplete", function (progress) {
                    $('.meter').delay(999).slideUp(999);
                });

                // On removing file
                self.on("removedfile", function (file) {
                    console.log(file);
                });
            }
        };
    })


    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
    });
</script>
</body>
</html>
