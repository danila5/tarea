<?php
ini_set('display_errors', 'off');
include_once("resources/class.database.php");

class taquilla{
	var $id_taquillero;
	var $taquillero;
  	var $descripcion;
	var $id_cliente;

function taquilla(){
}

function select($id_taquillero){
	$sql =  "SELECT * FROM administrador.tbl_taquilla WHERE id_taquillero = '$id_taquillero'";
	try {
		$row = pg::query($sql);
		$row=pg_fetch_array($row);
		$this->id_taquillero = $row['id_taquillero'];
		$this->taquillero = $row['taquillero'];
		$this->descripcion = $row['descripcion'];
		$this->id_cliente = $row['id_cliente'];
		return true;
	}
	catch (DependencyException $e) {
	}
}

function delete($id_taquillero){
	$sql = "DELETE FROM administrador.tbl_taquilla WHERE id_taquillero = '$id_taquillero'";
	try {
		pg::query("begin");
		$row = pg::query($sql);
		pg::query("commit");
		return "1";
	}
	catch (DependencyException $e) {
		pg::query("rollback");
		return "-1";
	}
}

function insert(){
	//echo "me llamo";
	if ($this->validaP($this->id_taquillero) == false){
		$sql = "INSERT INTO administrador.tbl_taquilla( id_taquillero, taquillero, descripcion, id_cliente) VALUES ( '$this->id_taquillero', '$this->taquillero', '$this->descripcion', '$this->id_cliente')";
		try {
			pg::query("begin");
			$row = pg::query($sql);
			pg::query("commit");
			echo "1";
		}
		catch (DependencyException $e) {
			echo "Error: " . $e;
			pg::query("rollback");
			echo "-1";
		}
	}
	else{
		$sql="UPDATE administrador.tbl_taquilla set descripcion='" . $this->descripcion . "', taquillero='" . $this->taquillero . "',id_cliente='" . $this->id_cliente . "' WHERE id_taquillero='" . $this->id_taquillero . "'";
		pg::query("begin");
		$row = pg::query($sql);
		pg::query("commit");		
		echo "2";
	}
}

function validaP ($id_taquillero){
      $sql =  "SELECT * FROM administrador.tbl_taquilla WHERE id_taquillero = '$id_taquillero'";
      try {
		$row = pg::query($sql);
		if(pg_num_rows($row) == 0){
		        return false;
	        }
		else{
			return true;
		 }
		}
		catch (DependencyException $e) {
			//pg::query("rollback");
			return false;
		}
}

function getTabla(){
	
	$sql="SELECT * FROM administrador.tbl_taquilla";
	try {
		echo "<div class='container' style='margin-top: 10px'>";
		echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
		echo "<thead>";
		echo "<tr>";
		echo "	<th>Codigo</th>";
		echo "	<th>Nombre</th>";
		echo "	<th>Descripcion</th>";
		echo "	<th>Cliente</th>";
		echo "	<th>.</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<tr class='gradeA'>";
			echo "	<th>" . $row['id_taquillero'] . "</th>";
			echo "	<th>" . $row['taquillero'] . "</th>";
			echo "	<th>" . $row['descripcion'] . "</th>";
			echo "	<th>" . $row['id_cliente'] . "</th>";
			echo "	<th><a href='#' class='btn btn-danger' onclick='elimina(\"" . $row['id_taquillero'] . "\")'>X<i class='icon-white icon-trash'></i></a>.<a href='#' class='btn btn-primary' onclick='edit(\"" . $row['id_taquillero'] . "\", \"" . $row['taquillero'] . "\", \"" . $row['descripcion'] . "\", \"" . $row['id_cliente'] . "\")'>E<i class='icon-white icon-refresh'></i></a></th>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
}

function getTablaInicianPorA(){
	
	$sql="select * from administrador.tbl_taquilla where descripcion like 'A%'";
	try {
		echo "<div class='container' style='margin-top: 10px'>";
		echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
		echo "<thead>";
		echo "<tr>";
		echo "	<th>Codigo</th>";
		echo "	<th>Nombre</th>";
		echo "	<th>Descripcion</th>";
		echo "	<th>Cliente</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<tr class='gradeA'>";
			echo "	<th>" . $row['id_taquillero'] . "</th>";
			echo "	<th>" . $row['taquillero'] . "</th>";
			echo "	<th>" . $row['descripcion'] . "</th>";
			echo "	<th>" . $row['id_cliente'] . "</th>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
}

function getTablaPDF(){
	
	$sql="select * from administrador.tbl_taquilla";	
	$tabla="";
	try {
		$tabla="<table>";
		$tabla=$tabla . "<tr>";
		$tabla=$tabla . "	<td>Codigo</td>";
		$tabla=$tabla . "	<td>Nombre</td>";
		$tabla=$tabla . "	<td>Descripcion</td>";
		$tabla=$tabla . "	<td>Cliente</td>";

		$tabla=$tabla . "</tr>";

		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			$tabla=$tabla . "<tr>";
			$tabla=$tabla . "	<td>" . $row['id_taquillero'] . "</td>";
			$tabla=$tabla . "	<td>" . $row['taquillero'] . "</td>";
			$tabla=$tabla . "	<td>" . $row['descripcion'] . "</td>";
			$tabla=$tabla . "	<td>" . $row['id_cliente'] . "</td>";
			$tabla=$tabla . "</tr>";
		}
		$tabla=$tabla . "</table>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
	return $tabla;
}

function getLista(){
	
	$sql="SELECT * FROM administrador.tbl_taquilla";
	try {
		echo "<SELECT id_taquillero='id_taquillero'>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<OPTION value='".$row['id_taquillero']."'> ".$row['taquillero']." ".$row['descripcion']." ".$row['id_cliente']."</OPTION>";
		}
		echo "</SELECT>";
	}
	catch (DependencyException $e) {
		pg::query("rollback");
	}
}

function getAutocomplete(){
	$res="";
	$sql="SELECT * FROM administrador.tbl_taquilla";
	try {
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			$res .= '"' . $row['id_taquillero'] . ', ' . $row['taquillero'] . ', ' . $row['descripcion'] . ', ' . $row['id_cliente'] . '"';
			$res .= ',';
		}
		$res = substr ($res, 0, -2);
		$res = substr ($res, 1);
	}
	catch (DependencyException $e) {
	}
	return $res;
}

function lista_cliente(){
	$sql="SELECT * FROM administrador.tbl_cliente";
	
	$result = pg::query($sql); 
            if (!$result) { 
                echo "Problema con la consulta " . $query . "<br/>"; 
                echo pg_last_error(); 
                exit(); 
            } 
           $lista_cliente = null;

            while($myrow = pg_fetch_assoc($result)) { 
                $lista_cliente .= "<option value=\"".$myrow['id_cliente']."\">".$myrow['nombre']."</option>"; 
            }	
            echo $lista_cliente;			
}
}
?>
