<?php
// Consultar usuarios
function consultarUsuarios() {
	include('db.php');
	$query  = "SELECT * FROM usuarios";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	     $array[] = $row;
	}
	return($array);
	mysqli_close($con);
}
function consultarConcesionariosPrevalidador() {
	include('db.php');
	$query = "select persona.id_persona, persona.nombre,persona.ap_pat, persona.ap_mat, concesion.idconcesion, concesion.placa, concesion.folio from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and conc_persona.tipo='P' and concesion.indicador='0'";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	mysqli_close($con);
}
function consultarConcesionariosJuridico() {
	include('db.php');
	$query = "select persona.id_persona, persona.nombre,persona.ap_pat, persona.ap_mat, concesion.idconcesion, concesion.placa, concesion.folio from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and conc_persona.tipo='P' and concesion.indicador='1'";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	mysqli_close($con);
}
function consultarConcesionariosPrevalidadorPaginacion($offset, $limit) {
	include('db.php');
	$query = "select persona.id_persona, persona.nombre,persona.ap_pat, persona.ap_mat, concesion.idconcesion, concesion.placa, concesion.folio from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and conc_persona.tipo='P' and concesion.indicador='0' limit $offset, $limit";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	mysqli_close($con);
}
function consultarConcesionariosJuridicoPaginacion($offset, $limit) {
	include('db.php');
	$query = "select persona.id_persona, persona.nombre,persona.ap_pat, persona.ap_mat, concesion.idconcesion, concesion.placa, concesion.folio from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and conc_persona.tipo='P' and concesion.indicador='1'";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	mysqli_close($con);
}
function consultarConcesionJuridico($idconcesion) {
	include('db.php');
	$query = "select persona.id_persona,persona.nombre, persona.ap_pat, persona.ap_mat, conc_persona.tipo, concesion.placa, concesion.vin, concesion.num_serie, concesion.marca, concesion.submarca from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and concesion.idconcesion = $idconcesion";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	mysqli_close($con);
}
?>