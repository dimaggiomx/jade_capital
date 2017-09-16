<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $supuesto = trim($_POST['cn_supuestos']);
    $modelo = trim($_POST['cn_modelo']);
    $vendidas = trim($_POST['cn_vendidas']);
    $precio = trim($_POST['cn_precio']);
    $ingresos = trim($_POST['cn_ingresos']);
    $costos = trim($_POST['cn_costos']);
    $capex = trim($_POST['cn_capex']);
    $ventas = trim($_POST['cn_ventas']);
    $eeff = trim($_POST['cn_eeff']);
    $utilidad = trim($_POST['cn_utilidad']);


    $supuesto = strip_tags($supuesto);
    $modelo = strip_tags($modelo);
    $vendidas = strip_tags($vendidas);
    $precio = strip_tags($precio);
    $ingresos = strip_tags($ingresos);
    $costos = strip_tags($costos);
    $capex = strip_tags($capex);
    $ventas = strip_tags($ventas);
    $eeff = strip_tags($eeff);
    $utilidad = strip_tags($utilidad);



    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->upd_negocio($DBcon, $idProyecto, $supuesto, $modelo, $vendidas, $precio, $ingresos, $costos, $capex, $ventas, $eeff, $utilidad);
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>