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
       <li><a href="market.php"><i class="ti-flag-alt"></i> Mercado</a></li>
        <li><a href="project_pend.php"><i class="ti-folder"></i> Pendientes</a></li>
        <li> <a href="project_aprob.php"><i class="ti-check-box"></i> Aprobados</a> </li>
    </ul>
    <!-- /.dropdown-messages -->
</li>
<!-- /.dropdown -->
<!-- /.dropdown -->
<li class="dropdown">
    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
        <img src="../<?php echo $_SESSION["ses_cphoto1"]; ?>" alt="user-img" width="36" class="img-circle">
        <b class="hidden-xs"><?php echo $_SESSION["ses_cname"]; ?></b>
    </a>
    <ul class="dropdown-menu dropdown-user animated flipInY">
        <li><a href="perfil.php"><i class="ti-user"></i> Mi Perfil</a></li>
        <li><a href="inbox.php"><i class="ti-email"></i> Inbox</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="perfil.php#settings"><i class="ti-settings"></i> Mi Cuenta</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="out.php"><i class="fa fa-power-off"></i> Salir</a></li>
    </ul>
    <!-- /.dropdown-user -->
</li>
<!--li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"> <i class="ti-settings"></i>AVANCES</a></li-->
<!-- /.dropdown -->
