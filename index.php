<?php require('inc/templates/header.php'); ?>
	<?php session_start(); ?>
	<?php if (isset($_SESSION['user'])): ?>
		<?php header("location:http://localhost/fgevcv/lista-concesionarios.php"); ?>
	<?php endif ?>
	<?php require('inc/templates/login.php'); ?>
<?php require('inc/templates/footer.php'); ?>
