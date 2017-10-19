<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");

require_once '../global.config.php';
require_once '../config.php';

$response = array();


if ($_POST) {

    $var2 = $_POST['page'];

    require_once(C_P_CLASES.'actions/a.validar.php');
    $myReg = new A_VAL("");

    $disp = $myReg->get_pendingproject($DBcon,$var2,10);
    $disp = $myReg->disp_pendingPage();

}


$response['status'] = 'success'; // could not register
$response['message'] = '&nbsp; Exito..';
$response['result'] =$disp;

echo json_encode($response);
?>