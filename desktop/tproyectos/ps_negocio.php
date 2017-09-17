<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $supuesto = trim($_POST['cn_supuestos']);
    $modelo = trim($_POST['cn_modelo']);
    $vendidas = trim($_POST['cn_vendidas']);
    $precio = trim($_POST['cn_precio']);
    $ingresos = trim($_POST['cn_ingresos']);
    $costos = trim($_POST['cn_costos']);
    $capex = trim($_POST['cn_capex']);
    $ventas = trim($_POST['cn_ventas']);
    $eeff = trim($_POST['cn_eeff']);
    $utilidad = trim($_POST['cn_utilidad']);


    $supuesto = strip_tags($supuesto);
    $modelo = strip_tags($modelo);
    $vendidas = strip_tags($vendidas);
    $precio = strip_tags($precio);
    $ingresos = strip_tags($ingresos);
    $costos = strip_tags($costos);
    $capex = strip_tags($capex);
    $ventas = strip_tags($ventas);
    $eeff = strip_tags($eeff);
    $utilidad = strip_tags($utilidad);



    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->upd_negocio($DBcon, $idProyecto, $supuesto, $modelo, $vendidas, $precio, $ingresos, $costos, $capex, $ventas, $eeff, $utilidad);

    // verifico el porcentaje de avance
    $cantidadPreguntas = 10;
    $contestadas = 0;
    $tabla = "tproyectos";
    $fields = " csupuestosclave, cmodeloingresos, cunidades, cprecio, cingreso, ccostos, ccapex, cventas, ceeff, cutilidad  ";
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