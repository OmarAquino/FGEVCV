<?php require('inc/templates/header.php'); ?>
    <?php require('inc/functions/session.php'); ?>
	<?php require('inc/functions/querys.php'); ?>
   	<div class="Concesionarios-contenedor">
        <?php if ($_SESSION['user-type']==1): ?>
            <?php require('inc/templates/concesionarios-prevalidador.php'); ?>
        <?php elseif($_SESSION['user-type']==2): ?>
            <?php require('inc/templates/concesionarios-juridico.php'); ?>
        <?php endif ?>
   	</div>
<?php require('inc/templates/footer.php'); ?>
