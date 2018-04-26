<?php
$idCI 	  = $_POST['idCI'];
$statusCI = $_POST['statusCI'];
include('db.php');
// foreach($arrayCI as $personaCI => $statusCI) {
$query = "UPDATE [SistBusquedas].[dbo].[vehiculos_carpetas] SET borrado = $statusCI WHERE vehiculos_carpetas.id = $idCI";
sqlsrv_query($con, $query);
// }
sqlsrv_close($con);
?>