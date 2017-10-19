<?php
header('Content-type: application/json');
$response = array();

require_once '../global.config.php';
require_once '../config.php';


if ($_POST) {

    $usuario = trim($_POST['cuser']);
    $password = trim($_POST['cpass']);

    $usuario = strip_tags($usuario);
    $password = strip_tags($password);

        // sha256 password hashing
        $hashed_password = hash('sha256', $password);

        require_once(C_P_CLASES.'actions/a.usuarios.php');
        $myIns = new A_USR("");

        // verifico si existe usuario y esta activo
        $subquery = " AND cstatus = 2 and cpass = '".$hashed_password."'";
        $res = $myIns->user_exist($DBcon,$usuario,$subquery);

        if($res['status'] == 'error'){
            // lo pongo como correcto (es correcto que si exista el usuario
            $res['status'] = 'success';
            // si existe,  obtengo sus datos
            $objDatosUsr = $myIns->get_userdata($DBcon, $usuario);
            // inicio sesion y guardo variables de sesion
            session_start();

            $_SESSION["ses_id"]	= $objDatosUsr->id;
            $_SESSION["ses_cuser"] = $objDatosUsr->cuser;
            $_SESSION["ses_ctipo"] = $objDatosUsr->ctipo;  // el privilegio es el tipo de user (inversionista B, Empresa C)
            $_SESSION["ses_cname"] = $objDatosUsr->cname;
            $_SESSION["ses_dtipo"] = 'Admin';
            $_SESSION["ses_cphoto1"] = $objDatosUsr->cphoto1;


            // establezco liga de acceso
            $res['URL'] = 'desktop.php';

            //$res['debug'] = $res['debug'].'-'.$resP['message'].'-'.$resM['message'];
        }else{
            // lo pongo como INcorrecto (usuario o pass erroneo)
            $res['status'] = 'error';
            // msg de debug
            //$res['debug'] = $res['debug'].'-'.$resP['message'].'-'.$resM['message'];

        }
}

echo json_encode($res);
?>