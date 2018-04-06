<?php require('inc/templates/header.php'); ?>
	<?php require('inc/functions/querys.php'); ?>
	<?php $consulta = consultarUsuarios(); ?>
	<?php foreach ($consulta as $resultado): ?>
		<?php echo $resultado['usuario']; ?>
	<?php endforeach ?>

   	<div class="Concesionarios-contenedor">
   	   <?php require('inc/templates/concesionarios-juridico.php'); ?>
   	   <?php require('inc/templates/concesionarios-prevalidador.php'); ?>
   	</div>
   	<nav aria-label="Page navigation example">
    	<ul class="pagination justify-content-center">

    		<!-- Link of the first page -->
    		<li class='page-item disabled'>
    			<a class='page-link' href='?page=1'>&lt;&lt;</a>
    		</li>
    		<!-- Link of the previous page -->
    		<li class='page-item disabled'>
    			<a class='page-link' href=''>&lt;</a>
    		</li>

    		<li class="page-item"><a class="page-link" href="#">1</a></li>
    		<li class="page-item active">
    		  <span class="page-link bg-dark border-dark">
    		    2
    		    <span class="sr-only">(current)</span>
    		  </span>
    		</li>
    		<li class="page-item"><a class="page-link" href="#">3</a></li>

    		<!-- Link of the next page -->
    		<li class='page-item'>
    			<a class='page-link' href=''>&gt;</a>
    		</li>
    		<!-- Link of the last page -->
    		<li class='page-item'>
    			<a class='page-link' href=''>&gt;&gt;</a>
    		</li>
    	</ul>
   	</nav>
<?php require('inc/templates/footer.php'); ?>
