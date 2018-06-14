<?php 
@ob_start();
session_start();
session_destroy();

include 'database.php';
go('login.php');
?>