<?php

function consultarConcesionariosPrevalidador() {
	include('db.php');
	$query = "SELECT [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [per_conc].[rol], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P'";
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	sqlsrv_close($con);
}
function consultarConcesionariosJuridico() {
	include('db.php');
	$query = "SELECT [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [per_conc].[rol], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P'";
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	sqlsrv_close($con);
}
function consultarConcesionariosPrevalidadorPaginacion($offset, $limit) {
	include('db.php');
	$query = "SELECT [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [per_conc].[rol], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	sqlsrv_close($con);
}
function consultarConcesionariosJuridicoPaginacion($offset, $limit) {
	include('db.php');
	$query = "SELECT [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [per_conc].[rol], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	sqlsrv_close($con);
}
function consultarConcesion($idconcesion) {
		include('db.php');
		$query = "SELECT [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [per_conc].[rol], [concesiones].[placa], [concesiones].[vin], [concesiones].[motor], [concesiones].[num_economico],[concesiones].[marca], [concesiones].[submarca], [concesiones].[nota] from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[id_conc] = $idconcesion";
		$result = sqlsrv_query($con, $query);
		if (sqlsrv_has_rows($result)!=0) {
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
				$array[] = $row;
			}
			return($array);
		}
		sqlsrv_close($con);
}
function consultarCarpetas($idconcesion) {
	if (is_numeric($idconcesion)) {
		include('db.php');
		// $query = "select persona.id_persona, persona.nombre, persona.ap_pat, persona.ap_mat, concesion.idconcesion, inv_persona.idinv_persona, inv_persona.ci, inv_persona.borrado, inv_persona.origen from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on conc_persona.concesion_idconcesion = concesion.idconcesion inner join inv_persona on inv_persona.persona_idpersona = persona.id_persona and concesion.idconcesion = $idconcesion";
		$query = "SELECT [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [per_conc].[rol], [concesiones].[id_conc], [per_carp].[id], [per_carp].[carpeta], [per_carp].[borrado], [per_carp].[origen] from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] inner join [SistBusquedas].[dbo].[per_carp] on [per_carp].[id_per] = [personas].[id_per] and [concesiones].[id_conc] = $idconcesion";
		$result = sqlsrv_query($con, $query);
		if (sqlsrv_has_rows($result)!=0) {
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
				$array[] = $row;
			}
			return($array);
		}
		sqlsrv_close($con);
	}
}
function consultarCarpetasAuto($idconcesion) {
	if (is_numeric($idconcesion)) {
		include('db.php');
		// $query = "SELECT [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [per_conc].[rol], [concesiones].[id_conc], [per_carp].[id], [per_carp].[carpeta], [per_carp].[borrado], [per_carp].[origen] from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] inner join [SistBusquedas].[dbo].[per_carp] on [per_carp].[id_per] = [personas].[id_per] and [concesiones].[id_conc] = $idconcesion";
		$query = "SELECT [conc_carpeta].[id], [conc_carpeta].[carpeta], [conc_carpeta].[robado], [conc_carpeta].[id_conc],[conc_carpeta].[borrado], [concesiones].[id_conc], [concesiones].[vin], [concesiones].[placa] from [SistBusquedas].[dbo].[conc_carpeta] inner join [SistBusquedas].[dbo].[concesiones] on [conc_carpeta].[id_conc] = [concesiones].[id_conc] and [concesiones].[id_conc] = $idconcesion";
		$result = sqlsrv_query($con, $query);
		if (sqlsrv_has_rows($result)!=0) {
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
				$array[] = $row;
			}
			return($array);
		}
		sqlsrv_close($con);
	}
}
function actualizarCarpetasPropietario($arrayCI) {
	include('db.php');
	foreach($arrayCI as $personaCI => $statusCI) {
		$query = "UPDATE [SistBusquedas].[dbo].[per_carp] SET borrado = '$statusCI' WHERE per_carp.id = '$personaCI'";
		sqlsrv_query($con, $query);
	}
	sqlsrv_close($con);
}
function actualizarCarpetasAuto($arrayCIA) {
	include('db.php');
	foreach($arrayCIA as $autoCI => $statusCI) {
		$query = "UPDATE [SistBusquedas].[dbo].[conc_carpeta] SET borrado = $statusCI WHERE conc_carpeta.id = $autoCI";
		sqlsrv_query($con, $query);
	}
	sqlsrv_close($con);
}
function actualizarIndicadorConcesion($actualizarIdConcesion,$idconcesion) {
	include('db.php');
	$query = "UPDATE [Sistbusquedas].[dbo].[concesiones] SET ind_pre = $actualizarIdConcesion WHERE concesiones.id_conc = $idconcesion";
	sqlsrv_query($con, $query);
	sqlsrv_close($con);
	header('Location: lista-concesionarios.php');
}
function guardarNota($idconcesion,$nota) {
    include('db.php');
	$query = "UPDATE [Sistbusquedas].[dbo].[concesiones] SET nota = '$nota' WHERE concesiones.id_conc = '$idconcesion'";
    sqlsrv_query($con,$query);
    sqlsrv_close($con);
}

function activarEditandoConcesion($idconcesion) {
	include('db.php');
	$query = "SELECT bandera FROM [Sistbusquedas].[dbo].[concesiones] WHERE concesiones.id_conc = $idconcesion";
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	if ($array[0]['bandera']==0) {
		$query = "UPDATE [Sistbusquedas].[dbo].[concesiones] SET bandera = 1 WHERE concesiones.id_conc = $idconcesion";
		$result = sqlsrv_query($con, $query);
		while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			$array[] = $row;
		}
		$_SESSION['editing']= 1;
		$editando = 'libre';
		return($editando);
	} else {
		$editando = 'editando';
		return($editando);
	}
	sqlsrv_close($con);
}
function apagarEditandoConcesion($idconcesion) {
	include('db.php');
	$query = "UPDATE [Sistbusquedas].[dbo].[concesiones] SET bandera = 0 WHERE concesiones.id_conc = $idconcesion";
	sqlsrv_query($con, $query);
	sqlsrv_close($con);
}

?>