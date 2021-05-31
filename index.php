<?php 
	session_start();
	include "config/database.php";
	include "config/controller.php";	
	//---
	$controller = isset($_GET["controller"])?$_GET["controller"]:"Home";
	$controller = $controller."Controller";
	$action = isset($_GET["action"])?$_GET["action"]:"index";
	$controllerPath = "controllers/$controller.php";
	if(file_exists($controllerPath)){
		include $controllerPath;
		$obj = new $controller();
		$obj->$action();
	}
	//---
 ?>