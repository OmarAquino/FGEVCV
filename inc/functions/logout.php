<?php
require('home-url.php');
session_start();
unset ($SESSION['user']);
unset ($SESSION['user-type']);
session_destroy();
header('Location: '.pathUrl(__DIR__ . '/../../'));
?>