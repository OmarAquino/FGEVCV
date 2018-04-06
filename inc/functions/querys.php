<?php
// Consultar usuarios
function consultarUsuarios() {
	include('db.php');
	$query  = "SELECT * FROM usuarios";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	     $array[] = $row;
	}
	return($array);
	mysqli_close($con);
}
?>