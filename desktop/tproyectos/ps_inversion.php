<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $monto = trim($_POST['ci_monto']);
    $fin = trim($_POST['ci_finrecursos']);
    $startup = trim($_POST['ci_startup']);
    $dias = trim($_POST['ci_dias']);


    $monto = strip_tags($monto);
    $fin = strip_tags($fin);
    $startup = strip_tags($startup);
    $dias = strip_tags($dias);



    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->upd_inversion($DBcon,$idProyecto,$monto,$fin,$startup,$dias);

    // verifico el porcentaje de avance
    $cantidadPreguntas = 4;
    $contestadas = 0;
    $tabla = "tproyectos";
    $fields = " cmetamin, cfinrecursos, cstartup, cmeses  ";
    $where = " WHERE id = '".$idProyecto."'";

    $vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
    $contestadas = $cantidadPreguntas-$vacios;

    $porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);

    $grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);

    $res['grafica'] = $grafica;
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>