<?php
	$ajaxData = $_POST['idConcesion'];
	include('db.php');
	$query = "UPDATE concesion SET tmpf = 1 WHERE idconcesion = 1";
	mysqli_query($con,$query);
	mysqli_close($con);
?>

