<?php require('inc/templates/header.php'); ?>
    <?php require('inc/functions/session.php'); ?>
	<?php require('inc/functions/querys.php'); ?>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="inc/functions/logout.php" class="Logout"><button type="button" class="btn btn-outline-danger">Cerrar sesión <i class="fas fa-sign-out-alt"></i></button></a>
    <?php endif ?>
    <div class="Concesionarios-contenedor">
<h3>Lista de concesionarios</h3>
<form method="GET" action="buscar.php?p=$_GET['p']&s=$_GET['s']&t=$_GET['t']" class="row">
   	<div class="col-4"><input type="text" name="p" class="form-control" placeholder="Nombre(s)..."></textarea></div>
   	<div class="col-3"><input type="text" name="s" class="form-control" placeholder="Ap. Paterno..."></textarea></div>
   	<div class="col-3"><input type="text" name="t" class="form-control" placeholder="Ap. Materno..."></textarea></div>
	<div class="col-2" align="center"><button type="submit" class="btn btn-secondary" name="fgevcv-buscar">Buscar</button><br></br></div>
</form>
	<div class="Concesionarios-lista Concesionarios-listaPrevalidador">
   		<div class="row">
      		<div class="col col-7">Concesionario</div>
		    <!--<div class="col col-4">Conductor</div>-->
		    <div class="col col-4">Vehículo</div>
		    <div class="col col-1">Acción</div>  
   		</div>
		<?php //if (isset($_GET['fgevcv-buscar'])): 
    		$nombre = $_GET['p'];
    		$apat = $_GET['s'];
    		$amat = $_GET['t'];
    		if ($nombre=="" and $apat=="" and $amat==""):?>
    		<br>
    			<div class="alert alert-danger" align="center">
              		<strong>No ha ingresado criterios para realizar la busqueda</strong>
            	</div>
            <?php else:
	    	$consulta = buscarNombre($nombre, $apat, $amat);
	    	$res=count($consulta);
	    	// echo $res;
	    	$limit = 10;
   			$adjacents = 1;
   			$total_pages = ceil($res / $limit);
   			if(isset($_GET['page']) && $_GET['page'] != "") {
      			$page = $_GET['page'];      			$offset = $limit * ($page-1);
   			} else {
      			$page = 1;
      			$offset = 0;
   			}
   			if ($res!=0):
   			$cons=buscarPaginacion($nombre,$apat,$amat,$offset,$limit);
   			$ajaxCounter = 1; ?>
			<script>
			    var d        = new Date();
			    var dia      = d.getDate();
			    var mesZero  = d.getMonth();
			    var mes      = mesZero+1;
			    var anio     = d.getFullYear();
			    var hora     = d.getHours();
			    var minutos  = d.getMinutes();
			    var segundos = d.getSeconds();
			    var fechaF   = anio+'-'+mes+'-'+dia+' '+hora+':'+minutos+':'+segundos;
			</script>
    		<?php foreach ($cons as $res): ?>
	    	<div id="concesion<?php echo $ajaxCounter; ?>" class="row">
	        	<div class="col col-7"><?php echo $res['nombre'].' '.$res['a_paterno'].' '.$res['a_materno']; ?></div>
	        	<!--<div class="col col-4"></div>-->
	        	<div class="col col-4"><?php echo $res['placa']; ?></div>
	        	<div class="col col-1">
            	<a href="concesionario.php?id_conc=<?php echo $res['id_conc']; ?>" target="_blank">
               	<button id="trigger<?php echo $ajaxCounter; ?>" type="button" class="btn btn-secondary"><i class="fas fa-eye"></i></button>
            	</a></div>
	    	</div> 
	    	<script>
         // $( document ).ready(function() {
            var editando = 'editando';
            var libre = 'libre';
            function ajaxTimer<?php echo $ajaxCounter; ?>() {
               var d        = new Date();
               var dia      = d.getDate();
               var mesZero  = d.getMonth();
               var mes      = mesZero+1;
               var anio     = d.getFullYear();
               var hora     = d.getHours();
               var minutos  = d.getMinutes();
               var segundos = d.getSeconds();
               var fechaF   = anio+'-'+mes+'-'+dia+' '+hora+':'+minutos+':'+segundos;

               $.ajax({
                  type : 'POST',
                  url : 'inc/functions/consultar-editando.php',
                  data : { 
                        idconcesion  : <?php echo $res['id_conc']; ?>,
                        fechaF       : fechaF 
                     },
                     success : function(response) {
                        var status = response.trim();
                        console.log(status+' '+<?php echo $res['id_conc']; ?>);
                        if (status==editando) {
                           $('#concesion<?php echo $ajaxCounter; ?>').css('background', '#d6d8d9');
                           $('#concesion<?php echo $ajaxCounter; ?>').css('color', '#1b1e21');
                           $('#concesion<?php echo $ajaxCounter; ?> i').removeClass('fas fa-eye');
                           $('#concesion<?php echo $ajaxCounter; ?> i').addClass('fas fa-ban');
                           $('#concesion<?php echo $ajaxCounter; ?> a').css('pointer-events', 'none');
                        }
                        if (status==libre) {
                           $('#concesion<?php echo $ajaxCounter; ?>').css('background', 'none');
                           $('#concesion<?php echo $ajaxCounter; ?>').css('color', '#212529');
                           $('#concesion<?php echo $ajaxCounter; ?> i').removeClass('fas fa-ban');
                           $('#concesion<?php echo $ajaxCounter; ?> i').addClass('fas fa-eye');
                           $('#concesion<?php echo $ajaxCounter; ?> a').css('pointer-events', 'auto');
                        }
                     }
                  });
               setTimeout(ajaxTimer<?php echo $ajaxCounter; ?>, 5000);
            }
            ajaxTimer<?php echo $ajaxCounter; ?>();
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
		<?php //echo $_GET['fgevcv-nombre']; ?> 
		<?php if($total_pages > 1) { ?>
		   <ul class="pagination pagination justify-content-center">
		      <li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
		         <a class='page-link' href="?page=1&p=<?php echo $_GET['p']; ?>&s=<?php echo $_GET['s']; ?>&t=<?php echo $_GET['t']; ?>">&lt;&lt;</a>
		      </li>
		      <li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
		         <a class='page-link' href="?page=<?php ($page>1 ? print($page-1) : print 1)?>&p=<?php echo $_GET['p']; ?>&s=<?php echo $_GET['s']; ?>&t=<?php echo $_GET['t']; ?>">&lt;</a>
		      </li>
		      <?php for($i=$start; $i<=$end; $i++) { ?>
		      <li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
		         <a class='page-link' href="?page=<?php echo $i;?>&p=<?php echo $_GET['p']; ?>&s=<?php echo $_GET['s']; ?>&t=<?php echo $_GET['t']; ?>"><?php echo $i;?></a>
		      </li>
		      <?php } ?>
		      <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
		         <a class='page-link' href="?page=<?php ($page < $total_pages ? print($page+1) : print $total_pages)?>&p=<?php echo $_GET['p']; ?>&s=<?php echo $_GET['s']; ?>&t=<?php echo $_GET['t']; ?>">&gt;</a>
		      </li>
		      <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
		         <a class='page-link' href="?page=<?php echo $total_pages;?>&p=<?php echo $_GET['p']; ?>&s=<?php echo $_GET['s']; ?>&t=<?php echo $_GET['t']; ?>">&gt;&gt;</a>
		      </li>
		   </ul>
		   <?php } ?>
			<?php else:?>
				<br>
				<div class="alert alert-danger" align="center">
              		<strong>No se encontraron registros</strong>
            	</div>
			<?php endif ?>
		<?php //endif ?>
   	</div>   	
		<?php endif ?>
			<div class="col-2" align="center">
            	<a href="lista-concesionarios.php"><button type="button" class="btn btn-secondary">Regresar</button></a>
    		</div>