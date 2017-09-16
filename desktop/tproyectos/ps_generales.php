<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $nombre = trim($_POST['cg_nombrep']);
    $sector = trim($_POST['cg_sector']);
    $video = trim($_POST['cg_video']);
    $www = trim($_POST['cg_www']);
    $fb = trim($_POST['cg_fb']);
    $tw = trim($_POST['cg_tw']);
    $insta = trim($_POST['cg_insta']);
    $linkedin = trim($_POST['cg_linkedin']);
    $replegal = trim($_POST['cg_replegal']);
    $curp = trim($_POST['cg_curp']);
    $tel = trim($_POST['cg_tel']);

    $nombre = strip_tags($nombre);
    $sector = strip_tags($sector);
    $video = strip_tags($video);
    $www = strip_tags($www);
    $fb = strip_tags($fb);
    $tw = strip_tags($tw);
    $insta = strip_tags($insta);
    $linkedin = strip_tags($linkedin);
    $replegal = strip_tags($replegal);
    $curp = strip_tags($curp);
    $tel = strip_tags($tel);


    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->upd_generales($DBcon, $idProyecto, $nombre, $sector, $video, $www, $fb, $tw, $insta, $linkedin);
    // acualizo los fiscales
    $resFiscales = $myIns->upd_fiscales1($DBcon, $idProyecto, $replegal, $curp, $tel);

    // verifico el porcentaje de avance
    $cantidadPreguntas = 11;
    $contestadas = 0;
    $tabla = "tproyectos";
    $fields = " cname, csector1, cvideo, cwww, cfb, ctw, cins, clinkedin ";
    $where = " WHERE id = '".$idProyecto."'";

    $vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
    $contestadas = 11-$vacios;

    $tabla = "tfiscales";
    $fields = " cnombre, creplegalcurp, creplegaltel ";
    $where = " WHERE idproyecto = '".$idProyecto."'";

    $vacios2 = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
    $contestadas = $contestadas - $vacios2;

    $porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);

    $grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);

    $res['grafica'] = $grafica;

}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>