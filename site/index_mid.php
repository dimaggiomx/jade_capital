<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset=utf-8>
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
    
    <body>
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
                    <a href="#" class="brand">
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
                            <li><a href="#about">Quienes Somos</a></li>
                            <li><a href="#contact">Contacto</a></li>
                            <li class="active"><a href="../desktop/login.html">Login / Regístrate</a></li>
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
                    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;visibility:hidden;">
                        <!-- Loading Screen -->
                        <div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
                        </div>
                        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;">
                            <div>
                                <img data-u="image" src="fondoBanner_fin.png" />
                                <div style="position:absolute;top:30px;left:30px;width:480px;height:120px;z-index:0;font-size:25px;color:#ffffff;line-height:30px; text-decoration: underline;">QUIERO INVERTIR</div>
                                <div style="position:absolute;top:70px;left:30px;width:480px;height:120px;z-index:0;font-size:22px;color:#ffffff;line-height:30px;">TE OFRECEMOS DIVERSAS ALTERNATIVAS DE INVERSIÓN CON ATRACTIVOS RENDIMIENTOS.</div>
                                <div style="position:absolute;top:180px;left:90px;width:480px;height:120px;z-index:0;font-size:20px;color:#ffffff;line-height:38px;">El 100% de nuestros proyectos pasan por minucioso proceso de revisión. Jade Capital ofrecerá sus servicios de asesoría financiera y estructuración, creando valor agregado en el proyecto ofreciendo alternativas innovadoras</div>
                                <div style="position:absolute;top:300px;left:30px;width:480px;height:120px;z-index:0;font-size:20px;color:#ffffff;line-height:38px;"><a href="index2.php" class="da-link button" style="margin-top:80px;">Invertir</a></div>
                                <!--div style="position:absolute;top:120px;left:650px;width:470px;height:220px;z-index:0;">
                                    <img style="position:absolute;top:0px;left:0px;width:470px;height:220px;z-index:0;" src="img/c-phone-horizontal.png" />
                                    <div style="position:absolute;top:4px;left:45px;width:379px;height:213px;z-index:0; overflow:hidden;">
                                        <img data-u="caption" data-t="0" style="position:absolute;top:0px;left:0px;width:379px;height:213px;z-index:0;" src="img/c-slide-1.jpg" />
                                        <img data-u="caption" data-t="1" style="position:absolute;top:0px;left:379px;width:379px;height:213px;z-index:0;" src="img/c-slide-3.jpg" />
                                    </div>
                                    <img style="position:absolute;top:4px;left:45px;width:379px;height:213px;z-index:0;" src="img/c-navigator-horizontal.png" />
                                    <img data-u="caption" data-t="2" style="position:absolute;top:476px;left:454px;width:63px;height:77px;z-index:0;" src="img/hand.png" />
                                </div-->
                            </div>
                            <div>
                                <img data-u="image" src="fondoBanner_fin2.png" />
                                <div style="position:absolute;top:30px;left:30px;width:480px;height:120px;z-index:0;font-size:25px;color:#ffffff;line-height:30px; text-decoration: underline;">BUSCO FINANCIAMIENTO</div>
                                <div style="position:absolute;top:70px;left:30px;width:480px;height:120px;z-index:0;font-size:22px;color:#ffffff;line-height:30px;">Te ofrecemos soluciones a la medida para tus necesidades de financiamiento.</div>
                                <div style="position:absolute;top:180px;left:90px;width:480px;height:120px;z-index:0;font-size:20px;color:#ffffff;line-height:38px;">Date la oportunidad de crecer con nosotros y brindarte las soluciones a la medida de tus proyectos</div>
                                <div style="position:absolute;top:300px;left:30px;width:480px;height:120px;z-index:0;font-size:20px;color:#ffffff;line-height:38px;"><a href="index2.php?emp=1" class="da-link button" style="margin-top:80px;">Buscar Financiamiento</a></div>

                            </div>
                            <!--div>
                                <img data-u="image" src="img/blue.jpg" />
                            </div-->
                            <a data-u="any" href="https://www.jadecapitalflow.com" style="display:none">jade</a>
                        </div>
                        <!-- Bullet Navigator -->
                        <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:14px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                            <div data-u="prototype" class="i" style="width:18px;height:18px;">
                                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                                </svg>
                            </div>
                        </div>
                        <!-- Arrow Navigator -->
                        <div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                            </svg>
                        </div>
                        <div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                            </svg>
                        </div>
                    </div>
                    <script type="text/javascript">jssor_1_slider_init();</script>
                    <!-- #endregion Jssor Slider End -->





                    <!-- Start first slide -->
                    <!--div class="da-slide">
                        <h2 class="fittext2">Quiero Invertir</h2>
                        <h4>TE OFRECEMOS DIVERSAS ALTERNATIVAS DE INVERSIÓN CON ATRACTIVOS RENDIMIENTOS.</h4>
                        <p> El 100% de nuestros proyectos pasan por minucioso proceso de revisión. Jade Capital ofrecerá sus servicios de asesoría financiera y estructuración, creando valor agregado en el proyecto ofreciendo alternativas innovadoras.</p>
                        <a href="index2.php" class="da-link button">Invertir</a>
                        <div class="da-img">
                            <!--img src="images/option01.png" alt="image01" width="320"-->
                        <!--/div>
                    </div>
                    <!-- End first slide -->
                    <!-- Start second slide -->
                    <!--div class="da-slide">
                        <h2>Busco Financiamiento</h2>
                        <h4>Te ofrecemos soluciones a la <br>medida para tus necesidades<br/> de financiamiento.</h4>
                        <p><br/>Date la oportunidad de crecer con nosotros y <br/>brindarte las soluciones a la medida <br/>de tus proyectos</p>
                        <a href="index2.php?emp=1" class="da-link button">Buscar Financiamiento</a>
                        <div class="da-img">
                            <!--img src="images/option02.png" width="320" alt="image02"-->
                        <!--/div>
                    </div>
                    <!-- End second slide -->

                    <!-- Start cSlide navigation arrows -->
                    <!--div class="da-arrows">
                        <span class="da-arrows-prev"></span>
                        <span class="da-arrows-next"></span>
                    </div>
                    <!-- End cSlide navigation arrows -->
                </div>
            </div>
        </div>
        <!-- End home section -->

        
        
        

        <!-- About us section start -->
        <div class="section primary-section" id="about">
            <div class="triangle"></div>
            <div class="container">
                <div class="title">
                    <h1>¿Quienes Somos?</h1>
                </div>
                <div class="about-text centered">
                    <!--h3>Somos una plataforma de Crowd Funding Somos una empresa 100% mexicana Experta en asesoramiento financiero y estructuración de proyectos de inversión. Tenemos un amplio conocimiento del mercado bursátil y bancario.</h3-->
                    <p style="font-size:20px; line-height: normal;">Somos una plataforma de Crowd Funding con el objetivo de ofrecer <strong>soluciones</strong> tanto a inversionistas como a <strong>empresas</strong> creando alternativas de <strong>inversión</strong> que beneficien a todos los participantes.</p>

                    <p style="font-size:20px; line-height: normal;">El 100% de nuestros proyectos pasan por un <strong>due diligence exhaustivo </strong> para asegurar que la alternativa de inversión tiene certeza juridica y cuenta con una obligación exigible legalmente. Adicionalmente en caso de ser necesario, Jade Capital ofrecerá sus servicios de <strong>asesoría financiera y estructuración</strong>, creando valor agregado en el proyecto y ofreciendo alternativa innovadoras.</p>
                </div>
            </div>
        </div>
        <!-- Client section start -->
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