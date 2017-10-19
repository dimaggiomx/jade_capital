<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];

if ($_POST) {

    $var = $_POST['tipo'];

    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");
    $data = $myIns->get_datosmercado($DBcon, $idProyecto);
}

$response['status'] = 'success'; // could not register
$response['informacion'] = $data;

echo json_encode($response);
?>