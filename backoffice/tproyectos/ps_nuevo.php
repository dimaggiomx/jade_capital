<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$res = array();

require_once '../global.config.php';
require_once '../config.php';

if ($_POST) {

    $nombre = trim($_POST['c_nombre']);
    $sector = trim($_POST['c_sector']);
    $estado = trim($_POST['c_estado']);


    $nombre = strip_tags($nombre);
    $sector = strip_tags($sector);
    $estado = strip_tags($estado);


    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    $res = $myIns->ins_proyecto($DBcon, $nombre, $sector, $estado, $_SESSION["ses_id"]);
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>