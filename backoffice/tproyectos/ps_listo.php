<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];

    $status = 2;  //envio a validar
    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->upd_statusproject($DBcon, $idProyecto, $status);

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>