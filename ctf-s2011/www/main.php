
<?php
	session_start();
	if ($_SESSION['login'] == null)
	{
		header("Location: cms.php");
		exit;
	}
?>
<!DOCTYPE html>

<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="yui.2.css" />
<link rel="stylesheet" type="text/css" href="global.6.css" />
</head>
<body>
<h1>Cool beans!</h1>
<p><img src="moar.jpg" alt="FLAG: Get your hot zima soup in the Dagobah system" /></p>
<h2><a href="logout.php">Logout</a></h2>
</body>
</html>

