<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.cliente.php");
	$obj = new cliente();
	if (isset($_POST['id_cliente']) && isset($_POST['nombre'])&& isset($_POST['descripcion'])){
		$obj->id_cliente=$_POST['id_cliente'];
		$obj->nombre=$_POST['nombre'];
		$obj->descripcion=$_POST['descripcion'];
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
