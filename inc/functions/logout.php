<?php
session_start();
unset ($SESSION['user']);
unset ($SESSION['user-type']);
session_destroy();
header('Location: http://localhost/fgevcv');
?>