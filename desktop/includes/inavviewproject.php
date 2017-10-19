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
                    <img src="../<?php echo $datosProy->clogo; ?>" alt="user-img" class="img-circle">
                </div>
                <a href="#" class="dropdown-toggle u-dropdown"  role="button" aria-haspopup="true" aria-expanded="false">
                    <?php echo $datosProy->cname; ?>
                </a>

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

            <li> <a href="#" class="waves-effect"><i data-icon="/" class="fa fa-chevron-circle-right"></i> <span class="hide-menu">Monto: <?php echo $datossubasta->cmonto; ?> </span></a></li>
            <li> <a href="#" class="waves-effect"><i data-icon="/" class="fa fa-chevron-circle-right"></i> <span class="hide-menu">Industria: <?php echo $datosProy->csector1; ?> </span></a></li>
            <li> <a href="#" class="waves-effect"><i data-icon="/" class="fa fa-chevron-circle-right"></i> <span class="hide-menu">Finaliza: <?php echo(date("F d, Y", strtotime($datossubasta->cfin))); ?> </span></a></li>


            <li><a href="#" class="waves-effect active" style="text-align: center; color: #1c2d3f;"><i data-icon="/" class="fa fa-chevron-circle-right"></i> <span class="hide-menu">Dias restantes:</span></a></li>
            <div class="user-profile">
                <div class="dropdown user-pro-body">
                    <a href="#" class="label label-rouded label-info" role="button" aria-haspopup="true" aria-expanded="false" style="font-size: 25px;"><span class="hide-menu"><?php echo $diasRestantes; ?></span></a>
                </div>
            </div>


            <div class="user-profile">
                <div class="dropdown user-pro-body">
                    <?php if($_SESSION["ses_ctipo"] == 'I'){ ?><button class="btn btn-block btn-rounded btn-info" aria-expanded="false" type="submit" id="btn-sendsubasta" data-toggle="modal" data-target="#responsive-modal" data-original-title="Close"><i data-icon="/" class="fa fa-credit-card-alt"></i> <span class="hide-menu">INVERTIR</span></button>
                    <?php } ?>
                </div>
            </div>

        </ul>
    </div>
</div>
