<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';


if ($_POST) {

    $inicio = $_POST['cinicio'];
    $fin = $_POST['cfin'];
    $monto = $_POST['cmonto'];
    $idProyecto = $_POST['cidproyecto'];

    error_log("Proyecto:".$idProyecto,0);
    require_once(C_P_CLASES.'actions/a.validar.php');
    $myReg = new A_VAL("");

    $response = $myReg->ins_datosSubasta($DBcon,$idProyecto,$inicio,$fin,$monto);
    $res2 = $myReg->upd_statusproject($DBcon, $idProyecto, 5);
}

//error_log("NO:".$inicio,0);

echo json_encode($res2);
?>