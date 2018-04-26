<?php
$idCI = $_POST['idCI'];
$statusCI 	 = $_POST['statusCI'];
include('db.php');
// foreach($arrayCI as $personaCI => $statusCI) {
$query = "UPDATE [SistBusquedas].[dbo].[per_carp] SET borrado = '$statusCI' WHERE per_carp.id = '$idCI'";
sqlsrv_query($con, $query);
// }
sqlsrv_close($con);
?>