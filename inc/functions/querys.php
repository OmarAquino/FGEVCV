<?php
function consultarConcesionariosPrevalidador() {
	include('db.php');
	// $query = "SELECT [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [per_conc].[rol], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P'";
	// $query = "SELECT distinct [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join SistBusquedas.dbo.per_carp on personas.id_per = per_carp.id_per inner join [SistBusquedas].[dbo].[per_conc] on [per_carp].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 0 ORDER BY [personas].[id_per]";
	$query = "SELECT distinct [concesiones].[folio],[concesiones].[etapa],[personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join SistBusquedas.dbo.per_carp on personas.id_per = per_carp.id_per inner join [SistBusquedas].[dbo].[per_conc] on [per_carp].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 0 where personas.limpio =0 order by id_conc";
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	sqlsrv_close($con);
}
function consultarConcesionariosJuridico() {
	include('db.php');
	// $query = "SELECT [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [per_conc].[rol], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P'";
	// $query = "SELECT distinct [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join SistBusquedas.dbo.per_carp on personas.id_per = per_carp.id_per inner join [SistBusquedas].[dbo].[per_conc] on [per_carp].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 1 ORDER BY [personas].[id_per]";
	$query = "SELECT distinct [concesiones].[folio],[concesiones].[etapa],[personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join SistBusquedas.dbo.per_carp on personas.id_per = per_carp.id_per inner join [SistBusquedas].[dbo].[per_conc] on [per_carp].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 1 where personas.limpio =0 order by id_conc";
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
	// $query = "SELECT [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [per_conc].[rol], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 0 and [per_conc].[rol] = 'P' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
	// $query = "SELECT distinct [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join SistBusquedas.dbo.per_carp on personas.id_per = per_carp.id_per inner join [SistBusquedas].[dbo].[per_conc] on [per_carp].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 0 ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
	$query = "SELECT distinct [concesiones].[folio],[concesiones].[etapa],[personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join SistBusquedas.dbo.per_carp on personas.id_per = per_carp.id_per inner join [SistBusquedas].[dbo].[per_conc] on [per_carp].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 0 where personas.limpio =0 order by nombre OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	sqlsrv_close($con);
}
function consultarConcesionariosJuridicoPaginacion($offset, $limit) {
	$array=[];
	include('db.php');
	// $query = "SELECT [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [per_conc].[rol], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 1 and [per_conc].[rol] = 'P' ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
	// $query = "SELECT distinct [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join SistBusquedas.dbo.per_carp on personas.id_per = per_carp.id_per inner join [SistBusquedas].[dbo].[per_conc] on [per_carp].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 1 ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
	//$query = "SELECT distinct [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join SistBusquedas.dbo.per_carp on personas.id_per = per_carp.id_per inner join [SistBusquedas].[dbo].[per_conc] on [per_carp].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 1 where personas.limpio =0 order by nombre OFFSET $offset ROWS FETCH NEXT 1 ROWS ONLY;";
	$query = "SELECT distinct [concesiones].[folio],[concesiones].[etapa],[personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico] from [SistBusquedas].[dbo].[personas] inner join SistBusquedas.dbo.per_carp on personas.id_per = per_carp.id_per inner join [SistBusquedas].[dbo].[per_conc] on [per_carp].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[ind_pre] = 1 where personas.limpio =0 order by nombre OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
	$result = sqlsrv_query($con, $query,null,array("QueryTimeout"=>60));
	if (sqlsrv_has_rows($result)!=0) {
		while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			$array[] = $row;
		}
		return($array);
	}
	sqlsrv_close($con);
}
function consultarConcesion($idconcesion) {
		include('db.php');
		$query = "SELECT [concesiones].[folio],[concesiones].[etapa],[personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [per_conc].[rol], [concesiones].[placa], [concesiones].[vin], [concesiones].[motor], [concesiones].[num_economico],[concesiones].[marca], [concesiones].[submarca], [concesiones].[nota] from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] and [concesiones].[id_conc] = $idconcesion";
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
		$query = "SELECT [concesiones].[folio],[concesiones].[etapa],[personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], [per_conc].[rol], [concesiones].[id_conc], [per_carp].[id], [per_carp].[carpeta], [per_carp].[borrado], [per_carp].[origen] from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] inner join [SistBusquedas].[dbo].[per_carp] on [per_carp].[id_per] = [personas].[id_per] and [concesiones].[id_conc] = $idconcesion order by rol desc, carpeta asc";
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
	// $query = "select per_mand.mand_jud, personas.id_per FROM [SistBusquedas].[dbo].[per_mand] inner join SistBusquedas.dbo.personas on per_mand.id_per = personas.id_per inner join SistBusquedas.dbo.per_conc on personas.id_per= per_conc.id_per inner join SistBusquedas.dbo.concesiones on per_conc.id_conc = concesiones.id_conc and concesiones.id_conc = $idconcesion";
	$query = "select per_mand.id, per_mand.mand_jud, per_mand.borrado, personas.id_per FROM [SistBusquedas].[dbo].[per_mand] inner join SistBusquedas.dbo.personas on per_mand.id_per = personas.id_per inner join SistBusquedas.dbo.per_conc on personas.id_per= per_conc.id_per inner join SistBusquedas.dbo.concesiones on per_conc.id_conc = concesiones.id_conc and concesiones.id_conc = $idconcesion";
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
		$query = "SELECT vehiculos_carpetas.id, vehiculos_carpetas.idVehiculo, vehiculos_carpetas.region, vehiculos_carpetas.carpeta, vehiculos_carpetas.status, vehiculos_carpetas.id_conc,vehiculos_carpetas.borrado, concesiones.id_conc, concesiones.vin, concesiones.placa from [SistBusquedas].[dbo].[vehiculos_carpetas] inner join [SistBusquedas].[dbo].[concesiones] on [vehiculos_carpetas].[id_conc] = [concesiones].[id_conc] and [concesiones].[id_conc] = $idconcesion";
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
function actualizarMandamientos($arrayCI) {
	include('db.php');
	foreach($arrayCI as $personaCI => $statusCI) {
		// $query = "UPDATE [SistBusquedas].[dbo].[per_carp] SET borrado = '$statusCI' WHERE per_carp.id = '$personaCI'";
		$query = "update [SistBusquedas].[dbo].[per_mand] set borrado = '$statusCI' where per_mand.id= '$personaCI'";
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
function actualizarHistorial($usuario, $idconcesion, $actualizarIdConcesion) {
	include('db.php');
	$query = "INSERT INTO [SistBusquedas].[dbo].[hist] (usuario, id_conc, ind_pre) VALUES ('$usuario', '$idconcesion', '$actualizarIdConcesion')";
	// $query = "update SistBusquedas.dbo.concesiones set bandera = 0, ind_pre = $actualizarIdConcesion where id_conc = $idconcesion";
	sqlsrv_query($con, $query);
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
function buscarNombreJur($nombre,$apat,$amat,$placa,$serie,$eco){
	include('db.php');//nombre y apellido pat
	$query="SELECT distinct [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], ".
		"[concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico], [concesiones].[vin] ".
		 "from [SistBusquedas].[dbo].[personas] ".
		 "inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] ".
		 "inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] ".
		 "where personas.limpio = 0 and [concesiones].[ind_pre] = 1 ";

		if($nombre !="")
			$query=$query." AND [personas].[nombre] LIKE '%$nombre%' ";
		if($apat !="")
			$query=$query." AND [personas].[a_paterno] LIKE '%$apat%' ";
		if($amat !="")
			$query=$query." AND [personas].[a_materno] LIKE '%$amat%' ";
		if($placa !="")
			$query=$query." AND [concesiones].[placa] LIKE '%$placa%' ";
		if($serie !="")
			$query=$query." AND [concesiones].[vin] LIKE '%$serie%' ";			
		if($eco !="")
			$query=$query." AND [concesiones].[num_economico] LIKE '%$eco%' ";

	$query=$query." ORDER BY [personas].[id_per]";

	$result = sqlsrv_query($con, $query);
	if (sqlsrv_has_rows($result)!=0) {
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
				$array[] = $row;
			}
			return($array);
			sqlsrv_close($con);
		}
	}
function buscarPaginacionJur($nombre,$apat,$amat,$placa,$serie,$eco,$offset,$limit){
	include('db.php');//nombre y apellido pat
	$query="SELECT distinct [concesiones].[folio],[concesiones].[etapa],[personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], ".
		"[concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico], [concesiones].[vin] ".
		 "from [SistBusquedas].[dbo].[personas] ".
		 "inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] ".
		 "inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] ".
		 "where personas.limpio = 0 and [concesiones].[ind_pre] = 1 ";

		if($nombre !="")
			$query=$query." AND [personas].[nombre] LIKE '%$nombre%' ";
		if($apat !="")
			$query=$query." AND [personas].[a_paterno] LIKE '%$apat%' ";
		if($amat !="")
			$query=$query." AND [personas].[a_materno] LIKE '%$amat%' ";
		if($placa !="")
			$query=$query." AND [concesiones].[placa] LIKE '%$placa%' ";
		if($serie !="")
			$query=$query." AND [concesiones].[vin] LIKE '%$serie%' ";			
		if($eco !="")
			$query=$query." AND [concesiones].[num_economico] LIKE '%$eco%' ";

	$query=$query." ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";

	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	sqlsrv_close($con);
}
function buscarNombre($nombre,$apat,$amat,$placa,$serie,$eco){
	include('db.php');//nombre y apellido pat

	$query="SELECT distinct [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], ".
		"[concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico], [concesiones].[vin] ".
		 "from [SistBusquedas].[dbo].[personas] ".
		 "inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] ".
		 "inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] ".
		 "where personas.limpio = 0 and [concesiones].[ind_pre] = 0 ";

		if($nombre !="")
			$query=$query." AND [personas].[nombre] LIKE '%$nombre%' ";
		if($apat !="")
			$query=$query." AND [personas].[a_paterno] LIKE '%$apat%' ";
		if($amat !="")
			$query=$query." AND [personas].[a_materno] LIKE '%$amat%' ";
		if($placa !="")
			$query=$query." AND [concesiones].[placa] LIKE '%$placa%' ";
		if($serie !="")
			$query=$query." AND [concesiones].[vin] LIKE '%$serie%' ";			
		if($eco !="")
			$query=$query." AND [concesiones].[num_economico] LIKE '%$eco%' ";

	$query=$query." ORDER BY [personas].[id_per]";

	$result = sqlsrv_query($con, $query);
	if (sqlsrv_has_rows($result)!=0) {
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
				$array[] = $row;
			}
			return($array);
			sqlsrv_close($con);
		}
	}
function buscarPaginacion($nombre,$apat,$amat,$placa,$serie,$eco,$offset,$limit){
	include('db.php');//nombre y apellido pat

	$query="SELECT distinct [concesiones].[folio],[concesiones].[etapa],[personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], ".
		"[concesiones].[id_conc], [concesiones].[placa], [concesiones].[num_economico], [concesiones].[vin] ".
		 "from [SistBusquedas].[dbo].[personas] ".
		 "inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] = [per_conc].[id_per] ".
		 "inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] = [per_conc].[id_conc] ".
		 "where personas.limpio = 0 and [concesiones].[ind_pre] = 0 ";

		if($nombre !="")
			$query=$query." AND [personas].[nombre] LIKE '%$nombre%' ";
		if($apat !="")
			$query=$query." AND [personas].[a_paterno] LIKE '%$apat%' ";
		if($amat !="")
			$query=$query." AND [personas].[a_materno] LIKE '%$amat%' ";
		if($placa !="")
			$query=$query." AND [concesiones].[placa] LIKE '%$placa%' ";
		if($serie !="")
			$query=$query." AND [concesiones].[vin] LIKE '%$serie%' ";			
		if($eco !="")
			$query=$query." AND [concesiones].[num_economico] LIKE '%$eco%' ";

	$query=$query." ORDER BY [personas].[id_per] OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";

	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	sqlsrv_close($con);
}
?>