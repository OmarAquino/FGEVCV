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
   <?php $consulta = consultarConcesionariosPrevalidador(); ?>
   <?php $resultados = count($consulta); ?>
   <?php
   $limit = 10;
   $adjacents = 1;
   $total_pages = ceil($resultados / $limit);
   if(isset($_GET['page']) && $_GET['page'] != "") {
      $page = $_GET['page'];
      $offset = $limit * ($page-1);
   } else {
      $page = 1;
      $offset = 0;
   }
   ?>
   <?php $consultaPaginacion = consultarConcesionariosPrevalidadorPaginacion($offset, $limit); ?>
   <?php //print_r($consultaPaginacion); ?>
   <?php $ajaxCounter = 1; ?>
   <?php foreach ($consultaPaginacion as $resultado): ?>
      <div class="row">
         <div class="col col-7"><?php echo $resultado['nombre'].' '.$resultado['ap_pat'].' '.$resultado['ap_mat']; ?></div>
         <!--<div class="col col-4"></div>-->
         <div class="col col-4"><?php echo $resultado['placa']; ?></div>
         <div class="col col-1">
            <a href="concesionario.php?idconcesion=<?php echo $resultado['idconcesion']; ?>">
               <button id="trigger<?php echo $ajaxCounter; ?>" type="button" class="btn btn-secondary"><i class="fas fa-eye"></i></button>
            </a>
         </div>
      </div>
      <script>
         $("#trigger<?php echo $ajaxCounter; ?>").click(function(){
            // alert('<?php echo $ajaxCounter; ?>');
            // function testEnvio() {
               jQuery.ajax({
                  type: "POST",
                  url:  'inc/functions/editando.php',
                  data: { "idConcesion": '<?php echo $resultado['idconcesion']; ?>' }
               });
            // }
         });
      </script>
      <?php $ajaxCounter++; ?>
   <?php endforeach ?>
   <?php
   if($total_pages <= (1+($adjacents * 2))) {
      $start = 1;
      $end   = $total_pages;
   } else {
      if(($page - $adjacents) > 1) {               //Checking if the current page minus adjacent is greateer than one.
         if(($page + $adjacents) < $total_pages) {  //Checking if current page plus adjacents is less than total pages.
            $start = ($page - $adjacents);         //If true, then we will substract and add adjacent from and to the current page number  
            $end   = ($page + $adjacents);         //to get the range of the page numbers which will be display in the pagination.
         } else {                         //If current page plus adjacents is greater than total pages.
            $start = ($total_pages - (1+($adjacents*2)));  //then the page range will start from total pages minus 1+($adjacents*2)
            $end   = $total_pages;                    //and the end will be the last page number that is total pages number.
         }
      } else {                            //If the current page minus adjacent is less than one.
         $start = 1;                                //then start will be start from page number 1
         $end   = (1+($adjacents * 2));             //and end will be the (1+($adjacents * 2)).
      }
   }
   ?>
</div>   
<?php if($total_pages > 1) { ?>
   <ul class="pagination pagination justify-content-center">
      <li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
         <a class='page-link' href='?page=1'>&lt;&lt;</a>
      </li>
      <li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
         <a class='page-link' href='?page=<?php ($page>1 ? print($page-1) : print 1)?>'>&lt;</a>
      </li>
      <?php for($i=$start; $i<=$end; $i++) { ?>
      <li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
         <a class='page-link' href='?page=<?php echo $i;?>'><?php echo $i;?></a>
      </li>
      <?php } ?>
      <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
         <a class='page-link' href='?page=<?php ($page < $total_pages ? print($page+1) : print $total_pages)?>'>&gt;</a>
      </li>
      <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
         <a class='page-link' href='?page=<?php echo $total_pages;?>'>&gt;&gt;</a>
      </li>
   </ul>
<?php } ?>
