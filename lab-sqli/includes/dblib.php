<?php
	// Database schema: CREATE TABLE users (id INT(9) NOT NULL AUTO_INCREMENT, login VARCHAR(60) NOT NULL, password TEXT NOT NULL, PRIMARY KEY (id));
	// Be sure to add a record: INSERT INTO users (login, password) VALUES ('SOME USERNAME HERE','SOME PASSWORD HERE');
	$myUserName = '';
	$myPassword = '';
	$myDBName = '';
	$myHost = '';
	$db = mysqli_connect($myHost, $myUserName, $myPassword);
	if (!$db) {
		die('Cannot connect to the database: ' . mysqli_error());
	}
	else {
		mysqli_select_db($db, $myDBName) or die("Unable to select database");
	}

	function getDB() {
		global $db;
		return $db;
	}

	function getLogin ($login, $password) {
		global $db;
		$result = mysqli_query($db, "SELECT id FROM users WHERE login = '" . mysqli_real_escape_string($db, $login) . "' and password = '" . $password . "'");
		if (!result) {
			$message  = 'Invalid query: ' . mysqli_error($db) . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
		else {
			$row = array();
			$row = mysqli_fetch_array($result);
			if (!empty($row)) {
				return $row;
			}
		}
		mysqli_free_result($result);
		return false;
	}
?>
