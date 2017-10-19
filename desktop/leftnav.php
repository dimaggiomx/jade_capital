<?php
/**
 * Created by PhpStorm.
 * User: xion
 * Date: 27/08/17
 * Time: 14:32
 */
?>
<div class="navbar-default sidebar" role="navigation" style="background-color: #EDF1F5;">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar" style="background-color:transparent;">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div>
                    <img src="../<?php echo $_SESSION["ses_cphoto1"]; ?>" alt="user-img" class="img-circle">
                </div>
                <a href="#" class="dropdown-toggle u-dropdown"  role="button" aria-haspopup="true" aria-expanded="false">BIENVENIDO</a>

            </div>
        </div>
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


        </ul>
    </div>
</div>


