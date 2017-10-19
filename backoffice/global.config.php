<?php
	//Para definir
	define('C_WWW', 'http://localhost/');
	define('C_SITEFOLDER','jade_capital/backoffice');
    define('C_ROOTSITEFOLDER','jade_capital');

    define('C_MAINDIR', $_SERVER ['DOCUMENT_ROOT'].'/'.C_SITEFOLDER);
	define('C_DOMAIN', C_WWW.C_SITEFOLDER.'/');
	define('C_SITE_MAINDIR', C_MAINDIR.'/');
	define('C_SITE_COMPLETE', C_MAINDIR.'/');
	define('C_P_FOLDERNAME', C_SITEFOLDER);
	
	// defino constantes a usar durant todo el sistema
	define('C_P_CLASES', C_SITE_MAINDIR.'config/');
	define('C_P_DB', C_SITE_MAINDIR.'config.php');
    define('C_P_FOTOS',$_SERVER ['DOCUMENT_ROOT'].'/'.C_ROOTSITEFOLDER.'/uploads');

    define('C_P_GALERIA', 'uploads');
	define('C_P_TITLE', 'Jade Capital Flow ');

    $login_redirect = "login.html"; // page to directed to when logged in
    $logout_redirect = "out.php"; // redirect to your own logout page.
?>