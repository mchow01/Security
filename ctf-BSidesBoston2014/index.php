<!DOCTYPE html>

<html>

<head>
<title>TWTR Terminal</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<link rel="stylesheet" href="screen.css" media="screen" />
</head>

<body>
<?php
	$result = "";
	if (isset($_GET['searchbox']) && !empty($_GET['searchbox'])) {
		$searchbox = $_GET['searchbox']; // ahem...
		$result = "<h4>Result(s) for @" . $searchbox . ":</h4>\n";
		$mongo = new MongoClient();
		$database = $mongo->financials;
		$collection = $database->news;

		// Remember, MongoDB expects input in JSON array format
		$cursor = $collection->find(array('screen_name' => $searchbox))->sort(array('created_at' =>-1));
		if ($cursor->hasNext()) {
			$result .= "<ol>\n";
			foreach ($cursor as $document) {
				$result .= '<li><span class="text">' . $document['text'] . 
				'</span><br/><span class="created_at">' . 
				date("F j, Y, g:i a e", $document['created_at']->sec) . 
				"</span></li>\n";
			}
			$result .= "</ol>\n";
		}
		else {
			$result .= "<p>No news.</p>\n";
		}
	}
?>
<h2><img src="a.jpg" alt="Terminal"/> TWTR Terminal <img src="b.jpg" alt="Terminal"/></h2>
<p>Shortcuts:</p>
<ol>
<li><a href="?searchbox=CBSNews">@CBSNews</a></li>
<li><a href="?searchbox=PandoDaily">@PandoDaily</a></li>
<li><a href="?searchbox=NBCNews">@NBCNews</a></li>
<li><a href="?searchbox=VentureBeat">@VentureBeat</a></li>
</ol>
<form method="get" id="searchform">
<p>Enter a Bloomberg Terminal TWTR Handle (without @) <input type="text" name="searchbox" id="searchbox" /> <input type="submit" name="submitbutton" value="Submit" /></p>
</form>
<div id="results">
<?php echo $result; ?>
</div>
</body>
</html>
