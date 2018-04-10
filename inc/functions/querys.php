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
function consultarConcesion($idconcesion) {
	if (is_numeric($idconcesion)) {
		include('db.php');
		$query = "select persona.id_persona,persona.nombre, persona.ap_pat, persona.ap_mat, conc_persona.tipo, concesion.placa, concesion.vin, concesion.num_serie, concesion.marca, concesion.submarca from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and concesion.idconcesion = $idconcesion";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result)!=0) {
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$array[] = $row;
			}
			return($array);
		}
		mysqli_close($con);
	}
}
function consultarCarpetas($idconcesion) {
	if (is_numeric($idconcesion)) {
		include('db.php');
		$query = "select distinct * from ( select distinct invper.idinv_persona,per.id_persona,con.folio folio_concesion,invper.ci,invper.status,'' robado , con.idconcesion  from inv_persona invper inner join persona per on per.id_persona=invper.persona_idpersona inner join conc_persona conper on conper.persona_idpersona=per.id_persona inner join concesion con on con.idconcesion=conper.concesion_idconcesion union all  select distinct invconc.idinv_conc,per.id_persona,con.folio folio_concesion,invconc.ci, '' status, invconc.robado, con.idconcesion  from inv_conc invconc inner join concesion con on con.idconcesion= invconc.concesion_idconcesion inner join conc_persona conper on conper.concesion_idconcesion = con.idconcesion inner join persona per on per.id_persona = conper.persona_idpersona ) sentencia  where sentencia.idconcesion = $idconcesion";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result)!=0) {
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$array[] = $row;
			}
			return($array);
		}
		mysqli_close($con);
	}
}
function guardarNota($idconcesion,$nota){
	include('db.php');
	$query = "UPDATE 'concesion' SET 'nota'='$nota' WHERE 'idconcesion'='$idconcesion'";
	$result = mysqli_query($con,$query);
	echo $query;
	mysqli_close($con);
	// }
}

?>