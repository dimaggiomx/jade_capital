<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$res = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $cliente = trim($_POST['cm_cliente']);
    $segmento = trim($_POST['cm_segmento']);
    $mercado = trim($_POST['cm_mercado']);
    $marketing = trim($_POST['cm_marketing']);
    $ventas = trim($_POST['cm_ventas']);
    $precio = trim($_POST['cm_precio']);

    $cliente = strip_tags($cliente);
    $segmento = strip_tags($segmento);
    $mercado = strip_tags($mercado);
    $marketing = strip_tags($marketing);
    $ventas = strip_tags($ventas);
    $precio = strip_tags($precio);


    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->ins_datosMercado($DBcon, $idProyecto, $cliente, $segmento, $mercado, $marketing, $ventas, $precio);
    $data = $myIns->get_datosmercado($DBcon, $idProyecto);

    $res['informacion'] = $data;

}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>