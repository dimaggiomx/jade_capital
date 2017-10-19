<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

$response = array();


if ($_POST) {

    $var2 = $_POST['page'];

    require_once(C_P_CLASES.'actions/a.market.php');
    $myReg = new A_MARKET("");
    $disp = $myReg->search_market($DBcon,$var2,5);
    $disp = $myReg->disp_marketPage();

}


$response['status'] = 'success'; // could not register
$response['message'] = '&nbsp; Mostrando registros...';
$response['result'] =$disp;

echo json_encode($response);
?>