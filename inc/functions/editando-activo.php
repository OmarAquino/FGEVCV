<?php
$idconcesion = $_POST['idconcesion'];
$fechaF 	 = $_POST['fechaF'];
include('db.php');
$query = "SELECT banderaf FROM [Sistbusquedas].[dbo].[concesiones] WHERE concesiones.id_conc = $idconcesion";
$result = sqlsrv_query($con, $query);
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
	$array[] = $row;
}
$getFecha = $array[0]['banderaf']->format('Y-m-d H:i:s');
$fechaJS = strtotime($fechaF);
$fechaPHP = strtotime($getFecha);
echo $getFecha;
$newtimestamp = strtotime("$getFecha + 3 minute");
$nuevafecha = date('Y-m-d H:i:s', $newtimestamp) ;
echo '<br>';
$query = "UPDATE [Sistbusquedas].[dbo].[concesiones] SET banderaf = '$nuevafecha' WHERE concesiones.id_conc = $idconcesion";
sqlsrv_query($con, $query);
echo $nuevafecha;
sqlsrv_close($con);
?>