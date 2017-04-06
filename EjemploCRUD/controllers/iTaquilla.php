<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.taquilla.php");
	$obj = new taquilla();
	if (isset($_POST['id_taquillero']) && isset($_POST['taquillero']) && isset($_POST['descripcion']) && isset($_POST['id_cliente'])){
		$obj->id_taquillero=$_POST['id_taquillero'];
		$obj->taquillero=$_POST['taquillero'];
		$obj->descripcion=$_POST['descripcion'];
		$obj->id_cliente=$_POST['id_cliente'];
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
