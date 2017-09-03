<?php
/**
 * Created by PhpStorm.
 * User: xion
 * Date: 27/08/17
 * Time: 14:28
 */
?>
<li class="dropdown">
    <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="icon-list"></i>
        <b class="hidden-xs">Menu</b>
    </a>
    <ul class="dropdown-menu dropdown-user animated flipInY">
        <?php if($_SESSION["ses_p_6"] == 1){ ?><li><a href="market.php"><i class="ti-flag-alt"></i> Mercado</a></li><?php } ?>
        <?php if($_SESSION["ses_p_8"] == 1){ ?><li><a href="newproject.php"><i class="ti-medall-alt"></i> Crea tu Proyecto</a></li><?php } ?>
        <?php if($_SESSION["ses_p_9"] == 1){ ?><li><a href="projects.php"><i class="ti-folder"></i> Mis Proyectos</a></li><?php } ?>
        <?php if($_SESSION["ses_p_13"] == 1){ ?><li><a href="inversiones.php"><i class="ti-stats-up"></i> Mis Inversiones</a></li><?php } ?>
        <?php if($_SESSION["ses_p_25"] == 1){ ?><li><a href="ofertantes.php"><i class="ti-money"></i> Mis Ofertantes</a></li><?php } ?>
    </ul>
    <!-- /.dropdown-messages -->
</li>
<!-- /.dropdown -->
<!-- /.dropdown -->
<li class="dropdown">
    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
        <img src="<?php echo $_SESSION["ses_cphoto1"]; ?>" alt="user-img" width="36" class="img-circle">
        <b class="hidden-xs"><?php echo $_SESSION["ses_cname"]; ?></b>
    </a>
    <ul class="dropdown-menu dropdown-user animated flipInY">
        <?php if($_SESSION["ses_p_1"] == 1){ ?><li><a href="perfil.php"><i class="ti-user"></i> Mi Perfil</a></li><?php } ?>
        <?php if($_SESSION["ses_p_2"] == 1){ ?><li><a href="inbox.php"><i class="ti-email"></i> Inbox</a></li><?php } ?>
        <?php if($_SESSION["ses_p_14"] == 1){ ?><li><a href="favoritos.php"><i class="ti-heart"></i> Favoritos</a></li><?php } ?>
        <li role="separator" class="divider"></li>
        <?php if($_SESSION["ses_p_3"] == 1){ ?><li><a href="perfil.php#settings"><i class="ti-settings"></i> Mi Cuenta</a></li><?php } ?>
        <li role="separator" class="divider"></li>
        <?php if($_SESSION["ses_p_4"] == 1){ ?><li><a href="out.php"><i class="fa fa-power-off"></i> Salir</a></li><?php } ?>
    </ul>
    <!-- /.dropdown-user -->
</li>
<li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"> <i class="ti-settings"></i>AVANCES</a></li>
<!-- /.dropdown -->
