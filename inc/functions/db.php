<?php
// Conexión con MS SQL Server
$serverName = "192.108.24.157\SQLEXPRESS";
$connectionInfo = array( "Database"=>"SistBusquedas", "UID"=>"sa", "PWD"=>"Sa123456", "CharacterSet" => "UTF-8");
$con = sqlsrv_connect( $serverName, $connectionInfo);
if( $con ) {
     // echo "Conexión establecida.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}
// Fin conexión con MS SQL Server

// $hostname 		= 'localhost';
// $db_username 	= 'root';
// $db_password 	= '';
// $db_name 		= 'vcv';
// $con = mysqli_connect($hostname, $db_username, $db_password, $db_name);
// mysqli_set_charset($con, "utf8");
// if(mysqli_connect_errno($con))	echo "Failed to connect MySQL: " .mysqli_connect_error();
	
?>
