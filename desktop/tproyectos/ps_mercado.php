<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$res = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $cliente = trim($_POST['cm_cliente']);
    $segmento = trim($_POST['cm_segmento']);
    $mercado = trim($_POST['cm_mercado']);
    $marketing = trim($_POST['cm_marketing']);
    $ventas = trim($_POST['cm_ventas']);
    $precio = trim($_POST['cm_precio']);

    $cliente = strip_tags($cliente);
    $segmento = strip_tags($segmento);
    $mercado = strip_tags($mercado);
    $marketing = strip_tags($marketing);
    $ventas = strip_tags($ventas);
    $precio = strip_tags($precio);


    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->ins_datosMercado($DBcon, $idProyecto, $cliente, $segmento, $mercado, $marketing, $ventas, $precio);
    $data = $myIns->get_datosmercado($DBcon, $idProyecto);

    $res['informacion'] = $data;

    // verifico el porcentaje de avance
    $tabla = "tp_mercado";
    $fields = " *  ";
    $where = " WHERE idproyecto = '".$idProyecto."'";

    $porcentajeAvance = $myIns->get_rowsadded($DBcon, $tabla,$fields,$where);
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