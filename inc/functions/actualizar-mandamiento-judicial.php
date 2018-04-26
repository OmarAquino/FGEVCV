<?php
$idCI = $_POST['idCI'];
$statusCI 	 = $_POST['statusCI'];
include('db.php');
// foreach($arrayCI as $personaCI => $statusCI) {
$query = "update [SistBusquedas].[dbo].[per_mand] set borrado = '$statusCI' where per_mand.id= '$idCI'";
sqlsrv_query($con, $query);
// }
sqlsrv_close($con);
?>