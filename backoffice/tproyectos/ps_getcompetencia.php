<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];
//$idProyecto = 1;


if ($_POST) {

    $var = $_POST['tipo'];

    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");
    $data = $myIns->get_datoscompetencia($DBcon, $idProyecto);
}


/*
$sql= "SELECT cp_competidor, cp_diferenciador, cp_propuestav FROM tp_competencia WHERE idProyecto = '1'";

$data = $DBcon->query($sql)->fetchAll(PDO::FETCH_ASSOC);

//echo json_encode($data);
//exit();
*/


$response['status'] = 'success'; // could not register
$response['informacion'] = $data;

//echo $res;

echo json_encode($response);
?>