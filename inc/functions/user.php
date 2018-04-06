<?php
if (isset($_POST['fgevcv-login'])) {
	$user = $_POST['fgevcv-user'];
	$pass = $_POST['fgevcv-password'];
	$home = $_POST['home-url'];
	include('db.php');
	$query  = "SELECT id, indicador FROM usuarios WHERE usuario = '$user' AND pass = '$pass'";
	$result = mysqli_query($con, $query);
	$count = mysqli_num_rows($result);
	if($count == 1) {
		session_start();
		// Store Session Data
		$_SESSION['user']= $user;
		// echo $_SESSION['user'];
	   	header("location: http://localhost/fgevcv/lista-concesionarios.php");
	}else {
	   	header("location: http://localhost/fgevcv?err=1");
	}
	mysqli_close($con);
	// echo $result;
}

?>