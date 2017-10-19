<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Content-Type: text/html;charset=utf-8");
header("Pragma: no-cache");

$emp = 0;

if(isset($_GET['emp']))
{
	$emp = 1;
}


// set filePath
$archivos = '/jade/jadesys/files/proyectos/';



/*
function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);
	return $dias;
}
// Ejemplo de uso:
echo dias_transcurridos('2012-07-01','2012-07-18');
// Salida : 17

 */
$now = date("Y-m-d H:i:s");
require "bd.php";
// ejecuto query y pinto resultados
/*
$query = 'SELECT
A.id, A.gnombre, A.ranking, A.eval,
B.id, B.idEmpresa, B.nombre, B.descripcionGeneral, B.video,
C.id, C.idProyecto, C.fechaInicio, C.fechaFin, C.tipo, C.estatus, B.logo
FROM tempresas AS A
INNER JOIN tproyectos AS B ON A.id = B.idEmpresa
INNER JOIN tsubastas AS C ON B.id = C.idProyecto
WHERE (C.fechaInicio <= \''.$now.'\' AND C.fechaFin >= \''.$now.'\') AND C.estatus = 1'; */

$query = 'SELECT B.*, C.cinicio, C.cfin, C.cmonto FROM tproyectos AS B 
                  INNER JOIN tp_subasta AS C ON B.id = C.idproyecto 
                  WHERE (C.cinicio <= \''.$now.'\' AND C.cfin >= \''.$now.'\') AND B.cstatus = 5';


$salida = '';
$salida2= '';
$contador = 1;

if ($resultado = $mysqli->query($query)) {
    while ($fila = $resultado->fetch_row()) {
        // directorio actual
        $doctos = '';


        $salida .= '<div id="slidingDiv'.$contador.'" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <iframe width="98%" height="300" src="https://www.youtube.com/embed/'.$fila[12].'?list=RDEoaPhxNubL0?ecver=1" frameborder="0" allowfullscreen></iframe>
                            
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>'.$fila[1].' / '.$fila[3].'</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                       
                                    <div>
                                        <span>Monto:</span> '.$fila[44].' </div>
                                    <div>
                                        <span>Inicio</span> '.$fila[42].'</div>
                                    <div>
                                        <span>Fin</span> '.$fila[43].'</div>
                                </div>
                                <p>'.$fila[7].'</p>
                                <p><a href="../desktop/login.html" class="button2">Invertir</a> <a href="https://www.youtube.com/watch?v='.$fila[12].'" class="button2" target="_blank">Pitch</a></p>
                            </div>
                        </div>
                    </div>';

        $salida2 .= '<li class="span4 mix '.$fila[13].'">
                            <div class="thumbnail">
                                <img src="../'.$fila[11].'" alt="project 1">
                                <a href="#single-project" class="more show_hide" rel="#slidingDiv'.$contador.'">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>'.$fila[3].' / '.$fila[2].'</h3>
                                <p>'.substr($fila[20], 0, 100).'</p>
                                <div class="mask"></div>
                            </div>
                        </li>';

        $contador++;

    }
}


?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jade Capital Flow</title>
        <!-- Load Roboto font -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <!-- Load css styles -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/pluton.css" />
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="css/pluton-ie7.css" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/jquery.cslider.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" />
        <link rel="stylesheet" type="text/css" href="css/animate.css" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57.png">
        <link rel="shortcut icon" href="images/ico/favicon.ico">
    </head>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/598111f04471ce54db6521a6/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
    <body style="background-image: images/Slider.png; background-repeat: repeat-x; background-repeat: repeat-y;">
    <!-- FVSD para el nuevo slider -->
    <script src="js/jssor.slider-25.2.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_SlideoTransitions = [
                [{b:900,d:2000,x:-379,e:{x:7}}],
                [{b:900,d:2000,x:-379,e:{x:7}}],
                [{b:-1,d:1,o:-1,sX:2,sY:2},{b:0,d:900,x:-171,y:-341,o:1,sX:-2,sY:-2,e:{x:3,y:3,sX:3,sY:3}},{b:900,d:1600,x:-283,o:-1,e:{x:16}}]
            ];

            var jssor_1_options = {
                $AutoPlay: 1,
                $SlideDuration: 800,
                $SlideEasing: $Jease$.$OutQuint,
                $CaptionSliderOptions: {
                    $Class: $JssorCaptionSlideo$,
                    $Transitions: jssor_1_SlideoTransitions
                },
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $BulletNavigatorOptions: {
                    $Class: $JssorBulletNavigator$
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/
            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;
                if (containerWidth) {
                    var MAX_WIDTH = 3000;

                    var expectedWidth = containerWidth;

                    if (MAX_WIDTH) {
                        expectedWidth = Math.min(MAX_WIDTH, expectedWidth);
                    }

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <style>
        /* jssor slider loading skin double-tail-spin css */

        .jssorl-004-double-tail-spin img {
            animation-name: jssorl-004-double-tail-spin;
            animation-duration: 1.2s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-004-double-tail-spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }


        .jssorb051 .i {position:absolute;cursor:pointer;}
        .jssorb051 .i .b {fill:#fff;fill-opacity:0.5;stroke:#000;stroke-width:400;stroke-miterlimit:10;stroke-opacity:0.5;}
        .jssorb051 .i:hover .b {fill-opacity:.7;}
        .jssorb051 .iav .b {fill-opacity: 1;}
        .jssorb051 .i.idn {opacity:.3;}

        .jssora051 {display:block;position:absolute;cursor:pointer;}
        .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
        .jssora051:hover {opacity:.8;}
        .jssora051.jssora051dn {opacity:.5;}
        .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
    </style>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a href="index.php" class="brand">
                        <img src="images/logo.png" width="120" height="40" alt="Logo" />
                        <!-- This is website logo -->
                    </a>
                    <!-- Navigation button, visible on small resolution -->
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-menu"></i>
                    </button>
                    <!-- Main navigation -->
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav" id="top-navigation">
                          <?php include('menu.php'); ?>
                        </ul>
                    </div>
                    <!-- End main navigation -->
                </div>
            </div>
        </div>
        <!-- Start home section -->
        <div id="home">
            <!-- Start cSlider -->
            <div id="da-slider" class="da-slider">
                <div class="triangle"></div>
                <!-- mask elemet use for masking background image -->
                <div class="mask"></div>
                <!-- All slides centred in container element -->
                <div class="container">
                    <?php
                    if($emp==1)
                    {
                        include('banner_emp.php');
                    }
                    else  // es inversionista
                    {
                        include('banner_inv.php');
                    }
                    ?>
                    <!-- Start cSlide navigation arrows -->
                    <div class="da-arrows">
                        <span class="da-arrows-prev"></span>
                        <span class="da-arrows-next"></span>
                    </div>
                    <!-- End cSlide navigation arrows -->
                </div>
            </div>
        </div>
        <!-- End home section -->
        <!-- Service section start -->
        <div class="section primary-section" id="service">
            <div class="container">
                <!-- Start title section -->
                <!--div class="title">
                    <h1>¿Cómo Funciona el Match-Funding?</h1>
                    <!-- Section's title goes here -->
                    <!--p>Explicación de cada etapa del proceso.</p>
                    <!--Simple description for section goes here. -->
                <!--/div-->
               <?php
			    if($emp==1)
				{
					include('mf_emp.php');
					}
					else  // es inversionista
					{
						include('mf_inv.php');
						}
			   ?>
                </div>
            </div>
        </div>
        <!-- Service section end -->
        
        
        
        <!-- Portfolio section start -->
        <div class="section secondary-section" id="portfolio">
            <div class="triangle2"></div>
            <div class="container">
                <div class=" title">
                    <h1>Mercado</h1>
                    <p>Descubre todos los proyectos que ofrecemos</p>
                </div>
                <ul class="nav nav-pills" style="margin-left: 30%;">
                    <li class="filter" data-filter="all">
                        <a href="#noAction">TODAS</a>
                    </li>
                    <li class="filter" data-filter="Capital">
                        <a href="#noAction">CAPITAL</a>
                    </li>
                    <li class="filter" data-filter="Deuda">
                        <a href="#noAction">DEUDA</a>
                    </li>
                    <li class="filter" data-filter="Mixto">
                        <a href="#noAction">MIXTOS</a>
                    </li>
                </ul>
                <!-- Start details for portfolio project 1 -->
                <div id="single-project">


                    <?php echo $salida;  ?>

                    <!-- End details for portfolio project 1 -->
                    <ul id="portfolio-grid" class="thumbnails row">
                       <?php echo $salida2; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Portfolio section end -->


        <!-- Contact section start -->
        <div id="contact" class="contact">
            <div class="section secondary-section">
                <div class="triangle2"></div>
                <div class="container">
                    <div class="title">
                        <h1>Contacto</h1>
                        <p>Para dudas, aclaraciones, comentarios, puedes acercarte con nosotros por cualquiera de estos medios:.</p>
                        <p><?php echo $salida; ?></p>
                    </div>

                    <div class="row-fluid">
                        <div class="span6">
                            <h3>Comentarios</h3>
                            <div id="successSend" class="alert alert-success invisible">
                                <strong>Excelente!</strong>Su mensaje ha sido enviado.</div>
                            <div id="errorSend" class="alert alert-error invisible">Ups!, ocurrió un error.</div>
                            <form id="contact-form" action="php/mail.php">
                                <div class="control-group">
                                    <div class="controls">
                                        <input class="span12" type="text" id="name" name="name" placeholder="* Su nombre..." />
                                        <div class="error left-align" id="err-name">Ingrese su nombre.</div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <input class="span12" type="email" name="email" id="email" placeholder="* Su email..." />
                                        <div class="error left-align" id="err-email">Ingrese una dirección de email valido.</div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <textarea class="span12" name="comment" id="comment" placeholder="* Comentarios..."></textarea>
                                        <div class="error left-align" id="err-comment">Ingrese sus comentarios.</div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button id="send-mail" class="message-btn">Enviar mensaje</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="span6">
                            <div class="highlighted-box center">
                                <p class="info-mail">contacto@jadecapitalflow.mx</p>
                                <!--p class="info-mail">oliver.moreno@jadecapitalflow.mx</p>
                                <p class="info-mail">arnoldo.gutierrez@jadecapitalflow.mx</p>
                                <p class="info-mail">victor.trillo@jadecapitalflow.mx</p>
                                <p class="info-mail">enzo.dimaggio@jadecapitalflow.mx</p-->
                                <!--p>+11 234 567 890</p>
                                <p>+11 286 543 850</p-->
                                <div class="title">
                                    <ul class="social">
                                        <li>
                                            <a href="">
                                                <span class="icon-facebook-circled"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span class="icon-twitter-circled"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span class="icon-linkedin-circled"></span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- Contact section edn -->

    <?php
    if($emp==1)
    {

    ?>
        <!-- Info de empresa (pasos) -->

    <div id="paso1" class="section secondary-section">
        <div class="triangle2"></div>
        <div class="container">
            <div class="title">
                <h1>PASO 1</h1>
                <p>Da el primer paso </p>
            </div>
            <div class="price-table row-fluid">
                <div class="span4 price-column" style="width: 98%" align="center">
                    <h3>Primer Registro</h3>
                    <ul class="list">
                        <!--li class="price">$19,99</li-->
                        <li>Ingeso de usuarios mediante nombre y correo</li>
                    </ul>
                    <h3>Creación del proyecto</h3>
                    <ul class="list">
                        <!--li class="price">$19,99</li-->
                        <li>Identificación de la etapa de desarrollo del proyecto</li>
                    </ul>
                    <h3>Cuéntanos del proyecto</h3>
                    <ul class="list">
                        <!--li class="price">$19,99</li-->
                        <li>Sector</li>
                        <li>Mercado Objetivo</li>
                        <li>Productos</li>
                        <li>Equipos de Trabajo</li>
                        <li>Necesidades de Financiamiento</li>
                        <li>Uso de los recursos a obtener</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- info empresas section end -->
    <div id="paso2" class="section secondary-section">
        <div class="triangle2"></div>
        <div class="title">
            <h1>PASO 2</h1>
            <p>Estructuración y Diagnostico</p>
        </div>
        <div class="price-table row-fluid" align="center">
            <img src="jadePaso2Empresas.png">
        </div>
    </div>
    <!-- info empresas section end -->
    <div id="paso3" class="section secondary-section">
        <div class="triangle2"></div>
        <div class="title">
            <h1>PASO 3</h1>
            <p>Sal al mercado</p>
        </div>
        <div class="price-table row-fluid">
            <div class="span4 price-column" style="width: 98%" align="center">

                <h3>Proceso de subastas</h3>
                <ul class="list">
                    <!--li class="price">$19,99</li-->
                    <li>a</li>
                    <li>b </li>
                    <li>c</li>
                    <li>d </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- info empresas section end -->
    <?php

    }
    ?>

        <!-- Footer section start -->
        <div class="footer">
            <p>&copy; 2017 Theme by <a href="http://www.enzomx.com">Jade Capital Flow</a></p>
        </div>
        <!-- Footer section end -->
        <!-- ScrollUp button start -->
        <div class="scrollup">
            <a href="#">
                <i class="icon-up-open"></i>
            </a>
        </div>
        <!-- ScrollUp button end -->
        <!-- Include javascript -->
        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.mixitup.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/modernizr.custom.js"></script>
        <script type="text/javascript" src="js/jquery.bxslider.js"></script>
        <script type="text/javascript" src="js/jquery.cslider.js"></script>
        <script type="text/javascript" src="js/jquery.placeholder.js"></script>
        <script type="text/javascript" src="js/jquery.inview.js"></script>
        <!-- Load google maps api and call initializeMap function defined in app.js -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;callback=initializeMap"></script>
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>