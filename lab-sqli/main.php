<?php
	session_start();
	if ($_SESSION['login'] == null)
	{
		header("Location: admin.php");
		exit;
	}
	else {
	   echo '
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="yui.2.css" />
<link rel="stylesheet" type="text/css" href="global.6.css" />
</head>
<body>
<h1>Welcome!</h1>
<p>The key is: <em>The Skeletons Are Out Tonight, They March About the Streets</em></p>
</body>
</html>';     
	}
?>
