<h3>Lista de concesionarios</h3>
<div class="row">
  <div class="col-6"><input id="buscar" type="text" class="form-control" placeholder="Nombre..."></div>
  <div class="col-1"><button type="button" class="btn btn-secondary">Buscar</button></div>
  <div class="col-1"><button type="button" class="btn btn-secondary">Actualizar</button><br></br></div>
</div>
<div class="Concesionarios-lista">
  	<div class="row">
    	<div class="col col-4">Concesionario</div>
    	<div class="col col-1">Estatus</div>
<!--     	<div class="col col-3">Chofer</div>
    	<div class="col col-1">Estatus</div> -->
    	<div class="col col-4">Vehículo</div>
    	<div class="col col-1">Estatus</div>
    	<div class="col col-2">Acción</div>
  	</div>
    <?php $consulta = consultarConcesionariosJuridico(); ?>
    <?php //var_dump($consulta); ?>
    <?php foreach ($consulta as $resultado): ?>
        <div class="row">
            <div class="col col-4"><?php echo $resultado['nombre'].' '.$resultado['ap_pat'].' '.$resultado['ap_mat']; ?></div>
            <div class="col col-1"><?php //echo $resultado[''] ?></div>
            <!-- <div class="col col-3"><?php //echo $resultado[''] ?></div> -->
            <!-- <div class="col col-1"><?php //echo $resultado[''] ?></div> -->
            <div class="col col-4"><?php echo $resultado['placa']; ?></div>
            <div class="col col-1"><?php //echo $resultado[''] ?></div>
            <div class="col col-2"><a href="concesionario.php?idconcesion=<?php echo $resultado['idconcesion']; ?>"><button type="button" class="btn btn-secondary"><i class="fas fa-eye"></i></button></a></div>
        </div>  
    <?php endforeach ?>
</div>