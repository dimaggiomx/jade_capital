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


// obtiene avances
// verifico el porcentaje de avance Generales
$cantidadPreguntas = 11;
$contestadas = 0;
$tabla = "tproyectos";
$fields = " cname, csector1, cvideo, cwww, cfb, ctw, cins, clinkedin ";
$where = " WHERE id = '".$idProyecto."'";
$vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
$contestadas = $cantidadPreguntas-$vacios;
$tabla = "tfiscales";
$fields = " creplegal, creplegalcurp, creplegaltel ";
$where = " WHERE idproyecto = '".$idProyecto."'";
$vacios2 = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
$contestadas = $contestadas - $vacios2;
$porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_generales'] = $grafica;


// verifico el porcentaje de avance Fiscales
$cantidadPreguntas = 11;
$contestadas = 0;
$tabla = "tfiscales";
$fields = " crfc, cnombre, cpais, cestado, ccalle, cnoext, cnoint, ccolonia, cmunicipio, ccp, cfecharegistro ";
$where = " WHERE idproyecto = '".$idProyecto."'";
$vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
$contestadas = $cantidadPreguntas-$vacios;
$porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_fiscales'] = $grafica;


// verifico avances para el logo
$cantidadPreguntas = 1;
$contestadas = 0;
$tabla = "tproyectos";
$fields = " clogo ";
$where = " WHERE id = '".$idProyecto."' AND clogo != '../plugins/images/default_img.jpg'";
$vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
$contestadas = $cantidadPreguntas-$vacios;
$porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_logo'] = $grafica;


// verifico avances para el idProyecto
$cantidadPreguntas = 1;
$contestadas = 0;
$tabla = "tfiscales";
$fields = " cscanid ";
$where = " WHERE idproyecto = '".$idProyecto."' AND cscanid != '../plugins/images/default_img.jpg'";
$vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
$contestadas = $cantidadPreguntas-$vacios;
$porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_idproyecto'] = $grafica;



// verifico el porcentaje de avance de Inversion
$cantidadPreguntas = 4;
$contestadas = 0;
$tabla = "tproyectos";
$fields = " cmetamin, cfinrecursos, cstartup, cmeses  ";
$where = " WHERE id = '".$idProyecto."'";
$vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
$contestadas = $cantidadPreguntas-$vacios;
$porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_inversion'] = $grafica;


// verifico el porcentaje de avance de Bancarios
$cantidadPreguntas = 6;
$contestadas = 0;
$tabla = "tp_bancario";
$fields = " cp_nombre, cp_email, cp_clabe, cp_titular, cp_rfc, cp_recibo  ";
$where = " WHERE idproyecto = '".$idProyecto."'";
$vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
$contestadas = $cantidadPreguntas-$vacios;
$porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_bancarios'] = $grafica;


// verifico el porcentaje de avance de Producto
$cantidadPreguntas = 4;
$contestadas = 0;
$tabla = "tproyectos";
$fields = " cproducto, ctipo, cetapa, cpatente  ";
$where = " WHERE id = '".$idProyecto."'";
$vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
$contestadas = $cantidadPreguntas-$vacios;
$porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_producto'] = $grafica;

// verifico el porcentaje de avance de idea
$cantidadPreguntas = 4;
$contestadas = 0;
$tabla = "tproyectos";
$fields = " cproblema, csolucion, cplannegocios_st, cresultados_st  ";
$where = " WHERE id = '".$idProyecto."'";
$vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
$contestadas = $cantidadPreguntas-$vacios;
$porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_idea'] = $grafica;


// verifico avances para el showcase


// verifico el porcentaje de avance de competencia
$tabla = "tp_competencia";
$fields = " cp_competidor, cp_diferenciador, cp_propuestav  ";
$where = " WHERE idproyecto = '".$idProyecto."'";
$porcentajeAvance = $myIns->get_rowsadded($DBcon, $tabla,$fields,$where);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_competencia'] = $grafica;

// verifico el porcentaje de avance de mercado
$tabla = "tp_mercado";
$fields = " *  ";
$where = " WHERE idproyecto = '".$idProyecto."'";
$porcentajeAvance = $myIns->get_rowsadded($DBcon, $tabla,$fields,$where);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_mercado'] = $grafica;

// verifico el porcentaje de avance de negocio
$cantidadPreguntas = 10;
$contestadas = 0;
$tabla = "tproyectos";
$fields = " csupuestosclave, cmodeloingresos, cunidades, cprecio, cingreso, ccostos, ccapex, cventas, ceeff, cutilidad  ";
$where = " WHERE id = '".$idProyecto."'";
$vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);
$contestadas = $cantidadPreguntas-$vacios;
$porcentajeAvance = $myIns->set_porcentajeAvance($cantidadPreguntas, $contestadas);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_negocio'] = $grafica;


// verifico el porcentaje de avance de fuente de ingresos
$tabla = "tp_fuente";
$fields = " *  ";
$where = " WHERE idproyecto = '".$idProyecto."'";
$porcentajeAvance = $myIns->get_rowsadded($DBcon, $tabla,$fields,$where);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_fuente'] = $grafica;


// verifico el porcentaje de avance de costos
$tabla = "tp_costos";
$fields = " *  ";
$where = " WHERE idproyecto = '".$idProyecto."'";
$porcentajeAvance = $myIns->get_rowsadded($DBcon, $tabla,$fields,$where);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_costos'] = $grafica;


// verifico el porcentaje de avance de historia
$tabla = "tp_historia";
$fields = " *  ";
$where = " WHERE idproyecto = '".$idProyecto."'";
$porcentajeAvance = $myIns->get_rowsadded($DBcon, $tabla,$fields,$where);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_historia'] = $grafica;


// verifico el porcentaje de avance de equipo
$tabla = "tp_equipo";
$fields = " *  ";
$where = " WHERE idproyecto = '".$idProyecto."'";
$porcentajeAvance = $myIns->get_rowsadded($DBcon, $tabla,$fields,$where);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_equipo'] = $grafica;

// verifico el porcentaje de avance de riesgos
$tabla = "tp_riesgos";
$fields = " *  ";
$where = " WHERE idproyecto = '".$idProyecto."'";
$porcentajeAvance = $myIns->get_rowsadded($DBcon, $tabla,$fields,$where);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_riesgos'] = $grafica;


// verifico el porcentaje de avance de plan
$tabla = "tp_plan";
$fields = " *  ";
$where = " WHERE idproyecto = '".$idProyecto."'";
$porcentajeAvance = $myIns->get_rowsadded($DBcon, $tabla,$fields,$where);
$grafica = $myIns->set_displayAvanceDiv($porcentajeAvance);
$res['graf_plan'] = $grafica;


/// Obtiene el AVANCE TOTAL ACTUAL
$avance = $myIns->get_totaldatostavance($DBcon, $idProyecto);
$graficaTotal = $myIns->set_displayAvanceTotalDiv(19,$avance);
$res['graf_total'] = $graficaTotal;

//error_log($graficaTotal, 0);

$res['status'] = 'success'; // could not register

echo json_encode($res);
?>