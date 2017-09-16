<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // obtiene info

    $data = $myIns->get_datoscompetencia($DBcon, $idProyecto);
    $res['d_competencia'] = $data;

    $data = $myIns->get_datosmercado($DBcon, $idProyecto);
    $res['d_mercado'] = $data;

    $data = $myIns->get_datosfuente($DBcon, $idProyecto);
    $res['d_fuente'] = $data;

    $data = $myIns->get_datoscostos($DBcon, $idProyecto);
    $res['d_costos'] = $data;

    $data = $myIns->get_datoshistoria($DBcon, $idProyecto);
    $res['d_historia'] = $data;

    $data = $myIns->get_datosequipo($DBcon, $idProyecto);
    $res['d_equipo'] = $data;

    $data = $myIns->get_datosriesgos($DBcon, $idProyecto);
    $res['d_riesgos'] = $data;

    $data = $myIns->get_datosplan($DBcon, $idProyecto);
    $res['d_plan'] = $data;

$res['status'] = 'success'; // could not register

echo json_encode($res);
?>