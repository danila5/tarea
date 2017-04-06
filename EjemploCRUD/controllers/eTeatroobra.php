<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.teatroobra.php");
	$obj = new teatroobra();
	if (isset($_POST['id'])){
		echo $obj->delete($_POST['id']);
	}
	else{
		echo "-2";
	}
?>
