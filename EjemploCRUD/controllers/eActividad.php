<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.actividad.php");
	$obj = new actividad();
	if (isset($_POST['id'])){
		echo $obj->delete($_POST['id']);
	}
	else{
		echo "-2";
	}
?>
