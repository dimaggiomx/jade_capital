<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';


if ($_POST) {
//    cumple,curp,pasaporte,www,fb,tw,ins,about,pais


    $cumple = trim($_POST['cbdate']);
    $curp = trim($_POST['ccurp']);
    $pasaporte = trim($_POST['cpassport']);
    $www = trim($_POST['cwww']);
    $fb = trim($_POST['cfb']);
    $tw = trim($_POST['ctw']);
    $ins = trim($_POST['cins']);
    $about = trim($_POST['cdescripcion']);
    $pais = trim($_POST['cnation']);

    $cumple = strip_tags($cumple);
    $curp = strip_tags($curp);
    $pasaporte = trim($pasaporte);
    $www = strip_tags($www);
    $fb = strip_tags($fb);
    $tw = strip_tags($tw);
    $ins = strip_tags($ins);
    $about = strip_tags($about);
    $pais = strip_tags($pais);

        require_once(C_P_CLASES.'actions/a.usuarios.php');
        $myIns = new A_USR("");
        // agrego valores
        $myIns->add_data($_SESSION['ses_id'],"","","",$cumple,$pais,$curp,$pasaporte,$www,$fb,$tw,$ins,"","","","","","","","","",$about);
        // Actualizo datos
        $res = $myIns->upd_userperfil($DBcon,$_SESSION['ses_id']);
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>