<?php require('inc/templates/header.php'); ?>
    <?php require('inc/functions/session.php'); ?>
	<?php require('inc/functions/querys.php'); ?>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="inc/functions/logout.php" class="Logout"><button type="button" class="btn btn-outline-danger">Cerrar sesión <i class="fas fa-sign-out-alt"></i></button></a>
    <?php endif ?>
    <div class="Concesionarios-contenedor">
    <h3>Jurídico</h3>
	<form method="POST" action="buscar.php" class="row">
   		<div class="col-3"><input type="text" name="fgevcv-nombre" class="form-control" placeholder="Nombre..."></textarea></div>
   		<div class="col-3"><input type="text" name="fgevcv-apat" class="form-control" placeholder="Ap. Paterno..."></textarea></div>
   		<div class="col-3"><input type="text" name="fgevcv-amat" class="form-control" placeholder="Ap. Materno..."></textarea></div>
	   	<div class="col-1"><button type="submit" class="btn btn-secondary" name="fgevcv-buscar">Buscar</button></div>
	   	<div class="col-2"><button type="button" class="btn btn-secondary">Actualizar</button><br></br></div>
	</form>
	<div class="Concesionarios-lista Concesionarios-listaPrevalidador">
   		<div class="row">
      		<div class="col col-7">Concesionario</div>
		    <!--<div class="col col-4">Conductor</div>-->
		    <div class="col col-4">Vehículo</div>
		    <div class="col col-1">Acción</div>  
   		</div>
		<?php if (isset($_POST['fgevcv-buscar'])): 
    		$nombre = $_POST['fgevcv-nombre'];
    		$apat = $_POST['fgevcv-apat'];
    		$amat = $_POST['fgevcv-amat'];
    		if ($nombre=="" and $apat=="" and $amat==""):?>
    		<br>
    			<div class="alert alert-danger" align="center">
              		<strong>No ha ingresado criterios para realizar la busqueda</strong>
            	</div>
            <?php else:
	    	$consulta = buscarNombreJur($nombre, $apat, $amat);
	    	$res=count($consulta);
	    	if ($res!=0):
    		foreach ($consulta as $resultado): ?>
	    	<div class="row">
	        	<div class="col col-7"><?php echo $resultado['nombre'].' '.$resultado['ap_pat'].' '.$resultado['ap_mat']; ?></div>
	        	<!--<div class="col col-4"></div>-->
	        	<div class="col col-4"><?php echo $resultado['placa']; ?></div>
	        	<div class="col col-1"><a href="concesionario.php?idconcesion=<?php echo $resultado['idconcesion']; ?>"><button type="button" class="btn btn-secondary"><i class="fas fa-eye"></i></button></a></div>
	    	</div> 
			<?php endforeach ?>
			<?php else:?>
				<br>
				<div class="alert alert-danger" align="center">
              		<strong>No se encontraron registros</strong>
            	</div>
			<?php endif ?>
		<?php endif ?>
   			<br>
   			<div class="col-1">
            	<a href="lista-concesionarios.php"><button type="button" class="btn btn-secondary">Regresar</button></a>
    		</div>
   	</div>
   	
		<?php endif ?>