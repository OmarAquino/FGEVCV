<?php if (isset($_POST['fgevcv-updateCI'])): ?>
    <?php actualizarCarpetasPropietario($_POST['ci']); ?>
<?php endif ?>

<h3>Detalle de la concesión</h3>
<form method="POST" action="" class="Concesionario">
    <?php if (isset($_GET['idconcesion']) && $_GET['idconcesion']!=NULL): ?>
    <?php $idconcesion  = $_GET['idconcesion'] ?>
    <?php $consulta     = consultarConcesion($idconcesion); ?>
    <?php $consultaCi   = consultarCarpetas($idconcesion); ?>
    <?php var_dump($consulta); ?>
    <hr>
    <?php var_dump($consultaCi); ?>
    <?php if ($consulta): ?>  
    <h4 class="Concesionario-tituloSeccion">Concesionario</h4>
    <div class="row rowDato">
        <div class="col-3">Nombre:</div>
        <?php foreach ($consulta as $resultado): ?>
            <?php
            if ($resultado['tipo']=='P') {
                $idPersonaPropietario  = $resultado['id_persona']; 
                $nombre     = $resultado['nombre'].' '.$resultado['ap_pat'].' '.$resultado['ap_mat'];
            }  
            ?>
        <?php endforeach ?>
        <div class="col-9"><?php echo $nombre; ?></div>
    </div>
    <div class="row rowDato">
        <div class="col-3">Carpetas de Investigación</div>
        <div class="col-9">
            <?php foreach ($consulta as $resultado): ?>
                <?php if ($resultado['tipo']=='P') : ?>
                    <?php $idPersona = $resultado['id_persona']; ?>
                    <?php if ($consultaCi): ?>
                        <?php $labelCounter = 1; ?>
                        <?php foreach ($consultaCi as $resultado) : ?>
                            <?php if ($idPersona==$resultado['id_persona']) : ?>
                                <div class="row">
                                    <div class="col-1">
                                        <input id="ci-<?php echo $labelCounter; ?>" name="ci[<?php echo $resultado['idinv_persona']; ?>]" type="checkbox" value="<?php if($resultado['status']==NULL){echo '0';}else{echo $resultado['status'];} ?>" <?php if($resultado['status']==1){echo 'checked';} ?> class="css-checkbox">
                                        <label for="ci-<?php echo $labelCounter; ?>" class="css-label"></label>
                                    </div>
                                    <div class="col-11">
                                        <a href="#"><?php echo $resultado['ci']; ?></a>
                                    </div>
                                </div>
                                <?php $labelCounter++; ?>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endif ?>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
    <h4 class="Concesionario-tituloSeccion">Conductor</h4>
    <?php foreach ($consulta as $resultado): ?>
        <?php
        if ($idPersonaPropietario!=$resultado['id_persona']) {
        if ($resultado['tipo']=='C') { 
            $nombre = $resultado['nombre'].' '.$resultado['ap_pat'].' '.$resultado['ap_mat'];
        ?>
        <div class="row rowDato">
            <div class="col-3">Nombre:</div>
            <div class="col-9"><?php echo $nombre; ?></div>
        </div>
        <div class="row rowDato">
            <div class="col-3">Carpetas de Investigación</div>
            <div class="col-9">
                <?php $idPersona = $resultado['id_persona']; ?>
                <?php if ($consultaCi): ?>
                    <?php foreach ($consultaCi as $resultado) : ?>
                        <?php if ($idPersona==$resultado['id_persona']) : ?>
                            <div class="row">
                                <div class="col-1">
                                    <input id="ci-2" type="checkbox" class="css-checkbox">
                                    <label for="ci-2" class="css-label"></label>
                                </div>
                                <div class="col-11">
                                    <a href="#"><?php echo $resultado['ci']; ?></a>
                                </div>
                            </div>
                        <?php endif ?> 
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
        <?php 
        } 
        }
        ?>
    <?php endforeach ?>
    
    <h4 class="Concesionario-tituloSeccion">Vehículo</h4>
    <?php
    $auto = 1;
    if($auto == 1) {
        foreach ($consulta as $resultado):
            if ($resultado) {
                $placa      = $resultado['placa'];
                $vin        = $resultado['vin'];
                $num_serie  = $resultado['num_serie'];
                $marca      = $resultado['marca'];
                $submarca   = $resultado['submarca'];
             } 
        $placa = $resultado['placa'];
        $auto = 0;
        endforeach; 
    } 
    ?>
    <div class="row rowDato">
        <div class="col-3">Placas:</div>
        <div class="col-9"><?php echo $placa; ?></div>
    </div>
    <div class="row rowDato">
        <div class="col-3">VIN:</div>
        <div class="col-9"><?php echo $vin; ?></div>
    </div>
    <div class="row rowDato">
        <div class="col-3">Número de serie:</div>
        <div class="col-9"><?php echo $num_serie; ?></div>
    </div>
    <div class="row rowDato">
        <div class="col-3">Marca:</div>
        <div class="col-9"><?php echo $marca; ?></div>
    </div>
    <div class="row rowDato">
        <div class="col-3">Submarca:</div>
        <div class="col-9"><?php echo $submarca; ?></div>
    </div> 
    
    <hr class="u-separador">
    <div class="row rowDato">
        <div class="col-3">Nota:</div>
        <div class="col-9">
            <textarea name="" id="" cols="50" rows="5"></textarea>
        </div>
    </div>
    <div class="row rowDato">
        <div class="col">
            <!-- <button type="button" class="btn btn-secondary">Guardar</button> -->
            <input type="submit" class="btn btn-primary" value="Guardar" name="fgevcv-updateCI"><i class="far fa-save"></i>
        </div>
    </div>
    <?php else: ?>
        <div class="alert alert-info">
          <strong>No hay resultados para esta consulta</strong>
        </div>
    <?php endif ?>
    <?php else: ?>
        <div class="alert alert-info">
          <strong>No hay resultados para esta consulta</strong>
        </div>
    <?php endif ?>
</form>
