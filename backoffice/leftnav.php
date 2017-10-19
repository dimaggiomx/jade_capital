<?php
/**
 * Created by PhpStorm.
 * User: xion
 * Date: 27/08/17
 * Time: 14:32
 */
?>
<div class="navbar-default sidebar" role="navigation" >
    <div class="sidebar-nav navbar-collapse slimscrollsidebar" >

        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                <!-- /input-group -->
            </li>


            <li class="user-pro"> <a href="#" class="waves-effect">
                    <img src="../<?php echo $_SESSION["ses_cphoto1"]; ?>" alt="user-img" class="img-circle">
                    <span class="hide-menu"> <?php echo $_SESSION["ses_cname"]; ?> <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="perfil.php"><i class="ti-user"></i> Mi Perfil</a></li>
                    <li><a href="inbox.php"><i class="ti-email"></i> Inbox</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="perfil.php#settings"><i class="ti-settings"></i> Mi Cuenta</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="out.php"><i class="fa fa-power-off"></i> Salir</a></li>
                </ul>
            </li>
            <li class="nav-small-cap m-t-10">--- Main Menu</li>
            <li> <a href="index.html" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> Proyectos <span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right">3</span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="project_pend.php">Pendientes</a> </li>
                    <li> <a href="project_aprob.php">Aprobados</a> </li>
                    <li> <a href="market.php">Mercado</a> </li>
                </ul>
            </li>
        </ul>
    </div>
</div>


