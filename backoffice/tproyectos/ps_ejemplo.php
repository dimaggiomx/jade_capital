<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$res = array();

require_once '../global.config.php';
require_once '../config.php';

$idProyecto = $_SESSION["ses_idP"];


require_once(C_P_CLASES.'actions/a.proyectos.php');
$myIns = new A_PRO("");


$tabla = "tproyectos";
$fields = " cname, csector1, cvideo, cwww, cfb, ctw, cins, clinkedin ";
$where = " WHERE id = '".$idProyecto."'";

$vacios = $myIns->get_rowsnotempty($DBcon, $tabla,$fields,$where);

echo $vacios;

$porcentajeAvance = $myIns->set_porcentajeAvance(8,8-$vacios);

echo "<br>";

echo $porcentajeAvance;

echo "<br>";



/*

$query = "SELECT  * from tproyectos where id=1";


$columa = "";

// just an example of an empty query.
$stmt =$DBcon->query($query);
$obj = $stmt->fetchObject();

for ($i=0; $i<$stmt->columnCount(); $i++) {

    $columa = $stmt->getColumnMeta($i)['name'];

    //$stmt->execute();
    echo $obj->$columa." - ";


    echo $columa."<br />";
}

*/

?>