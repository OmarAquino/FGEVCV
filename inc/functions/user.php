<?php
include('utilities.php');
$homeUrl = homeUrl();
if (isset($_POST['fgevcv-login'])) {
	$user = $_POST['fgevcv-user'];
	$pass = $_POST['fgevcv-password'];
	include('db.php');
	$query  = "SELECT FROM usuarios WHERE usuario = $user AND pass = $pass";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0){
	    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	        echo $row;
	    }
	    // header("Location : $homeUrl");
	    // exit;
	}else{
	    // header("Location : $homeUrl".'?err=1');
	}
	mysqli_close($con);
}

?>