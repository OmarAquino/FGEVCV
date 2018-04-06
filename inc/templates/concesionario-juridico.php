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
                $nombre = $resultado['nombre'].' '.$resultado['ap_pat'].' '.$resultado['ap_mat'];
            }
            ?>
        <?php endforeach ?>
        <div class="col-9"><?php echo $nombre; ?></div>
    </div>
    <div class="row rowDato">
        <div class="col-3">Carpetas de Investigación</div>
        <div class="col-9">
            <div class="row">
                <div class="col-1">
                    <input id="ci-1" type="checkbox" class="css-checkbox">
                    <label for="ci-1" class="css-label"></label>
                </div>
                <div class="col-11">
                    <a href="#">Carpeta de investigación 1</a>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <input id="ci-2" type="checkbox" class="css-checkbox">
                    <label for="ci-2" class="css-label"></label>
                </div>
                <div class="col-11">
                    <a href="#">Carpeta de investigación 2</a>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <input id="ci-3" type="checkbox" class="css-checkbox">
                    <label for="ci-3" class="css-label"></label>
                </div>
                <div class="col-11">
                    <a href="#">Carpeta de investigación 3</a>
                </div>
            </div>
        </div>
    </div>
    <h4 class="Concesionario-tituloSeccion">Conductor</h4>
    <?php foreach ($consulta as $resultado): ?>
        <?php
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
                <div class="row">
                    <div class="col-1">
                        <input id="ci-4" type="checkbox" class="css-checkbox">
                        <label for="ci-4" class="css-label"></label>
                    </div>
                    <div class="col-11">
                        <a href="#">Carpeta de investigación 1</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <input id="ci-5" type="checkbox" class="css-checkbox">
                        <label for="ci-5" class="css-label"></label>
                    </div>
                    <div class="col-11">
                        <a href="#">Carpeta de investigación 2</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <input id="ci-6" type="checkbox" class="css-checkbox">
                        <label for="ci-6" class="css-label"></label>
                    </div>
                    <div class="col-11">
                        <a href="#">Carpeta de investigación 3</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

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
        <div class="col-3">Aprovado:</div>
        <div class="col-9">
            <input id="ci-3" type="checkbox" class="">
            <!-- <label for="ci-3" class="css-label"></label> -->
        </div>
    </div>
    <div class="row rowDato">
        <div class="col">
            <!-- <button type="button" class="btn btn-secondary">Guardar</button> -->
            <button type="button" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button>
        </div>
    </div>
</div>
