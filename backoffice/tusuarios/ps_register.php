<?php
header('Content-type: application/json');
$response = array();

require_once '../global.config.php';
require_once '../config.php';


if ($_POST) {

    $usuario = trim($_POST['c_mail']);
    $password = trim($_POST['c_pass']);
    $passconfirm = trim($_POST['c_confirm']);
    $privilegio = trim($_POST['c_tipo']);
    $nombre = trim($_POST['c_nombre']);


    $usuario = strip_tags($usuario);
    $password = strip_tags($password);
    $nombre = strip_tags($nombre);

    if($password == $passconfirm)
    {
        // sha256 password hashing
        $hashed_password = hash('sha256', $password);

        require_once(C_P_CLASES.'actions/a.usuarios.php');
        $myIns = new A_USR("");
        // agrego valores
        $myIns->add_data("",$usuario,$nombre,"","","","","","","","","","","","",$hashed_password,"",1,"",$privilegio,"","");
        // verifico si existe usuario
        $res = $myIns->user_exist($DBcon,$usuario,"");

        if($res['status'] == 'success'){
            // no existe,  registro usuario
            $res = $myIns->ins_user($DBcon);
            // otros procesos
            if($res['status'] == 'success')
            {
                // pongo permisos
                $resP = $myIns->ins_permisos($DBcon,$myIns->get_lastId(),$privilegio);
                // mando correo
                $resM = $myIns->send_regMail('info@jadecapitalflow.com',$usuario,$myIns->get_tmpguid());

                // agrego a debug
                $res['debug'] = $res['debug'].'-'.$resP['debug'].'-'.$resM['debug'];
                //$res['debug'] = $res['debug'].'-'.$resP['message'].'-'.$resM['message'];
            }
        }

    }else{
        $res['status'] = 'error'; // could not register
        $res['message'] = 'Contraseñas no coinciden!';
        $res['debug'] = '-COOL-';
    }

}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>