<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $porcentaje = trim($_POST['cpl_porcentaje']);
    $exp = trim($_POST['cpl_explicacion']);

    $porcentaje = strip_tags($porcentaje);
    $exp = strip_tags($exp);


    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->ins_datosPlan($DBcon, $idProyecto, $porcentaje, $exp);
    $data = $myIns->get_datosplan($DBcon, $idProyecto);

    $res['informacion'] = $data;
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>