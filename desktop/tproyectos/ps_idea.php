<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $problema = trim($_POST['cp_problema']);
    $solucion = trim($_POST['cp_solucion']);
    $negocio = trim($_POST['cp_negocio']);
    $resultados = trim($_POST['cp_resultados']);


    $problema = strip_tags($problema);
    $solucion = strip_tags($solucion);
    $negocio = strip_tags($negocio);
    $resultados = strip_tags($resultados);



    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->upd_ideaproyecto($DBcon, $idProyecto, $problema, $solucion, $negocio, $resultados);

    // verifico el porcentaje de avance
    $cantidadPreguntas = 4;
    $contestadas = 0;
    $tabla = "tproyectos";
    $fields = " cproblema, csolucion, cplannegocios_st, cresultados_st  ";
    $where = " WHERE id = '".$idProyecto."'";

    $vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
    $contestadas = $cantidadPreguntas-$vacios;

    $porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);

    $grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);

    $res['grafica'] = $grafica;

    // actualizo los datos totales y actualizo la grafica
    /// Obtiene el AVANCE TOTAL ACTUAL
    $avance = $myIns->get_datosavance($DBcon, $idProyecto);
    if($porcentajeAvance == 100)
    {
        $avance = $avance+1;
        $myIns->upd_avance($DBcon,$idProyecto,$avance);
    }
    $graficaTotal = $myIns->set_displayAvanceTotalDiv(18,$avance);
    $res['graf_total'] = $graficaTotal;
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>