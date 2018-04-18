<?php
if (isset($_POST['fgevcv-login'])) {
	$user = $_POST['fgevcv-user'];
	$pass = $_POST['fgevcv-password'];
	$home = $_POST['home-url'];
	include('db.php');
	$query  = "SELECT [usuarios].[id], [usuarios].[perfil] FROM usuarios WHERE usuario = '$user' AND password = '$pass'";
	$result = sqlsrv_query($con, $query);
	$count = sqlsrv_has_rows($result);
	if($count == 1) {
		session_start();
		// Store Session Data
		$_SESSION['user']= $user;
		while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
		    $_SESSION['user-type']= $row['perfil'];
		}
	   	header("location: http://localhost/fgevcv/lista-concesionarios.php");
	}else {
	   	header("location: http://localhost/fgevcv?err=1");
	}
	sqlsrv_close($con);
}
?>