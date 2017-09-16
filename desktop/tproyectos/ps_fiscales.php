<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $rfc = trim($_POST['cf_rfc']);
    $nombre = trim($_POST['cf_nombre']);
    $pais = trim($_POST['cf_pais']);
    $estado = trim($_POST['cf_estado']);
    $calle = trim($_POST['cf_calle']);
    $noext = trim($_POST['cf_noext']);
    $noint = trim($_POST['cf_noint']);
    $colonia = trim($_POST['cf_colonia']);
    $municipio = trim($_POST['cf_municipio']);
    $cp = trim($_POST['cf_cp']);
    $regdate = trim($_POST['cf_regdate']);

    $rfc = strip_tags($rfc);
    $nombre = strip_tags($nombre);
    $pais = strip_tags($pais);
    $estado = strip_tags($estado);
    $calle = strip_tags($calle);
    $noext = strip_tags($noext);
    $noint = strip_tags($noint);
    $colonia = strip_tags($colonia);
    $municipio = strip_tags($municipio);
    $cp = strip_tags($cp);
    $regdate = strip_tags($regdate);


    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->upd_fiscales2($DBcon, $idProyecto, $rfc, $nombre, $pais, $estado, $calle, $noext, $noint, $colonia, $municipio, $cp, $regdate);

    // verifico el porcentaje de avance
    $cantidadPreguntas = 11;
    $contestadas = 0;
    $tabla = "tfiscales";
    $fields = " crfc, cnombre, cpais, cestado, ccalle, cnoext, cnoint, ccolonia, cmunicipio, ccp, cfecharegistro ";
    $where = " WHERE idproyecto = '".$idProyecto."'";

    $vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
    $contestadas = 11-$vacios;

    $porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);

    $grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);

    $res['grafica'] = $grafica;
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>