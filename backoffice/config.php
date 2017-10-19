<?php
	//define conexion a BD
	define('DBhost', 'localhost');
	define('DBuser', 'enzo');
	define('DBPass', 'minino');
	define('DBname', 'jade_capdb');

// pro fVbqwsUZJ0Re
// nuestrab_prodbus
// nuestrab_proyectadb

	try {
		
		$DBcon = new PDO("mysql:host=".DBhost.";dbname=".DBname,DBuser,DBPass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
	} catch(PDOException $e){
		
		die($e->getMessage());
	}

?>