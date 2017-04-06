<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.actividad.php");
	$obj = new actividad();
	if (isset($_POST['codigo']) && isset($_POST['descripcion'])){
		$obj->id=$_POST['codigo'];
		$obj->descripcion=$_POST['descripcion'];
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
