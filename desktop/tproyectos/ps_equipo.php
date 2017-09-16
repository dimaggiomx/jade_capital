<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $nombre = trim($_POST['ce_nombre']);
    $puesto = trim($_POST['ce_puesto']);

    $nombre = strip_tags($nombre);
    $puesto = strip_tags($puesto);


    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->ins_datosEquipo($DBcon, $idProyecto, $nombre, $puesto);
    $data = $myIns->get_datosequipo($DBcon, $idProyecto);

    $res['informacion'] = $data;
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>