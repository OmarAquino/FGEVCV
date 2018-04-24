<?php
$idconcesion = $_POST['idconcesion'];
include('db.php');
$query = "SELECT ind_pre FROM [Sistbusquedas].[dbo].[concesiones] WHERE concesiones.id_conc = $idconcesion";
$result = sqlsrv_query($con, $query);
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
	$array[] = $row;
}
echo $array[0]['ind_pre'];
// $getFecha = $array[0]['banderaf']->format('Y-m-d H:i:s');
// $fechaJS = strtotime($fechaF);
// $fechaPHP = strtotime($getFecha);
// if ($fechaPHP>$fechaJS) {
// 	echo 'editando';
// } else {
// 	echo 'libre';
// }

sqlsrv_close($con);
?>