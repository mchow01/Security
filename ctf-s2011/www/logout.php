<?php
	session_start();
	if ($_SESSION['login'] == null)
	{
		header("Location: cms.php");
		exit;
	}
	session_destroy();
?>
<!DOCTYPE html>

<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="yui.2.css" />
<link rel="stylesheet" type="text/css" href="global.6.css" />
</head>
<body>
<h4>You have successfully logged out of the system.</h4>
<h4><a href="cms.php">Return to login</a></h4>
</body>
</html>

