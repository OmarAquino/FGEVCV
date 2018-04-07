<?php
// define('HOSTNAME','localhost');
// define('DB_USERNAME','root');
// define('DB_PASSWORD','');
// define('DB_NAME', 'vcv');
$hostname 		= 'localhost';
$db_username 	= 'root';
$db_password 	= '';
$db_name 		= 'vcv';
//global $con;
// $con = mysqli_connect(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME) or die ("error");
$con = mysqli_connect($hostname, $db_username, $db_password, $db_name) or die ("error");

// Check connection
if(mysqli_connect_errno($con))	echo "Failed to connect MySQL: " .mysqli_connect_error();
?>
