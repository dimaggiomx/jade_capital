<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");

require_once '../global.config.php';
require_once '../config.php';

$ds = DIRECTORY_SEPARATOR;  //1

$storeFolder = 'uploads';   //2

//establezco el path del archivo destino
// idUsuario/archivo

$dir1 = $_SESSION["ses_id"];

//Check if the directory already exists. (idUsuario)
if(!is_dir(C_MAINDIR . $ds.$storeFolder.$ds.$dir1)){
    //Directory does not exist, so lets create it.
    mkdir(C_MAINDIR . $ds.$storeFolder.$ds.$dir1, 0755);
}

// sube archivos
if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];          //3

    $targetPath = C_MAINDIR . $ds. $storeFolder . $ds;  //4

    //$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4

    //$targetFile =  $targetPath. $_FILES['file']['name'];  //5

    $targetFile = $targetPath.$dir1.$ds.$dir1.'_ph1_'.$_FILES['file']['name']; //5
    $bdFilePath = $storeFolder.$ds.$dir1.$ds.$dir1.'_ph1_'.$_FILES['file']['name'];

    move_uploaded_file($tempFile,$targetFile); //6

    // almaceno en BD la info
    require_once(C_P_CLASES.'actions/a.usuarios.php');
    $myReg = new A_USR("");

    // actualizo foto
    $response = $myReg->upd_userphoto1($DBcon,$dir1,$bdFilePath);
}

?>