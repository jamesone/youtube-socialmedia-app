<?php 
	require_once 'head.php';
	session_destroy();
	header("Location: most-liked.php");
?>