<?php
// Conexión con MS SQL Server
// $serverName = "192.108.24.155\SQLEXPRESS,1433";
// $connectionInfo = array( "Database"=>"SistBusquedas", "UID"=>"sa", "PWD"=>"123456");
// $conn = sqlsrv_connect( $serverName, $connectionInfo);
// if( $conn ) {
//      echo "Conexión establecida.<br />";
// }else{
//      echo "Conexión no se pudo establecer.<br />";
//      die( print_r( sqlsrv_errors(), true));
// }
// Fin conexión con MS SQL Server

$hostname 		= 'localhost';
$db_username 	= 'root';
$db_password 	= '';
$db_name 		= 'vcv';
$con = mysqli_connect($hostname, $db_username, $db_password, $db_name);
mysqli_set_charset($con, "utf8");
if(mysqli_connect_errno($con))	echo "Failed to connect MySQL: " .mysqli_connect_error();
	
?>
