<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $competidor = trim($_POST['cc_competidor']);
    $dif = trim($_POST['cc_diferenciador']);
    $propuesta = trim($_POST['cc_propuesta']);

    $competidor = strip_tags($competidor);
    $dif = strip_tags($dif);
    $propuesta = strip_tags($propuesta);


    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->ins_datosCompetencia($DBcon, $idProyecto, $competidor, $dif, $propuesta );
    $data = $myIns->get_datoscompetencia($DBcon, $idProyecto);
    $res['informacion'] = $data;

    // verifico el porcentaje de avance
    $tabla = "tp_competencia";
    $fields = " cp_competidor, cp_diferenciador, cp_propuestav  ";
    $where = " WHERE idproyecto = '".$idProyecto."'";

    $porcentajeAvance = $myIns->get_rowsadded($DBcon, $tabla,$fields,$where);
    $grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);

    $res['grafica'] = $grafica;

    // actualizo los datos totales y actualizo la grafica
    /// Obtiene el AVANCE TOTAL ACTUAL
    if($porcentajeAvance == 100)
    {
        //$avance = $avance+1;
        $myIns->upd_tavance($DBcon,$idProyecto,"cs10", 1);
    }
    $avance = $myIns->get_totaldatostavance($DBcon, $idProyecto);
    $graficaTotal = $myIns->set_displayAvanceTotalDiv(19,$avance);
    $res['graf_total'] = $graficaTotal;
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>