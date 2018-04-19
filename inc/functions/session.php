<?php
require('home-url.php');
session_start();
if (!isset($_SESSION['user'])){
	header("location: ".pathUrl(__DIR__ . '/../../'));
}
?>