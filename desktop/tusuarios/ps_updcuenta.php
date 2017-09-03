<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';


if ($_POST) {
//    cumple,curp,pasaporte,www,fb,tw,ins,about,pais


    $nombre = trim($_POST['cname']);
    $correo = trim($_POST['cemail']);
    $tel = trim($_POST['ctel']);


    $nombre = strip_tags($nombre);
    $correo = strip_tags($correo);
    $tel = strip_tags($tel);


            require_once(C_P_CLASES.'actions/a.usuarios.php');
            $myIns = new A_USR("");

            // agrego valores
            $myIns->add_data($_SESSION['ses_id'],"",$nombre,$correo,"","","","","","","","","","","","","","","","",$tel,"");

            $res = $myIns->upd_usercuenta($DBcon,$_SESSION['ses_id']);

}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>