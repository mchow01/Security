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
<!-- Hmmm, the plot thickens... key{fcb26d5bbe8d9c813034ee6a2b40eb35a96c7ff4}-->';
     }
     elseif (isset($_COOKIE['lg']) && strcmp($_COOKIE['lg'], 'true') == 0) {
     	    echo "<!DOCTYPE html><html><head><title>Main</title></head><body><p>Congratulations! Here you go: key{f29f85aed418bc01b663daf74f60ffdca929852d}</p></body></html>";
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
<!-- Hmmm, the plot thickens... key{fcb26d5bbe8d9c813034ee6a2b40eb35a96c7ff4}-->';}
?>
