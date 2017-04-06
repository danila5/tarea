<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.taquilla.php");
	$obj = new taquilla();
	if (isset($_POST['id_taquillero'])){
		echo $obj->delete($_POST['id_taquillero']);
	}
	else{
		echo "-2";
	}
?>
