<?php
	session_start();
  	header('Content-Type: text/html; charset=utf-8');
	$folderName = 'php';
	$domain = $_SERVER['SERVER_NAME'];
	define('dbPrefix', 'sm_');	
	//Cấu hình Host/localhost
	if($domain == 'localhost'){
		define('dbName', $folderName); 
		define('baseUrl', 'http://'.$domain.'/'.$folderName.'/');
		define('dbUser', 'root'); 
		define('dbPass', '');
	}else{
		define('dbUser', 'tuananh_admin');
		define('dbPass', 'anhnhomnhua96');
		define('dbName', 'tuananh_'.$folderName);
		define('baseUrl', 'http://'.$domain.'/'.$folderName.'/');
	}
	require_once('modules/sql.php');
?>