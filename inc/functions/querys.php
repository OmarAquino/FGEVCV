<?php

function consultarUsuarios() {
	include('db.php');
	$query  = "SELECT * FROM usuarios";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_object($result);
	}
	return($row);
}
?>