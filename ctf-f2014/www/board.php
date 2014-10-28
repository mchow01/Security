<!DOCTYPE>
<head>
	<head>
		<title>The Happening</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="alternate stylesheet" type="text/css" href="site_burichan.css" title="Burichan" />
		<link rel="alternate stylesheet" type="text/css" href="site_futaba.css" title="Futaba" />
		<link rel="stylesheet" type="text/css" href="site_kusabax.css" title="Kusabax" />
	</head>

	<body>

	<?php
		$myUserName = "root";
		$myPassword = "Wh@t3ver!Wh@t3ver!";
		$myDatabase = "board";
		$myHost = "localhost";
		$dbh = mysql_connect($myHost, $myUserName, $myPassword) or die ('I cannot connect to the database because: ' . mysql_error());		
		mysql_select_db($myDatabase) or die("Unable to select database");
		$query = "";		

		$id = $_GET["id"];
		if (!empty($_POST)) {
			if (!empty($_POST['title']) && !empty($_POST['post'])) {
				$query = "INSERT INTO posts (title, post, active, updated_at) VALUES ('" . mysql_real_escape_string($_POST['title']) . "', '" . mysql_real_escape_string($_POST['post']) . "', 1, NOW())";
			}
			elseif (!empty($_POST['comments']) && !empty($_POST["post_id"])) {
				$query = "INSERT INTO replies (comments, post_id, active, updated_at) VALUES ('" . mysql_real_escape_string($_POST['comments']) . "', " . $_POST["post_id"] . ", 1, NOW())";
			}
			mysql_query($query);
		}
		if (empty($id)) {
        	   	echo '<div id="header"><h1><img id="logo" src="logo.png" /><br/>The Happening</h1></div>';
			echo '<form id="posting" method="post">';
			echo '<h4>New Post</h4>';
			echo '<p>Title: <input type="text" name="title" /></p>';
			echo '<p>Post: <textarea name="post"></textarea></p>';
			echo '<p><input type="submit"></p>';
			echo '</form>';
			$query = "SELECT * FROM posts WHERE active = 1 AND id > 0 ORDER BY id DESC";
			$myResult = mysql_query($query);
			while ($row = mysql_fetch_array($myResult)) {
				echo '<h2><a href="board.php?id=' . $row["id"] . '">' . $row["title"] . "</a></h2>\n";
				echo "<p>" . $row["post"] . "</p>\n";
	                }
		}
		else {
		     echo '<div id="header"><h1 id="logo">The Happening</h1></div>';
			echo '<form id="reply" method="post">';
			echo '<input type="hidden" name="post_id" value="' . $id . '"/>';
			echo '<h4>Reply</h4>';
			echo '<p>Comments: <textarea name="comments"></textarea></p>';
			echo '<p><input type="submit"></p>';
			echo '</form>';
			$query = "SELECT * FROM posts WHERE active = 1 AND id = $id";
			$myResult = mysql_query($query);
			while ($row = mysql_fetch_array($myResult)) {
				echo '<h2><a href="board.php?id=' . $row["id"] . '">' . $row["title"] . "</a></h2>\n";
				echo "<p>" . $row["post"] . "</p>\n";
	                }
			$query = "SELECT * FROM replies WHERE active = 1 AND post_id = $id ORDER BY updated_at";
			$myResult = mysql_query($query);
			while ($row = mysql_fetch_array($myResult)) {
				echo "<p>Replied on " . $row["updated_at"] . ": " . $row["comments"] . "</p>\n";
	                }
		}
		mysql_close($dbh);
	?>
	<div id="footer">
		<hr/>
		<h3><a href="board.php">Home</a> | <a href="admin.php">Administration</a></h3>
	</div>
	</body>
</head>
