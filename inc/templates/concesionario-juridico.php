<?php if (isset($_POST['fgevcv-guardar-aceptar'])): ?>
    <?php //if (isset($_POST['ci'])): ?>
        <?php //actualizarCarpetasPropietario($_POST['ci']); ?>
    <?php //endif ?>
    <?php //if (isset($_POST['cia'])): ?>
        <?php //actualizarCarpetasAuto($_POST['cia']); ?>
    <?php //endif ?>
    <?php //if (isset($_POST['cim'])): ?>
        <?php //actualizarMandamientos($_POST['cim']); ?>
    <?php //endif ?>
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
    <?php actualizarHistorial($_POST['usuario'], $_POST['idconcesion'], 2); ?>
    <?php //if (isset($_POST['actualizarcicon'])): ?>
    <?php actualizarIndicadorConcesion(2, $_POST['idconcesion']); ?>
    <?php //endif ?>
<?php endif ?>
<?php if (isset($_POST['fgevcv-guardar-rechazar'])): ?>
    <?php //if (isset($_POST['ci'])): ?>
        <?php //actualizarCarpetasPropietario($_POST['ci']); ?>
    <?php //endif ?>
    <?php //if (isset($_POST['cia'])): ?>
        <?php //actualizarCarpetasAuto($_POST['cia']); ?>
    <?php //endif ?>
    <?php //if (isset($_POST['cim'])): ?>
        <?php //actualizarMandamientos($_POST['cim']); ?>
    <?php //endif ?>
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
    <?php actualizarHistorial($_POST['usuario'], $_POST['idconcesion'], 3); ?>
    <?php //if (isset($_POST['actualizarcicon'])): ?>
    <?php actualizarIndicadorConcesion(3, $_POST['idconcesion']); ?>
    <?php //endif ?>
<?php endif ?>
<!-- código viejito -->
<?php if (isset($_POST['fgevcv-guardar'])): ?>
    <?php //if (isset($_POST['ci'])): ?>
        <?php //actualizarCarpetasPropietario($_POST['ci']); ?>
    <?php //endif ?>
    <?php //if (isset($_POST['cia'])): ?>
        <?php //actualizarCarpetasAuto($_POST['cia']); ?>
    <?php //endif ?>
    <?php //if (isset($_POST['cim'])): ?>
        <?php //actualizarMandamientos($_POST['cim']); ?>
    <?php //endif ?>
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
    <?php actualizarHistorial($_POST['usuario'], $_POST['idconcesion'], $_POST['actualizarcicon']); ?>
    <?php if (isset($_POST['actualizarcicon'])): ?>
        <?php actualizarIndicadorConcesion($_POST['actualizarcicon'], $_POST['idconcesion']); ?>
    <?php endif ?>
<?php endif ?>
<?php if (isset($_POST['fgevcv-guardar-draft'])): ?>
    <?php //if (isset($_POST['ci'])): ?>
        <?php //actualizarCarpetasPropietario($_POST['ci']); ?>
    <?php //endif ?>
    <?php //if (isset($_POST['cia'])): ?>
        <?php //actualizarCarpetasAuto($_POST['cia']); ?>
    <?php //endif ?>
    <?php //if (isset($_POST['cim'])): ?>
        <?php //actualizarMandamientos($_POST['cim']); ?>
    <?php //endif ?>
    <?php
    $nota = $_POST['fgevcv-nota'];
    $idconcesion = $_POST['idconcesion'];
    guardarNota($idconcesion,$nota);
    echo '<script>window.close()</script>';
    ?>
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
        <?php 
            $idPersonaPropietarioArray=[];
            foreach ($consulta as $resultado): 
        ?>
                    <?php
                        $propCount=0;
                        $contCarp=0;
                        
                        if ($resultado['rol']=='P') {
                            if (! in_array($resultado['id_per'],$idPersonaPropietarioArray)){
                                array_push($idPersonaPropietarioArray,$resultado['id_per']);
                                $nombre     = $resultado['nombre'].' '.$resultado['a_paterno'].' '.$resultado['a_materno'];
                                echo "<div class='col-3'>Nombre:</div>";
                                echo "<div class='col-9'>".$nombre."</div>";
                            }
                        }  
                    ?>
        <?php endforeach ?>
    </div>
    <div class="row rowDato">
        <div class="col-3">Carpetas de Investigación</div>
        <div class="col-9">
           <?php foreach ($consulta as $resultado): ?>
                <?php if ($resultado['rol']=='P') : ?>
                    <?php if ($consultaCi): ?>
                        <?php $labelCounter = 1; ?>
                        
                        <?php 
                                    foreach ($consultaCi as $resultado) : 
                                ?>
                                    <?php 
                                        if (in_array($resultado['id_per'],$idPersonaPropietarioArray)) :
                                    ?>

                                <?php if ($resultado['borrado']!=1): ?>
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
                                                        jQuery.ajax({
                                                            type : 'POST',
                                                            url : 'inc/functions/actualizar-carpeta-investigacion.php',
                                                            data : { 
                                                                        statusCI : 1,
                                                                        idCI     : <?php echo $resultado['id']; ?> 
                                                                   },
                                                            success : function(response) {
                                                                // $('#ajaxresult2').html(response);
                                                            }
                                                        });
                                                    }else {
                                                        jQuery("#cih-<?php echo $labelCounter; ?>").val('0');
                                                        jQuery.ajax({
                                                            type : 'POST',
                                                            url : 'inc/functions/actualizar-carpeta-investigacion.php',
                                                            data : { 
                                                                        statusCI : 0,
                                                                        idCI     : <?php echo $resultado['id']; ?> 
                                                                   },
                                                            success : function(response) {
                                                                // $('#ajaxresult2').html(response);
                                                            }
                                                        });
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                <?php endif ?>
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
                        <?php $labelCounterM = 1; ?>
                        <?php foreach ($consultaMand as $resultado) : ?>
                            <?php if (in_array($resultado['id_per'],$idPersonaPropietarioArray)) : ?>
                                <?php if ($resultado['borrado']!=1): ?>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="http://192.108.24.26/ConsultaProc/asuntos/SEC_01-GENERALES/VISUALIZA_GENERALES.asp?IdAsunto=<?php echo $resultado['mand_jud']; ?>" target="_blank"><?php echo $resultado['mand_jud']; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <input id="cihm-<?php echo $labelCounterM; ?>" type="hidden" name="cim[<?php echo $resultado['id']; ?>]" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>">
                                            <input id="cim-<?php echo $labelCounterM; ?>" name="" type="checkbox" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>" <?php if($resultado['borrado']==1){echo 'checked';} ?> class="css-checkbox">
                                            <label for="cim-<?php echo $labelCounterM; ?>" class="css-label">No relevante</label>
                                            <script>
                                                jQuery("#cim-<?php echo $labelCounterM; ?>").change(function() {
                                                    if(this.checked) {
                                                        jQuery("#cihm-<?php echo $labelCounterM; ?>").val('1');
                                                        jQuery.ajax({
                                                            type : 'POST',
                                                            url : 'inc/functions/actualizar-mandamiento-judicial.php',
                                                            data : { 
                                                                        statusCI : 1,
                                                                        idCI     : <?php echo $resultado['id']; ?> 
                                                                   },
                                                            success : function(response) {
                                                                // $('#ajaxresult2').html(response);
                                                            }
                                                        });
                                                    } else {
                                                        jQuery("#cihm-<?php echo $labelCounterM; ?>").val('0');
                                                        jQuery.ajax({
                                                            type : 'POST',
                                                            url : 'inc/functions/actualizar-mandamiento-judicial.php',
                                                            data : { 
                                                                        statusCI : 0,
                                                                        idCI     : <?php echo $resultado['id']; ?> 
                                                                   },
                                                            success : function(response) {
                                                                // $('#ajaxresult2').html(response);
                                                            }
                                                        });
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                <?php endif ?>
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
        if (! in_array($resultado['id_per'],$idPersonaPropietarioArray)) {
        if ($resultado['rol']=='C') { 
            $nombre = $resultado['nombre'].' '.$resultado['a_paterno'].' '.$resultado['a_materno'];
        ?>
        <div class="row rowDato">
            <div class="col-3">Nombre:</div>
            <div class="col-9"><?php echo $nombre; ?></div>
        </div>
        <div class="row rowDato">
            <div class="col-3">Carpetas de Investigación</div>
            <div class="col-9">
                <?php $idPersona = $resultado['id_per']; ?>
                <?php if ($consultaCi): ?>
                    <?php $labelCounter2 = 1; ?>
                    <?php foreach ($consultaCi as $resultado) : ?>
                        <?php if ($idPersona==$resultado['id_per']) : ?>
                            <?php if ($resultado['borrado']!=1): ?>
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
                                                    jQuery.ajax({
                                                        type : 'POST',
                                                        url : 'inc/functions/actualizar-carpeta-investigacion.php',
                                                        data : { 
                                                                    statusCI : 1,
                                                                    idCI     : <?php echo $resultado['id']; ?> 
                                                               },
                                                        success : function(response) {
                                                            // $('#ajaxresult2').html(response);
                                                        }
                                                    });
                                                }else {
                                                    jQuery("#cih2-<?php echo $labelCounter2; ?>").val('0');
                                                    jQuery.ajax({
                                                        type : 'POST',
                                                        url : 'inc/functions/actualizar-carpeta-investigacion.php',
                                                        data : { 
                                                                    statusCI : 0,
                                                                    idCI     : <?php echo $resultado['id']; ?> 
                                                               },
                                                        success : function(response) {
                                                            // $('#ajaxresult2').html(response);
                                                        }
                                                    });
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            <?php endif ?>   
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
                    <?php $labelCounterM2 = 1; ?>
                    <?php foreach ($consultaMand as $resultado) : ?>
                        <?php if ($idPersona==$resultado['id_per']) : ?>
                            <?php if ($resultado['borrado']!=1): ?>
                               <div class="row">
                                   <div class="col-3">
                                       <div class="row">
                                           <div class="col">
                                               <a href="http://192.108.24.26/ConsultaProc/asuntos/SEC_01-GENERALES/VISUALIZA_GENERALES.asp?IdAsunto=<?php echo $resultado['mand_jud']; ?>" target="_blank"><?php echo $resultado['mand_jud']; ?></a>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-5">
                                       <input id="cihm2-<?php echo $labelCounterM2; ?>" type="hidden" name="cim[<?php echo $resultado['id']; ?>]" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>">
                                       <input id="cim2-<?php echo $labelCounterM2; ?>" name="" type="checkbox" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>" <?php if($resultado['borrado']==1){echo 'checked';} ?> class="css-checkbox">
                                       <label for="cim2-<?php echo $labelCounterM2; ?>" class="css-label">No relevante</label>
                                       <script>
                                           jQuery("#cim2-<?php echo $labelCounterM2; ?>").change(function() {
                                               if(this.checked) {
                                                   jQuery("#cihm2-<?php echo $labelCounterM2; ?>").val('1');
                                                   jQuery.ajax({
                                                       type : 'POST',
                                                       url : 'inc/functions/actualizar-mandamiento-judicial.php',
                                                       data : { 
                                                                   statusCI : 1,
                                                                   idCI     : <?php echo $resultado['id']; ?> 
                                                              },
                                                       success : function(response) {
                                                           // $('#ajaxresult2').html(response);
                                                       }
                                                   });
                                               } else {
                                                   jQuery("#cihm2-<?php echo $labelCounterM2; ?>").val('0');
                                                   jQuery.ajax({
                                                       type : 'POST',
                                                       url : 'inc/functions/actualizar-mandamiento-judicial.php',
                                                       data : { 
                                                                   statusCI : 0,
                                                                   idCI     : <?php echo $resultado['id']; ?> 
                                                              },
                                                       success : function(response) {
                                                           // $('#ajaxresult2').html(response);
                                                       }
                                                   });
                                               }
                                           });
                                       </script>
                                   </div>
                               </div> 
                            <?php endif ?>
                        <?php endif ?>
                        <?php $labelCounterM2++; ?>
                    <?php endforeach ?>
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
                $num_serie  = $resultado['motor'];
                $marca      = $resultado['marca'];
                $submarca   = $resultado['submarca'];
                $num_eco    = $resultado['num_economico'];
                $nota       = $resultado['nota'];
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
                        <?php if ($resultado['borrado']!=1): ?>
                            <div class="row">
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col">
                                            <!-- <a href="#"><?php echo $resultado['carpeta']; ?></a> -->
                                            <a href="http://192.108.24.103/<?php echo preg_replace('/\s+/', '', $resultado['region']); ?>/Averiguaciones/asuntos/SEC_01-GENERALES/AFormato.asp?IdAsunto=<?php echo $resultado['carpeta']; ?>" target="_blank"><?php echo $resultado['carpeta']; ?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input id="cih3-<?php echo $labelCounter3; ?>" type="hidden" name="cia[<?php echo $resultado['id']; ?>]" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>">
                                    <input id="ci3-<?php echo $labelCounter3; ?>" name="" type="checkbox" value="<?php if($resultado['borrado']==NULL){echo '0';}else{echo $resultado['borrado'];} ?>" <?php if($resultado['borrado']==1){echo 'checked';} ?> class="css-checkbox">
                                    <label for="ci3-<?php echo $labelCounter3; ?>" class="css-label">No relevante</label>
                                    <script>
                                        jQuery("#ci3-<?php echo $labelCounter3; ?>").change(function() {
                                            if(this.checked) {
                                                jQuery("#cih3-<?php echo $labelCounter3; ?>").val('1');
                                                jQuery.ajax({
                                                    type : 'POST',
                                                    url : 'inc/functions/actualizar-carpeta-investigacion-auto.php',
                                                    data : { 
                                                                statusCI : 1,
                                                                idCI     : <?php echo $resultado['id']; ?> 
                                                           },
                                                    success : function(response) {
                                                        // $('#ajaxresult2').html(response);
                                                    }
                                                });
                                            }else {
                                                jQuery("#cih3-<?php echo $labelCounter3; ?>").val('0');
                                                jQuery.ajax({
                                                    type : 'POST',
                                                    url : 'inc/functions/actualizar-carpeta-investigacion-auto.php',
                                                    data : { 
                                                                statusCI : 0,
                                                                idCI     : <?php echo $resultado['id']; ?> 
                                                           },
                                                    success : function(response) {
                                                        // $('#ajaxresult2').html(response);
                                                    }
                                                });
                                            }
                                        });
                                    </script>
                                </div>
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col">
                                            <a href="http://192.108.24.103/<?php echo preg_replace('/\s+/', '', $resultado['region']); ?>/Averiguaciones/asuntos/SEC_11-VEHICULOS/MUESTRAVEHICULO.asp?IdVehiculo=<?php echo $resultado['idVehiculo']; ?>" target="_blank">Detalle del auto</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php $labelCounter3++; ?>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div> 
    <div class="row rowDato">
        <div class="col-3">Robado:</div>
        <div class="col-9">
            <?php if ($consultaCiAuto): ?>
                <?php if($resultado['status']==1){echo 'Sí';}elseif($resultado['status']==0){echo 'No';}else{echo '---';} ?>
            <?php else: ?>
                No
            <?php endif ?>
        </div>
    </div> 
    <hr class="u-separador">
    <div class="row rowDato">
        <div class="col-3">Nota:</div>
        <div class="col-9">
            <textarea name="fgevcv-nota" id="" cols="50" rows="4">
                <?php echo $nota; ?>
            </textarea>
        </div>
    </div>
    <script>
        $( document ).ready(function() {
            if ($('.css-checkbox:checked').length == $('.css-checkbox').length) {
                $('#actualizarcicon').val('2');
            } else {
                $('#actualizarcicon').val('3');
            }
        });
        var checkboxes = document.getElementsByClassName('css-checkbox');
        if (checkboxes.length>0) {
            var noCiMensaje = 0;
            $('.css-checkbox').change(function(){
                if ($('.css-checkbox:checked').length == $('.css-checkbox').length) {
                    $('#actualizarcicon').val('2');
                } else {
                    $('#actualizarcicon').val('3');
                }
            });
        } else {
            $('#actualizarcicon').val('3');
            var noCiMensaje = 1;
        }
    </script>
    <div class="row rowDato">
        <input type="hidden" name="idconcesion" value="<?php echo $_GET['id_conc']; ?>">
        <input type="hidden" name="actualizarcicon" id="actualizarcicon" value="3">
        <input type="hidden" name="usuario" value="<?php echo $_SESSION['user']; ?>">
        <div class="col-2">
            <button id="" name="fgevcv-guardar-aceptar" type="submit" class="btn btn-dark">
                <i class="fas fa-check"></i> Aceptar
            </button>
        </div>
        <div class="col-2">
            <button id="" name="fgevcv-guardar-rechazar" type="submit" class="btn btn-dark">
                <i class="fas fa-times"></i> Rechazar
            </button>
        </div>
    </div>
    <div class="row rowDato">
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
            if (modificacion==3) {
                $('.modal-body').html('No todas las carpetas de investigación fueron marcadas como "no relevante", por lo tanto esta concesión no será aprobada, ¿deseas continuar?');
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
                    <button id="" type="submit" name="fgevcv-guardar-draft" class="btn btn-dark">
                        <i class="fab fa-firstdraft"></i> Guardar borrador
                    </button>
                    <button type="submit" name="fgevcv-guardar" class="btn btn-dark">
                        <i class="far fa-save"></i> Guardar
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    function cerrarVentana() {
        // jQuery('#cerrar-ventana').click(function(){
            window.close();
        // });
    }
</script>
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
        <button id="#cerrar-ventana" type="button" class="btn btn-dark" onclick="cerrarVentana();">Regresar</button>
      </div>
    </div>
  </div>
</div>