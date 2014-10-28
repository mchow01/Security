<?php
	$myUserName = 'root';
	$myPassword = 'Wh@t3ver!Wh@t3ver!';
	$myDBName = 'board';
	$myHost = 'localhost';
	$db = mysql_connect($myHost, $myUserName, $myPassword);
	if (!$db) {
		die('Cannot connect to the database: ' . mysql_error());
	}
	else {
		mysql_select_db($myDBName) or die("Unable to select database");
	}

	function getDB()
	{
		global $db;
		return $db;
	}

	function getLogin ($login, $password)
	{
		global $db;
		$result = mysql_query("SELECT id FROM users WHERE password = SHA1('" . $password . "') and login = '" . $login . "'");
		if (!result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
		else {
			$row = array();
			$row = mysql_fetch_array($result);
			if (!empty($row)) {
				return $row;
			}
		}
		mysql_free_result($result);
		return false;
	}
?>
