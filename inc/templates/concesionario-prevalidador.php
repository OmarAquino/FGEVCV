<h3>Detalle de la concesión</h3>
<div class="Concesionario">
    <h4 class="Concesionario-tituloSeccion">Concesionario</h4>
    <?php $idconcesion = $_GET['idconcesion'] ?>
    <?php $consulta = consultarConcesionJuridico($idconcesion); ?>
    <?php //print_r($consulta); ?>
    <div class="row rowDato">
        <div class="col-3">Nombre:</div>
        <?php foreach ($consulta as $resultado): ?>
            <?php
            if ($resultado['tipo']=='P') {
                $idPersona  = $resultado['id_persona']; 
                $nombre = $resultado['nombre'].' '.$resultado['ap_pat'].' '.$resultado['ap_mat'];
            ?>
        <div class="col-9"><?php echo $nombre; ?></div>
    </div>
    <div class="row rowDato">
        <div class="col-3">Carpetas de Investigación</div>
        <div class="col-9">
            <?php foreach ($consulta as $resultado): ?>
                <?php $idPersona = $resultado['id_persona']; ?>
                <?php if ($resultado['tipo']=='P') : ?>
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
            <?php endforeach ?>
        </div>
    </div>
    <?php } ?>
    <?php endforeach ?>
    <h4 class="Concesionario-tituloSeccion">Conductor</h4>
    <?php foreach ($consulta as $resultado): ?>
        <?php
        if ($idPersona!=$resultado['id_persona']) {
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
            </div>
        </div>
        <?php 
        } 
        }
        ?>

    <?php endforeach ?>
    
    <h4 class="Concesionario-tituloSeccion">Vehículo</h4>
    <?php //foreach ($consulta as $resultado): ?>
        <div class="row rowDato">
            <div class="col-3">Placas:</div>
            <div class="col-9"><?php echo $resultado['placa']; ?></div>
        </div>
        <div class="row rowDato">
            <div class="col-3">VIN:</div>
            <div class="col-9"><?php echo $resultado['vin']; ?></div>
        </div>
        <div class="row rowDato">
            <div class="col-3">Número de serie:</div>
            <div class="col-9"><?php echo $resultado['num_serie']; ?></div>
        </div>
        <div class="row rowDato">
            <div class="col-3">Marca:</div>
            <div class="col-9"><?php echo $resultado['marca']; ?></div>
        </div>
        <div class="row rowDato">
            <div class="col-3">Submarca:</div>
            <div class="col-9"><?php echo $resultado['submarca']; ?></div>
        </div> 
    <?php //endforeach ?>
    
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
            <button type="button" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button>
        </div>
    </div>
</div>