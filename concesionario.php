<?php require('inc/templates/header.php'); ?>
    <?php require('inc/functions/session.php'); ?>
    <?php if (isset($_SESSION['user'])): ?>
    	<a href="inc/functions/logout.php" class="Logout">Cerrar sesión</a>
    <?php endif ?>
	<?php require('inc/functions/querys.php'); ?>
   	<div class="Concesionarios-contenedor">
   		<?php if ($_SESSION['user-type']==1): ?>
   	  		<?php require('inc/templates/concesionario-prevalidador.php'); ?>
   		<?php elseif($_SESSION['user-type']==2): ?>
   	   		<?php require('inc/templates/concesionario-juridico.php'); ?>
   		<?php endif ?>
   	</div>
<?php require('inc/templates/footer.php'); ?>