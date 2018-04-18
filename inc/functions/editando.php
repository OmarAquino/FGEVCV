<?php
// if (isset($_POST['state'])) {
	$idconcesion = $_POST['idconcesion'];
	// function consultarEditandoConcesion($idconcesion) {
	include('db.php');
	$query = "SELECT bandera FROM [Sistbusquedas].[dbo].[concesiones] WHERE concesiones.id_conc = $idconcesion";
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	echo json_encode($array);
	if ($array[0]['bandera']==0) {
		$query = "UPDATE [Sistbusquedas].[dbo].[concesiones] SET bandera = 1 WHERE concesiones.id_conc = $idconcesion";
		$result = sqlsrv_query($con, $query);
		while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			$array[] = $row;
		}
		session_start();
		$_SESSION['editing']= 1;
		$editando = 'libre';
		echo json_encode($editando);
	} else {
		session_start();
		$_SESSION['editing']= 0;
		$editando = 'editando';
		echo json_encode($editando);
	}
	sqlsrv_close($con);
	// }
// }

?>

