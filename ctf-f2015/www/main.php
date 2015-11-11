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
<html>
<head><title>404 Not Found</title></head>
<body bgcolor="white">
<center><h1>404 Not Found</h1></center>
<hr><center>nginx/1.4.6 (Ubuntu)</center>
</body>
</html>
<!-- Hmmm, the plot thickens... key{83da018c3a5af6d0f2806049c4082387f1de3955}-->';
     }
     elseif (isset($_COOKIE['lg']) && strcmp($_COOKIE['lg'], 'true') == 0) {
     	    echo "<!DOCTYPE html><html><head><title>Main</title></head><body><p>Congratulations! Here you go: key{2797449c56a55474cf682003e60cde0cbb05335a}</p></body></html>";
     }
     else {
                echo '
<html>
<head><title>404 Not Found</title></head>
<body bgcolor="white">
<center><h1>404 Not Found</h1></center>
<hr><center>nginx/1.4.6 (Ubuntu)</center>
</body>
</html>
<!-- Hmmm, the plot thickens... key{83da018c3a5af6d0f2806049c4082387f1de3955}-->';}
?>
