<h3>Prevalidador</h3>
<div class="row">
  <div class="col-6"><input id="buscar" type="text" class="form-control" placeholder="Nombre..."></div>
  <div class="col-1"><button type="button" class="btn btn-secondary">Buscar</button></div>
  <div class="col-1"><button type="button" class="btn btn-secondary">Actualizar</button><br></br></div>
</div>
<div class="Concesionarios-lista Concesionarios-listaPrevalidador">
  <div class="row">
    <div class="col col-7">Concesionario</div>
    <!--<div class="col col-4">Conductor</div>-->
    <div class="col col-4">Vehículo</div>
    <div class="col col-1">Acción</div>  
  </div>
  <?php $consulta = consultarConcesionariosJuridico(); ?>
    <?php foreach ($consulta as $resultado): ?>
  <div class="row">
    <div class="col col-7"><?php echo $resultado['nombre'].' '.$resultado['ap_pat'].' '.$resultado['ap_mat']; ?></div>
    <!--<div class="col col-4"></div>-->
    <div class="col col-4"><?php echo $resultado['placa']; ?></div>
    <div class="col col-1"><a href="concesionario.php?idconcesion=<?php echo $resultado['idconcesion']; ?>"><button type="button" class="btn btn-secondary"><i class="fas fa-eye"></i></button></a></div>
  </div>
  </div>   
  <?php endforeach ?> 
</div>