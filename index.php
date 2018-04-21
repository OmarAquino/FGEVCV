<?php require('inc/functions/home-url.php'); ?>
<?php require('inc/templates/header.php'); ?>
	<?php session_start(); ?>
	<?php if (isset($_SESSION['user'])): ?>
		<?php header("location: ".pathUrl(__DIR__ . '../')."lista-concesionarios.php"); ?>
	<?php endif ?>
	<?php require('inc/templates/login.php'); ?>
<?php require('inc/templates/footer.php'); ?>
