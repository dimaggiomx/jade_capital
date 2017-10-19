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
$datossubasta = $miProyecto->get_datossubasta($DBcon, $idProyecto);

//calculo los dias restantes
$now = time();
$last_date = strtotime($datossubasta->cfin);
$datediff = $last_date - $now;
$diasRestantes=floor($datediff/(60*60*24));

// para la galeria
$dir1 = $datosProy->idusuario;  //$_SESSION["ses_id"];
$dir2 = $_SESSION["ses_idP"];
$dir3 = "galeria";

$pathGaleria='../uploads/'.$dir1.'/'.$dir2.'/'.$dir3;
$galeriaImages = '';
// Se comprueba que realmente sea la ruta de un directorio
if (is_dir($pathGaleria)){
    // Abre un gestor de directorios para la ruta indicada
    $gestor = opendir($pathGaleria);

    // Recorre todos los archivos del directorio
    while (($archivo = readdir($gestor)) !== false)  {
        // Solo buscamos archivos sin entrar en subdirectorios
        if (is_file($pathGaleria."/".$archivo)) {
            $galeriaImages.= '<div class="item"><img src="'.$pathGaleria."/".$archivo.'" alt="Owl Image" height="500px"></div>';
        }

    }

    // Cierra el gestor de directorios
    closedir($gestor);
}


require_once(C_P_CLASES."actions/a.market.php"); // PROYECTO functions
$miMarket = new A_MARKET("");
// obtener competencia
$miMarket->get_competencia($DBcon, $idProyecto);
$dispCompetencia = $miMarket->disp_competencia();

// obtener mercado objetivo
$miMarket->get_mercado($DBcon, $idProyecto);
$dispMercado = $miMarket->disp_mercdo();

// Obtener ingresos
$miMarket->get_ingresos($DBcon, $idProyecto);
$dispIngresos = $miMarket->disp_ingresos();

// Obtener costos
$miMarket->get_costos($DBcon, $idProyecto);
$dispCostos = $miMarket->disp_costos();

// obtener Historia
$miMarket->get_historia($DBcon, $idProyecto);
$dispHistoria = $miMarket->disp_historia();

// obtener Equipo
$miMarket->get_equipo($DBcon, $idProyecto);
$dispEquipo = $miMarket->disp_equipo();

// obtener riesgos
$miMarket->get_riesgos($DBcon, $idProyecto);
$dispRiesgos = $miMarket->disp_riesgos();

// obtener plan
$miMarket->get_plan($DBcon, $idProyecto);
$dispPlan = $miMarket->disp_plan();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('includes/iheader.php'); ?>
    <title><?php echo C_P_TITLE; ?> - Mi Perfil</title>
    <?php include ('includes/icss.php'); ?>
    <!-- Para carga de imagenes/documentos -->
    <link href="../plugins/bower_components/owl.carousel/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/bower_components/owl.carousel/owl.theme.default.css" rel="stylesheet" type="text/css" />    <!-- Date picker plugins css -->
    <link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link type="text/css" rel="stylesheet" href="../plugins/bower_components/jsgrid/dist/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="../plugins/bower_components/jsgrid/dist/jsgrid-theme.min.css" />
    <link href="../plugins/bower_components/css-chart/css-chart.css" rel="stylesheet">

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
    <nav class="navbar navbar-default navbar-static-top m-b-0" >
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
    <?php include ('includes/inavviewproject.php'); ?>
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
                        <li><a href="#">Editar</a></li>
                        <li class="active">Resumen</li>
                        <li class="active">Ficha</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-md-7 col-lg-9 col-sm-12 col-xs-12">
                    <div class="white-box">
                        <iframe width="100%" height="415" src="https://www.youtube.com/embed/<?php echo $datosProy->cvideo; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">
                    <div class="bg-theme m-b-15">
                        <div class="row weather p-20">
                            <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 m-t-40">
                                <h3>&nbsp;</h3>
                                <h2><?php echo $datosProy->cname; ?></h2>
                            </div>
                            <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 text-right">
                                <img src="../<?php echo $datosProy->clogo; ?>" alt="user" class="img-circle img-responsive pull-left">
                                <br/>
                                <br/>
                                <b class="text-white"><?php echo $_SESSION["ses_cname"]; ?></b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">
                    <div class="bg-theme-dark m-b-15">
                        <div id="myCarouse2" class="carousel vcarousel slide p-20">
                            <!-- Carousel items -->
                            <div class="carousel-inner ">
                                <div class="active item">
                                    <h4 class="text-white"><span class="font-bold">Monto:</span> <?php echo $datossubasta->cmonto; ?></h4>
                                    <h4 class="text-white"><span class="font-bold">Tipo:</span> <?php echo $datosProy->ctipo; ?></h4>
                                    <h4 class="text-white"><span class="font-bold">Etapa:</span> <?php echo $datosProy->cetapa; ?></h4>
                                    <h4 class="text-white m-b-0">Patentes:</h4>
                                    <p class="text-white"><?php echo $datosProy->cpatente; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--row -->
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="white-box text-center bg-purple">
                        <h2 class="text-white counter">Producto</h2>
                        <p class="text-white"><?php echo $datosProy->cproducto; ?></p>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="white-box text-center bg-info">
                        <h2 class="text-white counter">Problema</h2>
                        <p class="text-white"><?php echo $datosProy->cproblema; ?></p>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="white-box text-center">
                        <h2 class="counter">Solución</h2>
                        <p class="text-muted"><?php echo $datosProy->csolucion; ?></p>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="white-box text-center bg-success">
                        <h2 class="text-white counter">Plan</h2>
                        <p class="text-white"><?php echo $datosProy->cplannegocios_st; ?></p>
                    </div>
                </div>
            </div>
            <!-- /row -->


            <!--.galeria-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Galeria</div>
                        <div class="panel-wrapper p-b-10 collapse in">
                            <div id="owl-demo" class="owl-carousel owl-theme">
                                <?php echo $galeriaImages; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!--./row-->

            <!-- .mercado -->
            <div class="row">
                <div class="panel panel-info">
                    <div class="panel-heading" id="divDatosMercado"> <i data-icon="/" class="fa fa-barcode"></i> Mercado</div>
                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Competidores:</h3>
                            <div class="comment-center">
                                <?php echo $dispCompetencia; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Objetivos:</h3>
                            <?php echo $dispMercado; ?>
                        </div>
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
                    <div class="col-lg-4 col-sm-4 col-xs-12 m-t-40">
                        <h3 class="box-title">Supuestos Clave</h3>
                        <blockquote><?php echo $datosProy->csupuestosclave; ?></blockquote>

                        <h3 class="box-title">Modelo de Ingresos </h3>
                        <blockquote><?php echo $datosProy->cmodeloingresos; ?></blockquote>
                    </div>
                </div>

            </div>
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="white-box text-center bg-purple">
                        <h2 class="text-white counter">Unidades Vendidas</h2>
                        <h2 class="text-white"><?php echo $datosProy->cunidades; ?></h2>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="white-box text-center bg-info">
                        <h2 class="text-white counter">Precio</h2>
                        <h2 class="text-white"><?php echo $datosProy->cprecio; ?></h2>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="white-box text-center">
                        <h2 class="counter">Ingresos</h2>
                        <h2 class="text-muted"><?php echo $datosProy->cingreso; ?></h2>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="white-box text-center bg-success">
                        <h2 class="text-white counter">Costos</h2>
                        <h2 class="text-white"><?php echo $datosProy->ccostos; ?></h2>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="white-box text-center bg-purple">
                        <h2 class="text-white counter">CAPEX</h2>
                        <h2 class="text-white"><?php echo $datosProy->ccapex; ?></h2>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="white-box text-center bg-info">
                        <h2 class="text-white counter">Ventas</h2>
                        <h2 class="text-white"><?php echo $datosProy->cventas; ?></h2>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="white-box text-center">
                        <h2 class="counter">EEFF</h2>
                        <h2 class="text-muted"><?php echo $datosProy->ceeff; ?></h2>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="white-box text-center bg-success">
                        <h2 class="text-white counter">Utilidad</h2>
                        <h2 class="text-white"><?php echo $datosProy->cutilidad; ?></h2>
                    </div>
                </div>
            </div>
            <!-- /row -->
            <!-- /row -->
            <div class="panel-body">

                <div class="col-md-6">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Fuente de Ingresos:</h3>
                        <?php echo $dispIngresos; ?>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Distribucion de Costos:</h3>
                        <?php echo $dispCostos; ?>
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
                        <h3 class="box-title m-b-0">Acontecimientos:</h3>
                        <div class="message-center">
                            <?php echo $dispHistoria;  ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Equipo:</h3>

                        <div class="message-center">
                            <?php echo $dispEquipo;  ?>
                        </div>
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
                        <h3 class="box-title m-b-0">Riesgos:</h3>
                        <div class="comment-center">
                            <?php echo $dispRiesgos; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Plan de asignacion:</h3>

                        <div class="comment-center">
                            <?php echo $dispPlan; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--./row-->


        <!-- .right-sidebar -->
        <?php include ('rightnav.php'); ?>
        <!-- /.right-sidebar -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php include ('includes/iscripts.php'); ?>
<!-- Custom procesar -->
<!--script src="tproyectos/ps_invertir.js"></script -->
<!-- jQuery for carousel -->
<script src="../plugins/bower_components/owl.carousel/owl.carousel.min.js"></script>
<script src="../plugins/bower_components/owl.carousel/owl.custom.js"></script>
<!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
<!-- Editable -->
<script src="../plugins/bower_components/jsgrid/db.js"></script>
<script type="text/javascript" src="../plugins/bower_components/jsgrid/dist/jsgrid.min.js"></script>

<script type="text/javascript">

</script>
</body>
</html>
