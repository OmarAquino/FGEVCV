<?php if (isset($_POST['fgevcv-guardar'])): ?>
    <?php if (isset($_POST['ci'])): ?>
        <?php actualizarCarpetasPropietario($_POST['ci']); ?>
    <?php endif ?>
    <?php if (isset($_POST['cia'])): ?>
        <?php actualizarCarpetasAuto($_POST['cia']); ?>
    <?php endif ?>
    <?php actualizarIndicadorConcesionPrevalidador($_POST['actualizarcicon'], $_POST['idconcesion']); ?>
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
<?php endif ?>
    <?php $consulta         = consultarConcesion(); ?>

    <?php //var_dump($consulta); ?>

<h3>Detalle de la concesión</h3>
<form method="POST" action="" class="Concesionario" id="concesionario-form">
    <?php if (isset($_GET['id_conc']) && $_GET['id_conc']!=NULL): ?>
    <?php $idconcesion      = $_GET['id_conc'] ?>
    <?php //$consultaCi       = consultarCarpetas($idconcesion); ?>
    <?php //$consultaCiAuto   = consultarCarpetasAuto($idconcesion); ?>
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
            <?php $noCiCounter = 1; ?>
            <?php foreach ($consulta as $resultado): ?>
                <?php if ($resultado['tipo']=='P') : ?>
                    <?php $idPersona = $resultado['id_persona']; ?>
                    <?php if ($consultaCi): ?>
                        <?php $labelCounter = 1; ?>
                        <?php foreach ($consultaCi as $resultado) : ?>
                            <?php $ciCounter = 1; ?>
                            <?php if ($idPersona==$resultado['id_persona']) : ?>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col">
                                                <a href="http://192.108.24.103/<?php echo $resultado['origen']; ?>/Averiguaciones/asuntos/SEC_01-GENERALES/AFormato.asp?IdAsunto=<?php echo $resultado['ci']; ?>" target="_blank"><?php echo $resultado['ci']; ?></a>
                                            </div>
           <!--                                  <?php if ($resultado['borrado']==1): ?>
                                                <div class="col-3">
                                                    <div class="alert alert-info custom-alert" role="alert">No relevante</div> 
                                                </div>
                                            <?php endif ?> -->
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <input id="cih-<?php echo $labelCounter; ?>" type="hidden" name="ci[<?php echo $resultado['idinv_persona']; ?>]" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>">
                                        <input id="ci-<?php echo $labelCounter; ?>" name="" type="checkbox" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>" <?php if($resultado['borrado']==1){echo 'checked';} ?> class="css-checkbox">
                                        <label for="ci-<?php echo $labelCounter; ?>" class="css-label">No relevante</label>
                                        <script>
                                            jQuery("#ci-<?php echo $labelCounter; ?>").change(function() {
                                                if(this.checked) {
                                                    jQuery("#cih-<?php echo $labelCounter; ?>").val('1');
                                                }else {
                                                    jQuery("#cih-<?php echo $labelCounter; ?>").val('0');
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                                <?php else: ?>
                                    <?php if ($noCiCounter==1): ?>
                                        Sin carpetas de investigación
                                        <?php $noCiCounter=0; ?>
                                    <?php endif ?>
                            <?php endif ?>
                            <?php $labelCounter++; ?>
                        <?php endforeach ?>
                    <?php else: ?>
                        Sin carpetas de investigación
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
                    <?php $labelCounter2 = 1; ?>
                    <?php foreach ($consultaCi as $resultado) : ?>
                        <?php if ($idPersona==$resultado['id_persona']) : ?>
                            <div class="row">
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col">
                                            <a href="http://192.108.24.103/<?php echo $resultado['origen']; ?>/Averiguaciones/asuntos/SEC_01-GENERALES/AFormato.asp?IdAsunto=<?php echo $resultado['ci']; ?>" target="_blank"><?php echo $resultado['ci']; ?></a>
                                        </div>
<!--                                         <?php if ($resultado['borrado']==1): ?>
                                            <div class="col-3">
                                                <div class="alert alert-info custom-alert" role="alert">No relevante</div> 
                                            </div>
                                        <?php endif ?> -->
                                    </div>
                                </div>
                                <div class="col-5">
                                    <input id="cih2-<?php echo $labelCounter2; ?>" type="hidden" name="ci[<?php echo $resultado['idinv_persona']; ?>]" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>">
                                    <input id="ci2-<?php echo $labelCounter2; ?>" name="" type="checkbox" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>" <?php if($resultado['borrado']==1){echo 'checked';} ?> class="css-checkbox">
                                    <label for="ci2-<?php echo $labelCounter2; ?>" class="css-label">No relevante</label>
                                    <script>
                                        jQuery("#ci2-<?php echo $labelCounter2; ?>").change(function() {
                                            if(this.checked) {
                                                jQuery("#cih2-<?php echo $labelCounter2; ?>").val('1');
                                            }else {
                                                jQuery("#cih2-<?php echo $labelCounter2; ?>").val('0');
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        <?php else: ?>
                            Sin carpetas de investigación
                        <?php endif ?> 
                        <?php $labelCounter2++; ?>
                    <?php endforeach ?>
                <?php else: ?>
                    Sin carpetas de investigación
                <?php endif ?>
            </div>
        </div>
        <hr>
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
                $num_eco    = $resultado['num_eco'];
             } 
        $placa = $resultado['placa'];
        $auto = 0;
        endforeach; 
    } 
    //print_r($consultaCiAuto);
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
    <div class="row rowDato">
        <div class="col-3">Número económico:</div>
        <div class="col-9"><?php echo $num_eco; ?></div>
    </div> 
    <div class="row rowDato">
        <div class="col-3">Carpetas de investigación:</div>
        <div class="col-9">
            <?php //var_dump($consultaCiAuto); ?>
            <?php if ($consultaCiAuto): ?>
                <?php $labelCounter3 = 1; ?>
                <?php foreach ($consultaCiAuto as $resultado) : ?>
                        <div class="row">
                            <div class="col-3">
                                <div class="row">
                                    <div class="col">
                                        <a href="#"><?php echo $resultado['ci']; ?></a>
                                    </div>
  <!--                                   <?php if ($resultado['borrado']==1): ?>
                                        <div class="col-3">
                                            <div class="alert alert-info custom-alert" role="alert">No relevante</div> 
                                        </div>
                                    <?php endif ?> -->
                                </div>
                            </div>
                            <div class="col-5">
                                <input id="cih3-<?php echo $labelCounter3; ?>" type="hidden" name="cia[<?php echo $resultado['idinv_conc']; ?>]" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>">
                                <input id="ci3-<?php echo $labelCounter3; ?>" name="" type="checkbox" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>" <?php if($resultado['borrado']==1){echo 'checked';} ?> class="css-checkbox">
                                <label for="ci3-<?php echo $labelCounter3; ?>" class="css-label">No relevante</label>
                                <script>
                                    jQuery("#ci3-<?php echo $labelCounter3; ?>").change(function() {
                                        if(this.checked) {
                                            jQuery("#cih3-<?php echo $labelCounter3; ?>").val('1');
                                        }else {
                                            jQuery("#cih3-<?php echo $labelCounter3; ?>").val('0');
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    <?php $labelCounter3++; ?>
                <?php endforeach ?>
                <?php //var_dump($consultaCi); ?>
            <?php else: ?> 
                Sin carpetas de investigación
            <?php endif ?>
        </div>
    </div> 
    <div class="row rowDato">
        <div class="col-3">Robado:</div>
        <div class="col-9">
            <?php if ($consultaCiAuto): ?>
                <?php if($resultado['robado']==1){echo 'Sí';}elseif($resultado['robado']==0){echo 'No';}else{echo '---';} ?>
            <?php else: ?>
                No
            <?php endif ?>
        </div>
    </div> 
    <hr class="u-separador">
    <div class="row rowDato">
        <div class="col-3">Nota:</div>
        <div class="col-9">
            <textarea name="fgevcv-nota" id="" cols="30" rows="3"></textarea>
        </div>
    </div>
    <script>
        $( document ).ready(function() {
            if ($('.css-checkbox:checked').length == $('.css-checkbox').length) {
                $('#actualizarcicon').val('2');
            } else {
                $('#actualizarcicon').val('1');
            }
        });
        var checkboxes = document.getElementsByClassName('css-checkbox');
        if (checkboxes.length>0) {
            var noCiMensaje = 0;
            $('.css-checkbox').change(function(){
                if ($('.css-checkbox:checked').length == $('.css-checkbox').length) {
                    $('#actualizarcicon').val('2');
                } else {
                    $('#actualizarcicon').val('1');
                }
            });
        } else {
            $('#actualizarcicon').val('2');
            var noCiMensaje = 1;
        }
    </script>
    <div class="row rowDato">
        <div class="col-2">
            <input type="hidden" name="idconcesion" value="<?php echo $_GET['idconcesion']; ?>">
            <input type="hidden" name="actualizarcicon" id="actualizarcicon" value="1">
            <button id="concesionario-form-submit" type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
                <i class="far fa-save"></i> Guardar
            </button>
        </div>
        <div class="col-2">
            <a href="lista-concesionarios.php"><button type="button" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Regresar</button></a>
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

    <script>
        $("#concesionario-form-submit").click(function(){
            var modificacion = $('#actualizarcicon').val();
            if (modificacion==1) {
                $('.modal-body').html('No todas las carpetas de investigación fueron marcadas como "no relevante", por lo tanto esta concesión pasará a revisión con jurídico, ¿deseas continuar?');
            }
            if (modificacion==2) {
                if (noCiMensaje==0) {
                    $('.modal-body').html('Todas las carpetas de investigación fueron marcadas como "no relevante", por lo tanto esta concesión quedará como aprobada, ¿deseas continuar?');
                } else {
                    $('.modal-body').html('No hay carpetas por revisar, por lo tanto esta concesión quedará como aprobada, ¿deseas continuar?');
                }
            }
        });
    </script>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validación de concesión vehicular</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="submit" name="fgevcv-guardar" class="btn btn-dark">
                        <i class="far fa-save"></i> Guardar
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>
