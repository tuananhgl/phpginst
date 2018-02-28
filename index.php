<?php  
	ini_set('display_errors', true);
	include('config.php');
	if(isset($_GET['page'])) {
		$getPage = $_GET['page'];
	}
	if(isset($_GET['controller'])) {
		$controller = $_GET['controller'];
		if(isset($_GET['action'])) {
			$action = $_GET['action'];
		}else {
			$action = 'index';
		}
	}else {
		$controller = 'pages';
		$getPage = 'home';
		$action = 'index';
	}
	require_once('routes.php');
?>