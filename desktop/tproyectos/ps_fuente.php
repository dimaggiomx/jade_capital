<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $desc = trim($_POST['cfu_descripcion']);
    $valor = trim($_POST['cfu_valor']);

    $desc = strip_tags($desc);
    $valor = strip_tags($valor);


    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->ins_datosFuente($DBcon, $idProyecto, $desc, $valor);
    $data = $myIns->get_datosfuente($DBcon, $idProyecto);

    $res['informacion'] = $data;

    // verifico el porcentaje de avance
    $tabla = "tp_fuente";
    $fields = " *  ";
    $where = " WHERE idproyecto = '".$idProyecto."'";

    $porcentajeAvance = $myIns->get_rowsadded($DBcon, $tabla,$fields,$where);
    $grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);

    $res['grafica'] = $grafica;

    // actualizo los datos totales y actualizo la grafica
    /// Obtiene el AVANCE TOTAL ACTUAL
    if($porcentajeAvance == 100)
    {
        //$avance = $avance+1;
        $myIns->upd_tavance($DBcon,$idProyecto,"cs13", 1);
    }
    $avance = $myIns->get_totaldatostavance($DBcon, $idProyecto);
    $graficaTotal = $myIns->set_displayAvanceTotalDiv(19,$avance);
    $res['graf_total'] = $graficaTotal;
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>