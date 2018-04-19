<?php if (isset($_POST['fgevcv-guardar'])): ?>
    <?php if (isset($_POST['ci'])): ?>
        <?php actualizarCarpetasPropietario($_POST['ci']); ?>
    <?php endif ?>
    <?php if (isset($_POST['cia'])): ?>
        <?php actualizarCarpetasAuto($_POST['cia']); ?>
    <?php endif ?>
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
    <?php actualizarIndicadorConcesion($_POST['actualizarcicon'], $_POST['idconcesion']); ?>
<?php endif ?>
<h3>Detalle de la concesión</h3>
<form method="POST" action="" class="Concesionario" id="concesionario-form">
    <?php if (isset($_GET['id_conc']) && $_GET['id_conc']!=NULL): ?>
        <?php $idconcesion      = $_GET['id_conc'] ?>
        <?php $consulta         = consultarConcesion($idconcesion); ?>
        <?php $consultaCi       = consultarCarpetas($idconcesion); ?>
        <?php $consultaCiAuto   = consultarCarpetasAuto($idconcesion); ?>
        <?php $consultaMand     = consultarMandamientos($idconcesion); ?>
        <?php if ($consulta): ?>
            <script>
                $('#editingModal').modal({ show: false});
                var d        = new Date();
                var dia      = d.getDate();
                var mesZero  = d.getMonth();
                var mes      = mesZero+1;
                var anio     = d.getFullYear();
                var hora     = d.getHours();
                var minutos  = d.getMinutes();
                var segundos = d.getSeconds();
                var fechaF   = anio+'-'+mes+'-'+dia+' '+hora+':'+minutos+':'+segundos;
                $( document ).ready(function() {
                    var editando = 'editando';
                    var libre = 'libre';
                    $.ajax({
                        type : 'POST',
                        url : 'inc/functions/editando.php',
                        data : { 
                                    idconcesion : <?php echo $idconcesion; ?>,
                                    fechaF      : fechaF 
                               },
                        success : function(response) {
                            var status = response.trim();
                            console.log(status);
                            if (status==editando) {
                                $('#editingModal').modal('show');
                            }
                        }
                    });
                    function ajaxTimer() {
                        $.ajax({
                            type : 'POST',
                            url : 'inc/functions/editando-activo.php',
                            data : { 
                                        idconcesion  : <?php echo $idconcesion; ?>,
                                        fechaF       : fechaF 
                                   },
                            success : function(response) {
                                $('#ajaxresult2').html(response);
                            }
                        });
                    }        
                    window.setInterval(function(){
                        ajaxTimer();
                    }, 120000);
                });
            </script>  
            <h4 class="Concesionario-tituloSeccion">Concesionario</h4>
            <div class="row rowDato">
                <div class="col-3">Nombre:</div>
                    <?php foreach ($consulta as $resultado): ?>
                        <?php
                        if ($resultado['rol']=='P') {
                            $idPersonaPropietario  = $resultado['id_per']; 
                            $nombre     = $resultado['nombre'].' '.$resultado['a_paterno'].' '.$resultado['a_materno'];
                        }  
                        ?>
                    <?php endforeach ?>
                <div class="col-9"><?php echo $nombre; ?></div>
            </div>
            <div class="row rowDato">
                <div class="col-3">Carpetas de Investigación</div>
                <div class="col-9">
                    <?php foreach ($consulta as $resultado): ?>
                        <?php if ($resultado['rol']=='P') : ?>
                            <?php if ($consultaCi): ?>
                                <?php $labelCounter = 1; ?>
                                <?php foreach ($consultaCi as $resultado) : ?>
                                    <?php if ($idPersonaPropietario==$resultado['id_per']) : ?>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="http://192.108.24.103/<?php echo preg_replace('/\s+/', '', $resultado['origen']); ?>/Averiguaciones/asuntos/SEC_01-GENERALES/AFormato.asp?IdAsunto=<?php echo $resultado['carpeta']; ?>" target="_blank"><?php echo $resultado['carpeta']; ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <input id="cih-<?php echo $labelCounter; ?>" type="hidden" name="ci[<?php echo $resultado['id']; ?>]" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>">
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
                                    <?php endif ?>
                                    <?php $labelCounter++; ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="row rowDato">
                <div class="col-3">Mandamientos judiciales</div>
                <div class="col-9">
                    <?php foreach ($consulta as $resultado): ?>
                        <?php if ($resultado['rol']=='P') : ?>
                            <?php if ($consultaMand): ?>
                                <?php foreach ($consultaMand as $resultado) : ?>
                                    <?php if ($idPersonaPropietario==$resultado['id_per']) : ?>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <span><?php echo $resultado['mand_jud']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                if ($resultado['rol']=='C') { 
                    $nombre = $resultado['nombre'].' '.$resultado['a_paterno'].' '.$resultado['a_materno']; ?>
                    <div class="row rowDato">
                        <div class="col-3">Nombre:</div>
                        <div class="col-9"><?php echo $nombre; ?></div>
                    </div>
                    <?php if ($idPersonaPropietario!=$resultado['id_per']) { ?>
                        <div class="row rowDato">
                            <div class="col-3">Carpetas de Investigación</div>
                            <div class="col-9">
                                <?php $idPersona = $resultado['id_per']; ?>
                                <?php if ($consultaCi): ?>
                                    <?php $labelCounter2 = 1; ?>
                                    <?php $ciCounter = 1; ?>
                                    <?php foreach ($consultaCi as $resultado) : ?>
                                        <?php if ($idPersona==$resultado['id_per']) : ?>
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="row">
                                                        <div class="col">
                                                            <a href="http://192.108.24.103/<?php echo preg_replace('/\s+/', '', $resultado['origen']); ?>/Averiguaciones/asuntos/SEC_01-GENERALES/AFormato.asp?IdAsunto=<?php echo $resultado['carpeta']; ?>" target="_blank"><?php echo $resultado['carpeta']; ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <input id="cih2-<?php echo $labelCounter2; ?>" type="hidden" name="ci[<?php echo $resultado['id']; ?>]" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>">
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
                                        <?php endif ?> 
                                        <?php $labelCounter2++; ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="row rowDato">
                            <div class="col-3">Mandamientos judiciales</div>
                            <div class="col-9">
                                <?php if ($consultaMand): ?>
                                    <?php foreach ($consultaMand as $resultado) : ?>
                                        <?php if ($idPersona==$resultado['id_per']) : ?>
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="row">
                                                        <div class="col">
                                                            <span><?php echo $resultado['mand_jud']; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php } ?>
                    <hr>
                <?php } ?>
            <?php endforeach ?>
    
            <h4 class="Concesionario-tituloSeccion">Vehículo</h4>
            <?php
            $auto = 1;
            if($auto == 1) {
                foreach ($consulta as $resultado):
                    if ($resultado) {
                        $placa      = $resultado['placa'];
                        $vin        = $resultado['vin'];
                        $num_serie  = $resultado['motor'];
                        $marca      = $resultado['marca'];
                        $submarca   = $resultado['submarca'];
                        $num_eco    = $resultado['num_economico'];
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
            <div class="row rowDato">
                <div class="col-3">Número económico:</div>
                <div class="col-9"><?php echo $num_eco; ?></div>
            </div> 
            <div class="row rowDato">
                <div class="col-3">Carpetas de investigación:</div>
                <div class="col-9">
                    <?php if ($consultaCiAuto): ?>
                        <?php $labelCounter3 = 1; ?>
                        <?php foreach ($consultaCiAuto as $resultado) : ?>
                            <div class="row">
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col">
                                            <a href="#"><?php echo $resultado['carpeta']; ?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <input id="cih3-<?php echo $labelCounter3; ?>" type="hidden" name="cia[<?php echo $resultado['id']; ?>]" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>">
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
                    <input type="hidden" name="idconcesion" value="<?php echo $_GET['id_conc']; ?>">
                    <input type="hidden" name="actualizarcicon" id="actualizarcicon" value="1">
                    <button id="concesionario-form-submit" type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
                        <i class="far fa-save"></i> Guardar
                    </button>
                </div>
                <div class="col-2">
                        <button type="button" class="btn btn-secondary" onclick="self.close()">
                            <i class="far fa-arrow-alt-circle-left"></i> Regresar
                        </button>
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
                    <button id="" type="submit" name="fgevcv-guardar" class="btn btn-dark">
                        <i class="far fa-save"></i> Guardar
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="editingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Concesión en edición</h5>
      </div>
      <div class="modal-body">
        <h3>Esta concesión ya está siendo revisada</h3>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-dark">Regresar</button>
      </div>
    </div>
  </div>
</div>