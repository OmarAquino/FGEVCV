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
	if (sqlsrv_has_rows($result)!=0) {
		while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			$array[] = $row;
		}
		return($array);
	}
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
function consultarMandamientos($idconcesion) {
	include('db.php');
	$query = "select per_mand.mand_jud, personas.id_per FROM [SistBusquedas].[dbo].[per_mand] inner join SistBusquedas.dbo.personas on per_mand.id_per = personas.id_per inner join SistBusquedas.dbo.per_conc on personas.id_per= per_conc.id_per inner join SistBusquedas.dbo.concesiones on per_conc.id_conc = concesiones.id_conc and concesiones.id_conc = $idconcesion";
	$result = sqlsrv_query($con, $query);
	if (sqlsrv_has_rows($result)!=0) {
		while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			$array[] = $row;
		}
		return($array);
	}
	sqlsrv_close($con);
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
	$query = "UPDATE [SistBusquedas].[dbo].[concesiones] SET ind_pre = $actualizarIdConcesion WHERE concesiones.id_conc = $idconcesion";
	// $query = "update SistBusquedas.dbo.concesiones set bandera = 0, ind_pre = $actualizarIdConcesion where id_conc = $idconcesion";
	sqlsrv_query($con, $query);
	sqlsrv_close($con);
	// header('Location: lista-concesionarios.php');
	echo '<script>window.close()</script>';
}
function guardarNota($idconcesion,$nota) {
    include('db.php');
	$query = "UPDATE [SistBusquedas].[dbo].[concesiones] SET nota = '$nota' WHERE concesiones.id_conc = '$idconcesion'";
    sqlsrv_query($con,$query);
    sqlsrv_close($con);
}

function activarEditandoConcesion($idconcesion) {
	include('db.php');
	$query = "SELECT bandera FROM [SistBusquedas].[dbo].[concesiones] WHERE concesiones.id_conc = $idconcesion";
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	if ($array[0]['bandera']==0) {
		$query = "UPDATE [SistBusquedas].[dbo].[concesiones] SET bandera = 1 WHERE concesiones.id_conc = $idconcesion";
		$result = sqlsrv_query($con, $query);
		while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			$array[] = $row;
		}
		$editando = 'inactivo';
		return($editando);
	} else {
		$editando = 'activo';
		return($editando);
	}
	sqlsrv_close($con);
}
function apagarEditandoConcesion($idconcesion) {
	include('db.php');
	$query = "UPDATE [Sistbusquedas].[dbo].[concesiones] SET bandera = 0 WHERE concesiones.id_conc = 33";
	$result = sqlsrv_query($con, $query);
	sqlsrv_close($con);
	header('Location: lista-concesionarios.php');
}
function buscarNombreJur($nombre,$apat,$amat){
	include('db.php');//nombre y apellido pat
	if ($nombre !="" and $apat!="" and $amat=="") :
		$query="SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' AND [personas].[a_paterno] LIKE '%$apat%'";
		//nombre y apellidos
	elseif ($nombre!="" and $apat!="" and $amat!="") :
	$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' AND [personas].[a_paterno] LIKE '%$apat%' AND [personas].[a_materno] LIKE '%$amat%'";
	//Apellidos
	elseif ($nombre=="" and $apat!="" and $amat!="") :
		$query="SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[a_paterno] LIKE '%$apat%' AND [personas].[a_materno] LIKE '%$amat%'";
		//Nombre
	elseif ($nombre!="" and $apat=="" and $amat=="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%'";
		//Paterno
	elseif ($nombre=="" and $apat!="" and $amat=="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[a_paterno] LIKE '%$apat%'";
		//Materno
	elseif ($nombre=="" and $apat=="" and $amat!="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[a_materno] LIKE '%$amat%'";
		//Nombre y Materno
	elseif ($nombre !="" and $apat=="" and $amat!="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' AND [personas].[a_materno] LIKE '%$amat%'";
	endif;
	$result = sqlsrv_query($con, $query);
	if (sqlsrv_has_rows($result)!=0) {
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
				$array[] = $row;
			}
			return($array);
			sqlsrv_close($con);
		}
	}
function buscarPaginacionJur($nombre,$apat,$amat,$offset,$limit){
	include('db.php');//nombre y apellido pat
	if ($nombre !="" and $apat!="" and $amat=="") :
		$query="SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' AND [personas].[a_paterno] LIKE '%$apat%'ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
		//nombre y apellidos
	elseif ($nombre!="" and $apat!="" and $amat!="") :
	$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' AND [personas].[a_paterno] LIKE '%$apat%' AND [personas].[a_materno] LIKE '%$amat%' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
	//Apellidos
	elseif ($nombre=="" and $apat!="" and $amat!="") :
		$query="SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[a_paterno] LIKE '%$apat%' AND [personas].[a_materno] LIKE '%$amat%' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
		//Nombre
	elseif ($nombre!="" and $apat=="" and $amat=="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
		//Paterno
	elseif ($nombre=="" and $apat!="" and $amat=="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[a_paterno] LIKE '%$apat%' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
		//Materno
	elseif ($nombre=="" and $apat=="" and $amat!="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[a_materno] LIKE '%$amat%' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
		//Nombre y Materno
	elseif ($nombre !="" and $apat=="" and $amat!="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' AND [personas].[a_materno] LIKE '%$amat%' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
	endif;
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	sqlsrv_close($con);
}
function buscarNombre($nombre,$apat,$amat){
	include('db.php');//nombre y apellido pat
	if ($nombre !="" and $apat!="" and $amat=="") :
		$query="SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' AND [personas].[a_paterno] LIKE '%$apat%'";
		//nombre y apellidos
	elseif ($nombre!="" and $apat!="" and $amat!="") :
	$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' AND [personas].[a_paterno] LIKE '%$apat%' AND [personas].[a_materno] LIKE '%$amat%'";
	//Apellidos
	elseif ($nombre=="" and $apat!="" and $amat!="") :
		$query="SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[a_paterno] LIKE '%$apat%' AND [personas].[a_materno] LIKE '%$amat%'";
		//Nombre
	elseif ($nombre!="" and $apat=="" and $amat=="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%'";
		//Paterno
	elseif ($nombre=="" and $apat!="" and $amat=="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[a_paterno] LIKE '%$apat%'";
		//Materno
	elseif ($nombre=="" and $apat=="" and $amat!="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[a_materno] LIKE '%$amat%'";
		//Nombre y Materno
	elseif ($nombre !="" and $apat=="" and $amat!="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' AND [personas].[a_materno] LIKE '%$amat%'";
	endif;
	$result = sqlsrv_query($con, $query);
	if (sqlsrv_has_rows($result)!=0) {
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
				$array[] = $row;
			}
			return($array);
			sqlsrv_close($con);
		}
	}
function buscarPaginacion($nombre,$apat,$amat,$offset,$limit){
	include('db.php');//nombre y apellido pat
	if ($nombre !="" and $apat!="" and $amat=="") :
		$query="SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' AND [personas].[a_paterno] LIKE '%$apat%' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
		//nombre y apellidos
	elseif ($nombre!="" and $apat!="" and $amat!="") :
	$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' AND [personas].[a_paterno] LIKE '%$apat%' AND [personas].[a_materno] LIKE '%$amat%' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
	//Apellidos
	elseif ($nombre=="" and $apat!="" and $amat!="") :
		$query="SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[a_paterno] LIKE '%$apat%' AND [personas].[a_materno] LIKE '%$amat%' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
		//Nombre
	elseif ($nombre!="" and $apat=="" and $amat=="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
		//Paterno
	elseif ($nombre=="" and $apat!="" and $amat=="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[a_paterno] LIKE '%$apat%' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
		//Materno
	elseif ($nombre=="" and $apat=="" and $amat!="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[a_materno] LIKE '%$amat%' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
		//Nombre y Materno
	elseif ($nombre !="" and $apat=="" and $amat!="") :
		$query = "SELECT * FROM [SistBusquedas].[dbo].[personas] INNER JOIN [SistBusquedas].[dbo].[per_conc] ON [personas].[id_per] = [per_conc].[id_per] INNER JOIN [SistBusquedas].[dbo].[concesiones] ON [concesiones].[id_conc] = [per_conc].[id_conc] AND [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' AND [personas].[nombre] LIKE '%$nombre%' AND [personas].[a_materno] LIKE '%$amat%' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
	endif;
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	sqlsrv_close($con);
}
?>