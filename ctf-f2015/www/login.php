<?php
	require_once("includes/dblib.php");
	$access = getLogin($_POST['login'], $_POST['password']);
	if ($access != false)
	{
		session_start();
		$_SESSION['login'] = $access;
		header("Location: main.php");
	}
	else {
		header("Location: admin.php?error");
	}
?>
