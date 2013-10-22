<?php
	session_start();
	if ($_SESSION['login'] == null)
	{
		header("Location: admin.php");
		exit;
	}
	if (!isset($_COOKIE['lg'])) {
	   setcookie('lg', 'false');
	   $_COOKIE['lg'] = 'false';
	   echo '
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL /main.php was not found on this server.</p>
<hr>
<address>Apache/2.2.14 (Ubuntu) Server at Port 80</address>
</body></html>
<!-- Hmmm, the plot thickens...-->';
     }
     elseif (isset($_COOKIE['lg']) && strcmp($_COOKIE['lg'], 'true') == 0) {
     	    echo "<!DOCTYPE html><html><head><title>Main</title></head><body><p>Congratulations!</p></body></html>";
     }
     else {
                echo '
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL /main.php was not found on this server.</p>
<hr>
<address>Apache/2.2.14 (Ubuntu) Server at Port 80</address>
</body></html>
<!-- Hmmm, the plot thickens...-->';}
?>
