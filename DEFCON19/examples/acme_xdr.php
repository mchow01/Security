<?php
	// This is not a good thing!
	header('Access-Control-Allow-Origin: *');
	$contents = file_get_contents("http://tuftswebdev.appspot.com/acme");
	echo $contents;
?>
