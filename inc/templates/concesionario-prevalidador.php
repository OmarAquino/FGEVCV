<h3>Detalle de la concesión</h3>
<?php if (isset($_POST['fgevcv-guardar'])): ?>
    <?php 
    $nota = $_POST['fgevcv-nota'];
    $idconcesion = $_POST['idconcesion'];
    if ($nota!=""){
        guardarNota($idconcesion,$nota);
    }else{
       $nota = "Sin Observaciones"; 
       guardarNota($idconcesion,$nota);
    }
    ?>
    <div class="alert alert-success">
        <strong>¡Éxito al guardar!</strong> Click aquí <a href="lista-concesionarios.php" class="alert-link">para regresar</a>.
    </div>
<?php endif ?>
<form method="POST" action="">
<div class="Concesionario">
    <?php if (isset($_GET['idconcesion']) && $_GET['idconcesion']!=NULL): ?>
    <?php $idconcesion  = $_GET['idconcesion'] ?>
    <?php $consulta     = consultarConcesion($idconcesion); ?>
    <?php $consultaCi   = consultarCarpetas($idconcesion); ?>
    <?php if ($consulta): ?>  
    <h4 class="Concesionario-tituloSeccion">Concesionario</h4>
    <div class="row rowDato">
        <div class="col-3">Nombre:</div>
        <?php foreach ($consulta as $resultado): ?>
            <?php
            if ($resultado['tipo']=='P') {
                $idPersona  = $resultado['id_persona']; 
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
            <textarea name="fgevcv-nota" cols="50" rows="5"></textarea>
        </div>
    </div>
    <div class="row rowDato">
        <div class="col-1">
            <input type="hidden" name="idconcesion" value="<?php echo $_GET['idconcesion']; ?>">
            <input type="submit" name="fgevcv-guardar" value="Guardar" class="btn bnt-secondary">
        </div>
        <div class="col-1">
            <a href="lista-concesionarios.php"><button type="button" class="btn btn-secondary">Regresar</button></a>
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
</div>
</form>