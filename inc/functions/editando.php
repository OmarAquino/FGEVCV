<?php
// if (isset($_POST['state'])) {
// 	$idconcesion = $_POST['idconcesion'];
// 	include('db.php');
// 	$query = "SELECT bandera FROM [Sistbusquedas].[dbo].[concesiones] WHERE concesiones.id_conc = $idconcesion";
// 	$result = sqlsrv_query($con, $query);
// 	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
// 		$array[] = $row;
// 	}
// 	if ($array[0]['bandera']==0) {
// 		$query = "UPDATE [Sistbusquedas].[dbo].[concesiones] SET bandera = 1 WHERE concesiones.id_conc = $idconcesion";
// 		$result = sqlsrv_query($con, $query);
// 		while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
// 			$array[] = $row;
// 		}
// 		echo json_encode($array);
// 	}
// 	sqlsrv_close($con);
// }
// if (isset($_POST['state_release'])) {
	$idconcesion = $_POST['idconcesion'];
	include('db.php');
	$query = "UPDATE [Sistbusquedas].[dbo].[concesiones] SET bandera = 0 WHERE concesiones.id_conc = $idconcesion";
	$result = sqlsrv_query($con, $query);
	sqlsrv_close($con);
// }
?>

