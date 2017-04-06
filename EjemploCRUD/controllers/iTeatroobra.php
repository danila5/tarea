<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.teatroobra.php");
	$obj = new teatroobra();
	if (isset($_POST['codigo']) && isset($_POST['hora'])){
		$obj->id=$_POST['codigo'];
		$obj->hora=$_POST['hora'];
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
