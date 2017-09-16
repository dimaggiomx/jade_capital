<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $competidor = trim($_POST['cc_competidor']);
    $dif = trim($_POST['cc_diferenciador']);
    $propuesta = trim($_POST['cc_propuesta']);

    $competidor = strip_tags($competidor);
    $dif = strip_tags($dif);
    $propuesta = strip_tags($propuesta);


    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->ins_datosCompetencia($DBcon, $idProyecto, $competidor, $dif, $propuesta );
    $data = $myIns->get_datoscompetencia($DBcon, $idProyecto);
    $res['informacion'] = $data;
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>