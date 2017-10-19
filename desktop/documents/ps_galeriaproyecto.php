<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");

require_once '../global.config.php';
require_once '../config.php';

$ds = DIRECTORY_SEPARATOR;  //1

$storeFolder = 'uploads';   //2

//establezco el path del archivo destino
// idUsuario/idEmpresa-idInversionista/archivo

$dir1 = $_SESSION["ses_id"];
$dir2 = $_SESSION["ses_idP"];
$dir3 = "galeria";


// directorio final:
// documents/uploads/idUsuario/idProyecto

//Check if the directory already exists. (idUsuario)
if(!is_dir(C_P_FOTOS.$ds.$dir1)){
    //Directory does not exist, so lets create it.
    mkdir(C_P_FOTOS.$ds.$dir1, 0755);
}


//Check if the directory already exists. (idUsuario/idProyecto)
if(!is_dir(C_P_FOTOS.$ds.$dir1.$ds.$dir2)){
    //Directory does not exist, so lets create it.
    mkdir(C_P_FOTOS.$ds.$dir1.$ds.$dir2, 0755);
}


//Check if the directory Galeria already exists. (idUsuario/idProyecto/galeria)
if(!is_dir(C_P_FOTOS.$ds.$dir1.$ds.$dir2.$ds.$dir3)){
    //Directory does not exist, so lets create it.
    mkdir(C_P_FOTOS.$ds.$dir1.$ds.$dir2.$ds.$dir3, 0755);
}

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];          //3

    $targetPath =  C_P_FOTOS . $ds;  //4

    //$targetFile =  $targetPath. $_FILES['file']['name'];  //5

    $targetFile = $targetPath.$dir1.$ds.$dir2.$ds.$dir3.$ds.$_FILES['file']['name']; //5
    $bdFilePath = C_P_GALERIA . $ds .$dir1.$ds.$dir2.$ds.$dir3.$ds.$_FILES['file']['name'];

    move_uploaded_file($tempFile,$targetFile); //6

    // almaceno en BD la info del avance
    require_once(C_P_CLASES.'actions/a.proyectos.php');
    $myReg = new A_PRO("");
    $myReg->upd_tavance($DBcon,$dir2,"cs9", 1);


    /*
    // registro foto
    $response = $myReg->upd_logoproyecto($DBcon,$dir2,$bdFilePath);
    */

}
?>