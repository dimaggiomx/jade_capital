<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $desc = trim($_POST['cid_descripcion']);
    $tipo = trim($_POST['cid_tipo']);
    $etapa = trim($_POST['cid_etapa']);
    $patentes = trim($_POST['cid_patentes']);


    $desc = strip_tags($desc);
    $tipo = strip_tags($tipo);
    $etapa = strip_tags($etapa);
    $patentes = strip_tags($patentes);



    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->upd_productoproyecto($DBcon, $idProyecto, $desc, $tipo, $etapa, $patentes);
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>