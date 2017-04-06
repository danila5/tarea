<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.cliente.php");
	$obj = new cliente();
	if (isset($_POST['id_cliente'])){
		echo $obj->delete($_POST['id_cliente']);
	}
	else{
		echo "-2";
	}
?>
