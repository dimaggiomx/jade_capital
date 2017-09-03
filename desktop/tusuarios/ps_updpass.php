<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';


if ($_POST) {

    $oldpass = trim($_POST['coldpass']);
    $newpass = trim($_POST['cpass']);
    $confirm = trim($_POST['cconfirm']);

    $oldpass = strip_tags($oldpass);
    $newpass = strip_tags($newpass);
    $confirm = strip_tags($confirm);

    // verifico cambio de pass
        if($newpass == $confirm) {
            // sha256 password hashing
            $hashed_new_password = hash('sha256', $newpass);
            $hashed_old_password = hash('sha256', $oldpass);

            require_once(C_P_CLASES.'actions/a.usuarios.php');
            $myIns = new A_USR("");

            // verifico que el password actual este correcto
            $subquery = " AND cpass = '".$hashed_old_password."'";
            $passOk = $myIns->user_exist($DBcon,$_SESSION["ses_cuser"],$subquery);

            if($passOk['status'] == 'error')  //porque es un usuario existente de acuerdo a la funcion
            {
                $passOk['status'] = 'success';
                // agrego valores
                $myIns->add_data($_SESSION['ses_id'],"","","","","","","","","","","","","","",$hashed_new_password,"","","","","","");
                $res = $myIns->upd_userpass($DBcon,$_SESSION['ses_id']);
            }
            else{
                $passOk['status'] = 'error';
                $res = $passOk;
            }
        }
        else{
            $res['status'] = 'error'; // could not register
            $res['message'] = 'Contraseñas no coinciden!';
            $res['debug'] = '-COOL-';
        }


}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>