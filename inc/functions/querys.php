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
	$query = "select persona.id_persona, persona.nombre,persona.ap_pat, persona.ap_mat, concesion.idconcesion, concesion.placa, concesion.folio, conc_persona.tipo from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and concesion.indicador = 0 and conc_persona.tipo ='P'";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$array[] = $row;
	}
	return($array);
	mysqli_close($con);
}
function consultarConcesionariosJuridico() {
	include('db.php');
	$query = "select persona.id_persona, persona.nombre,persona.ap_pat, persona.ap_mat, concesion.idconcesion, concesion.placa, concesion.folio, conc_persona.tipo from persona inner join conc_persona on persona.id_persona = conc_persona.persona_idpersona inner join concesion on concesion.idconcesion = conc_persona.concesion_idconcesion and concesion.indicador = 1 and conc_persona.tipo ='P'";
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
		$query = "Select distinct * from (
		select distinct
		invper.idinv_persona,per.id_persona,con.folio folio_concesion,invper.ci,invper.borrado,'' robado , con.idconcesion 
		from inv_persona invper
		inner join persona per on per.id_persona=invper.persona_idpersona
		inner join conc_persona conper on conper.persona_idpersona=per.id_persona
		inner join concesion con on con.idconcesion=conper.concesion_idconcesion
		union all 
		select distinct
		invconc.idinv_conc,per.id_persona,con.folio folio_concesion,invconc.ci, '' borrado, invconc.robado, con.idconcesion 
		from inv_conc invconc
		inner join concesion con on con.idconcesion= invconc.concesion_idconcesion
		inner join conc_persona conper on conper.concesion_idconcesion = con.idconcesion
		inner join persona per on per.id_persona = conper.persona_idpersona
		) sentencia 
		where sentencia.idconcesion = $idconcesion";
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
	$query = "UPDATE concesion SET nota='$nota' WHERE idconcesion='$idconcesion'";
	mysqli_query($con,$query);
	mysqli_close($con);
	// }
}
function actualizarCarpetasPropietario($arrayCI) {
// UPDATE vcv.inv_persona SET status='1' WHERE idinv_persona = 6;
// SELECT * FROM vcv.inv_persona where persona_idpersona = 1;
// SELECT * FROM vcv.inv_conc where concesion_idconcesion = 1;
	include('db.php');
	foreach($arrayCI as $personaCI => $statusCI) {
		$query = "UPDATE inv_persona SET status = $statusCI WHERE idinv_persona = $personaCI";
		mysqli_query($con, $query);
		var_dump($arrayCI);
		echo $query;
	}
	mysqli_close($con);
}
function buscarNombre($nombre,$apat,$amat){
	include('db.php');//nombre y apellido pat
	if ($nombre !="" and $apat!="" and $amat=="") :
		$query="Select * from persona INNER JOIN conc_persona ON persona.id_persona=conc_persona.persona_idpersona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion where conc_persona.tipo='P' and concesion.indicador=0 and persona.nombre like '%$nombre%' and persona.ap_pat like '%$apat%'";
		//nombre y apellidos
	elseif ($nombre!="" and $apat!="" and $amat!="") :
	$query = "Select * from persona INNER JOIN conc_persona ON persona.id_persona=conc_persona.persona_idpersona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion where conc_persona.tipo='P' and concesion.indicador=0 and persona.nombre like '%$nombre%' and persona.ap_pat like '%$apat%' and persona.ap_mat like '%$amat%'";
	//Apellidos
	elseif ($nombre=="" and $apat!="" and $amat!="") :
		$query="Select * from persona INNER JOIN conc_persona ON persona.id_persona=conc_persona.persona_idpersona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion where conc_persona.tipo='P' and concesion.indicador=0 and persona.ap_pat like '%$apat%' and persona.ap_mat like '%$amat%'";
		//Nombre
	elseif ($nombre!="" and $apat=="" and $amat=="") :
		$query = "Select * from persona INNER JOIN conc_persona ON persona.id_persona=conc_persona.persona_idpersona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion where conc_persona.tipo='P' and concesion.indicador=0 and persona.nombre like '%$nombre%'";
		//Paterno
	elseif ($nombre=="" and $apat!="" and $amat=="") :
		$query = "Select * from persona INNER JOIN conc_persona ON persona.id_persona=conc_persona.persona_idpersona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion where conc_persona.tipo='P' and concesion.indicador=0 and persona.ap_pat like '%$apat%'";
		//Materno
	elseif ($nombre=="" and $apat=="" and $amat!="") :
		$query = "Select * from persona INNER JOIN conc_persona ON persona.id_persona=conc_persona.persona_idpersona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion where conc_persona.tipo='P' and concesion.indicador=0 and persona.ap_mat like '%$amat%'";
		//Nombre y Materno
	elseif ($nombre !="" and $apat=="" and $amat!="") :
		$query = "Select * from persona INNER JOIN conc_persona ON persona.id_persona=conc_persona.persona_idpersona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion where conc_persona.tipo='P' and concesion.indicador=0 and persona.nombre like '%$nombre%' and persona.ap_mat like '%$amat%'";
	endif;
	//return($query);
	$result=mysqli_query($con,$query);
			if (mysqli_num_rows($result)!=0) {
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$array[] = $row;
			}
			return($array);
	mysql_close($con);

		}
}
function buscarNombreJur($nombre,$apat,$amat){
	include('db.php');//nombre y apellido pat
	if ($nombre !="" and $apat!="" and $amat=="") :
		$query="SELECT * FROM persona INNER JOIN conc_persona on conc_persona.persona_idpersona=persona.id_persona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion WHERE concesion.indicador='1' AND conc_persona.tipo='P' and persona.nombre like '%$nombre%' and persona.ap_pat like '%$apat%'";
		//nombre y apellidos
	elseif ($nombre!="" and $apat!="" and $amat!="") :
	$query = "Select * from persona INNER JOIN conc_persona ON persona.id_persona=conc_persona.persona_idpersona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion where conc_persona.tipo='P' and concesion.indicador=1 and persona.nombre like '%$nombre%' and persona.ap_pat like '%$apat%' and persona.ap_mat like '%$amat%'";
	//Apellidos
	elseif ($nombre=="" and $apat!="" and $amat!="") :
		$query="Select * from persona INNER JOIN conc_persona ON persona.id_persona=conc_persona.persona_idpersona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion where conc_persona.tipo='P' and concesion.indicador=1 and persona.ap_pat like '%$apat%' and persona.ap_mat like '%$amat%'";
		//Nombre
	elseif ($nombre!="" and $apat=="" and $amat=="") :
		$query = "Select * from persona INNER JOIN conc_persona ON persona.id_persona=conc_persona.persona_idpersona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion where conc_persona.tipo='P' and concesion.indicador=1 and persona.nombre like '%$nombre%'";
		//Paterno
	elseif ($nombre=="" and $apat!="" and $amat=="") :
		$query = "Select * from persona INNER JOIN conc_persona ON persona.id_persona=conc_persona.persona_idpersona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion where conc_persona.tipo='P' and concesion.indicador=1 and persona.ap_pat like '%$apat%'";
		//Materno
	elseif ($nombre=="" and $apat=="" and $amat!="") :
		$query = "Select * from persona INNER JOIN conc_persona ON persona.id_persona=conc_persona.persona_idpersona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion where conc_persona.tipo='P' and concesion.indicador=1 and persona.ap_mat like '%$amat%'";
		//Nombre y Materno
	elseif ($nombre !="" and $apat=="" and $amat!="") :
		$query = "Select * from persona INNER JOIN conc_persona ON persona.id_persona=conc_persona.persona_idpersona INNER JOIN concesion on concesion.idconcesion=conc_persona.concesion_idconcesion where conc_persona.tipo='P' and concesion.indicador=1 and persona.nombre like '%$nombre%' and persona.ap_mat like '%$amat%'";
	endif;
	//return($query);
	$result=mysqli_query($con,$query);
			if (mysqli_num_rows($result)!=0) {
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$array[] = $row;
			}
			return($array);
	mysql_close($con);

		}
}
?>