<?php
ob_start();
session_start();
header("Content-Type: text/html;charset=utf-8");
require_once("global.config.php");
require_once("config.php");
require_once('sescheck.php'); // para la sesion

require_once(C_P_CLASES.'actions/a.usuarios.php');
$myIns = new A_USR("");
// obtengo los detalles del usuario
$obj = $myIns->get_userdata($DBcon,$_SESSION["ses_cuser"],"");

// pinto los paises
require_once(C_P_CLASES."utils/html.functions.php"); // HTML functions
$myHTML = new HTML("",$DBcon);
$myHTML->set_newInputName('cnation');
$myHTML->fill_query('tpaises','','','nombre','iso');

$selectPaises = $myHTML->set_selectBox($obj->cnation,0,'form-control form-control-line');


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
    <?php include ('leftnav.php'); ?>
    <!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Mi Perfil</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">Starter Page</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="white-box">
                        <div class="user-bg"> <img width="100%" alt="user" src="<?php echo $obj->cphoto2; ?>">
                            <div class="overlay-box">
                                <div class="user-content"> <a href="javascript:void(0)"><img src="<?php echo $obj->cphoto1; ?>" class="thumb-lg img-circle" alt="img"></a>
                                    <h4 class="text-white"><?php echo $obj->cname; ?></h4>
                                    <h5 class="text-white"><?php echo $obj->cuser; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="user-btm-box">
                            <div class="col-md-4 col-sm-4 text-center">
                                <p class="text-purple"><i class="ti-facebook"></i></p>
                                <p><?php echo $obj->cfb; ?></p>
                            </div>
                            <div class="col-md-4 col-sm-4 text-center">
                                <p class="text-blue"><i class="ti-twitter"></i></p>
                                <p><?php echo $obj->ctw; ?></p>
                            </div>
                            <div class="col-md-4 col-sm-4 text-center">
                                <p class="text-danger"><i class="ti-instagram"></i></p>
                                <p><?php echo $obj->cins; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="white-box">
                        <ul class="nav nav-tabs tabs customtab">
                            <li class="active tab"><a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Perfil</span> </a> </li>
                            <li class="tab"><a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Cuenta</span> </a> </li>
                            <li class="tab"><a href="#photos" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Fotos</span> </a> </li>
                            <li class="tab"><a href="#security" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Seguridad</span> </a> </li>

                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="profile">
                                <form class="form-horizontal form-material" id="formperfil">
                                    <div class="form-group">
                                        <label class="col-md-12">Usuario</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="<?php echo $obj->cuser; ?>" class="form-control form-control-line" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Cumpleaños</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control mydatepicker"  data-date-format='yyyy-mm-dd' placeholder="yyyy/mm/dd" value="<?php echo $obj->cbdate; ?>" name="cbdate" id="cbdate">
                                            <span class="input-group-addon"><i class="icon-calender"></i></span> </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">CURP</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $obj->ccurp; ?>" class="form-control form-control-line" name="ccurp" id="ccurp">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Pasaporte</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $obj->cpassport; ?>" class="form-control form-control-line" name="cpassport" id="cpassport">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Sitio Web</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $obj->cwww; ?>" class="form-control form-control-line" name="cwww" id="cwww">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Facebook</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $obj->cfb; ?>" class="form-control form-control-line" name="cfb" id="cfb">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Twitter</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $obj->ctw; ?>" class="form-control form-control-line" name="ctw" id="ctw">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Instagram</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $obj->cins; ?>" class="form-control form-control-line" name="cins" id="cins">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Acerca de mi</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" class="form-control form-control-line" name="cdescripcion" id="cdescripcion"><?php echo $obj->cdescripcion; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12">Pais</label>
                                        <div class="col-sm-12">
                                            <?php echo $selectPaises; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" id="btn_perfil" type="submit">Actualizar Perfil</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="photos">
                                <div class="form-body">
                                    <h3 class="box-title">Carga de Fotos </h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6 ol-md-6 col-xs-12">
                                            <div class="white-box">
                                                <p class="text-muted m-b-30"> Agregar Foto Perfil (JPG, PNG)</p>
                                                <form action="tusuarios/ps_photo1.php" class="dropzone" id="my-awesome-dropzone">
                                                    <div class="fallback">
                                                        <input name="file" type="file" multiple />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 ol-md-6 col-xs-12">
                                            <div class="white-box">
                                                <p class="text-muted m-b-30"> Agregar Fondo Perfil (JPG, PNG)</p>
                                                <form action="tusuarios/ps_photo2.php" class="dropzone" id="my-awesome-dropzone2">
                                                    <div class="fallback">
                                                        <input name="file" type="file" multiple />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal form-material" id="formcuenta">
                                    <div class="form-group">
                                        <label class="col-md-12">Nombre</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $obj->cname; ?>" class="form-control form-control-line" id="cname" name="cname">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Correo alternativo</label>
                                        <div class="col-md-12">
                                            <input type="email" value="<?php echo $obj->cemail; ?>" class="form-control form-control-line" name="cemail" id="cemail">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Telefono</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $obj->ctel; ?>" class="form-control form-control-line" id="ctel" name="ctel">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" id="btn_cuenta" type="submit">Actualizar Cuenta</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="security">
                                <form class="form-horizontal form-material" id="formpass">
                                    <div class="form-group">
                                        <label class="col-md-12">Old Password</label>
                                        <div class="col-md-12">
                                            <input type="password" placeholder="*******" class="form-control form-control-line" id="coldpass" name="coldpass" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Nuevo Password</label>
                                        <div class="col-md-12">
                                            <input type="password" placeholder="*******" class="form-control form-control-line" id="cpass" name="cpass" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Confirmar Password</label>
                                        <div class="col-md-12">
                                            <input type="password" placeholder="*******" class="form-control form-control-line" id="cconfirm" name="cconfirm" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" id="btn_pass" type="submit">Actualizar Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
<!-- Custom procesar -->
<script src="tusuarios/ps_updperfil.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- para la carga de documentos -->
<script src="../plugins/bower_components/dropzone-master/dist/dropzone.js"></script>
<script type="text/javascript">
    // foto 1
    $(function(){
        Dropzone.options.myAwesomeDropzone = {
            maxFilesize: 5,
            addRemoveLinks: true,
            dictResponseError: 'Server not Configured',
            acceptedFiles: ".png,.jpg,.jpeg",
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
                self.on("sending", function (file) {
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

    // foto 2
    $(function(){
        Dropzone.options.myAwesomeDropzone2 = {
            maxFilesize: 5,
            addRemoveLinks: true,
            dictResponseError: 'Server not Configured',
            acceptedFiles: ".png,.jpg,.jpeg",
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
                self.on("sending", function (file) {
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
