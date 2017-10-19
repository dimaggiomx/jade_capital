<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


if ($_POST) {

    $banco = trim($_POST['cb_banco']);
    $email = trim($_POST['cb_email']);
    $clabe = trim($_POST['cb_clabe']);
    $titular = trim($_POST['cb_titular']);
    $rfc = trim($_POST['cb_rfctitular']);


    $banco = strip_tags($banco);
    $email = strip_tags($email);
    $clabe = strip_tags($clabe);
    $titular = strip_tags($titular);
    $rfc = strip_tags($rfc);



    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myIns = new A_PRO("");

    // actualizo los generales
    $res = $myIns->upd_bancarios($DBcon, $idProyecto, $banco, $email, $clabe, $titular, $rfc);

    // verifico el porcentaje de avance
    $cantidadPreguntas = 5;
    $contestadas = 0;
    $tabla = "tp_bancario";
    $fields = " cp_nombre, cp_email, cp_clabe, cp_titular, cp_rfc, cp_recibo  ";
    $where = " WHERE idproyecto = '".$idProyecto."'";

    $vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
    $contestadas = $cantidadPreguntas-$vacios;

    $porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);

    $grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);

    $res['grafica'] = $grafica;

    // actualizo los datos totales y actualizo la grafica
    /// Obtiene el AVANCE TOTAL ACTUAL
    if($porcentajeAvance == 100)
    {
        //$avance = $avance+1;
        $myIns->upd_tavance($DBcon,$idProyecto,"cs6", 1);
    }
    $avance = $myIns->get_totaldatostavance($DBcon, $idProyecto);
    $graficaTotal = $myIns->set_displayAvanceTotalDiv(19,$avance);
    $res['graf_total'] = $graficaTotal;
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>