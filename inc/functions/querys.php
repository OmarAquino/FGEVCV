<?php
// Consultar usuarios
function consultarUsuarios() {
	include('db.php');
	$query  = "SELECT * FROM usuarios";
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
	     $array[] = $row;
	}
	return($array);
	sqlsrv_close($con);
}
function consultarConcesionariosPrevalidador() {
	include('db.php');
	// $query = "select persona.id_persona, persona.nombre,persona.ap_pat, persona.ap_mat, concesion.idconcesion, concesion.placa, concesion.folio, conc_persona.tipo from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and concesion.indicador = 0 and conc_persona.tipo ='P'";
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
	// $query = "select persona.id_persona, persona.nombre,persona.ap_pat, persona.ap_mat, concesion.idconcesion, concesion.placa, concesion.folio from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and conc_persona.tipo='P' and concesion.indicador='1'";
	$query = "select persona.id_persona, persona.nombre,persona.ap_pat, persona.ap_mat, concesion.idconcesion, concesion.placa, concesion.folio, conc_persona.tipo from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and concesion.indicador = 1 and conc_persona.tipo ='P'";
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	sqlsrv_close($con);
}
function consultarConcesionariosPrevalidadorPaginacion($offset, $limit) {
	include('db.php');
	// $query = "select persona.id_persona, persona.nombre,persona.ap_pat, persona.ap_mat, concesion.idconcesion, concesion.placa, concesion.folio, conc_persona.tipo from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and concesion.indicador = 0 and conc_persona.tipo ='P' limit $offset, $limit";
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
	// $query = "select persona.id_persona, persona.nombre,persona.ap_pat, persona.ap_mat, concesion.idconcesion, concesion.placa, concesion.folio from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and conc_persona.tipo='P' and concesion.indicador='1'";
	$query = "select persona.id_persona, persona.nombre,persona.ap_pat, persona.ap_mat, concesion.idconcesion, concesion.placa, concesion.folio, conc_persona.tipo from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and concesion.indicador = 1 and conc_persona.tipo ='P' limit $offset, $limit";
	$result = sqlsrv_query($con, $query);
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	sqlsrv_close($con);
}
function consultarConcesion($idconcesion) {
	// if (is_numeric($idconcesion)) {
		include('db.php');
		// $query = "select persona.id_persona,persona.nombre, persona.ap_pat, persona.ap_mat, conc_persona.tipo, concesion.placa, concesion.vin, concesion.num_serie, concesion.num_eco, concesion.marca, concesion.submarca, concesion.nota from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and concesion.idconcesion = $idconcesion";
		$query = "SELECT [personas].[id_per], [personas].[nombre], [personas].[a_paterno], [personas].[a_materno], 
[per_conc].[rol], [concesiones].[placa], [concesiones].[vin], [concesiones].[motor], 
[concesiones].[num_economico],[concesiones].[marca], [concesiones].[submarca] 
from [SistBusquedas].[dbo].[personas] inner join [SistBusquedas].[dbo].[per_conc] on [personas].[id_per] =
[per_conc].[id_per] inner join [SistBusquedas].[dbo].[concesiones] on [concesiones].[id_conc] =
[per_conc].[id_conc] and [concesiones].[id_conc] = $idconcesion";
		$result = sqlsrv_query($con, $query);
		// echo $result;
		// if (sqlsrv_num_rows($result)!=0) {
			// while(
				$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
			// ) {
				// $array[] = $row;
			// }
			// return($row);
				echo $row;
				var_dump($row);
		// }
		sqlsrv_close($con);
	// }
}
function consultarCarpetas($idconcesion) {
	if (is_numeric($idconcesion)) {
		include('db.php');
		$query = "select persona.id_persona, persona.nombre, persona.ap_pat, persona.ap_mat, concesion.idconcesion, inv_persona.idinv_persona, inv_persona.ci, inv_persona.borrado, inv_persona.origen from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on conc_persona.concesion_idconcesion = concesion.idconcesion inner join inv_persona on inv_persona.persona_idpersona = persona.id_persona and concesion.idconcesion = $idconcesion";
		// $query = "select distinct * from ( select distinct invper.idinv_persona,per.id_persona,con.folio folio_concesion,invper.ci,invper.borrado,'' robado , con.idconcesion from inv_persona invper inner join persona per on per.id_persona=invper.persona_idpersona inner join conc_persona conper on conper.persona_idpersona=per.id_persona inner join concesion con on con.idconcesion=conper.concesion_idconcesion union all select distinct invconc.idinv_conc,per.id_persona,con.folio folio_concesion,invconc.ci, '' borrado, invconc.robado, con.idconcesion from inv_conc invconc inner join concesion con on con.idconcesion= invconc.concesion_idconcesion inner join conc_persona conper on conper.concesion_idconcesion = con.idconcesion inner join persona per on per.id_persona = conper.persona_idpersona) sentencia where sentencia.idconcesion = $idconcesion";
		$result = sqlsrv_query($con, $query);
		if (sqlsrv_num_rows($result)!=0) {
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
		// $query = "select persona.id_persona, persona.nombre, persona.ap_pat, persona.ap_mat, concesion.idconcesion, inv_persona.idinv_persona, inv_persona.ci, inv_persona.borrado from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on conc_persona.concesion_idconcesion = concesion.idconcesion inner join inv_persona on inv_persona.persona_idpersona = persona.id_persona and concesion.idconcesion = $idconcesion";
		// $query = "select distinct * from ( select distinct invper.idinv_persona,per.id_persona,con.folio folio_concesion,invper.ci,invper.borrado,'' robado , con.idconcesion from inv_persona invper inner join persona per on per.id_persona=invper.persona_idpersona inner join conc_persona conper on conper.persona_idpersona=per.id_persona inner join concesion con on con.idconcesion=conper.concesion_idconcesion union all select distinct invconc.idinv_conc,per.id_persona,con.folio folio_concesion,invconc.ci, '' borrado, invconc.robado, con.idconcesion from inv_conc invconc inner join concesion con on con.idconcesion= invconc.concesion_idconcesion inner join conc_persona conper on conper.concesion_idconcesion = con.idconcesion inner join persona per on per.id_persona = conper.persona_idpersona) sentencia where sentencia.idconcesion = $idconcesion";
		$query = "select inv_conc.idinv_conc, inv_conc.ci, inv_conc.robado, inv_conc.concesion_idconcesion, inv_conc.borrado, concesion.idconcesion, concesion.vin, concesion.placa from inv_conc inner join concesion on inv_conc.concesion_idconcesion = concesion.idconcesion and concesion.idconcesion = $idconcesion";
		$result = sqlsrv_query($con, $query);
		if (sqlsrv_num_rows($result)!=0) {
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
		$query = "UPDATE inv_persona SET borrado = '$statusCI' WHERE idinv_persona = '$personaCI'";
		sqlsrv_query($con, $query);
	}
	sqlsrv_close($con);
}
function actualizarCarpetasAuto($arrayCIA) {
	include('db.php');
	foreach($arrayCIA as $autoCI => $statusCI) {
		$query = "UPDATE vcv.inv_conc SET borrado = $statusCI WHERE idinv_conc = $autoCI";
		sqlsrv_query($con, $query);
	}
	sqlsrv_close($con);
}
function actualizarIndicadorConcesionPrevalidador($actualizarIdConcesion,$idconcesion) {
	include('db.php');
	$query = "UPDATE vcv.concesion SET indicador = $actualizarIdConcesion WHERE idconcesion = $idconcesion";
	sqlsrv_query($con, $query);
	sqlsrv_close($con);
	header('Location: lista-concesionarios.php');
}
function guardarNota($idconcesion,$nota) {
    include('db.php');
    $query = "UPDATE concesion SET nota='$nota' WHERE idconcesion='$idconcesion'";
    sqlsrv_query($con,$query);
    sqlsrv_close($con);
}
?>