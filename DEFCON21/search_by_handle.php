<!DOCTYPE html>

<html>

<head>
<title>Financial News Search</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
</head>

<body>
<?php
	/* The look of a document in the database:
	{ "_id" : ObjectId("51deafd5b8d78813e46dfa5e"), "screen_name" : "PandoDaily", "text" : "Joining the Dots: Betaworks' popular game is headed to Android http://t.co/s4bNuxYCmS", "created_at" : ISODate("2013-07-11T13:13:05Z"), "author_id" : 419710142, "id" : NumberLong("355313795914145792") }*/
	$result = "";
	if (isset($_GET['searchbox']) && !empty($_GET['searchbox'])) {
		$searchbox = $_GET['searchbox']; // ahem...
		$result = "<h4>Result(s) for @" . $searchbox . ":</h4>\n";
		$mongo = new MongoClient();
		$database = $mongo->financials;
		$collection = $database->news;

		// Remember, MongoDB expects input in JSON array format
		$cursor = $collection->find(array('screen_name' => $searchbox)); // ahem...
		$cursor->sort(array('_id' => 0)); // sort news by date, newest to oldest
		if ($cursor->hasNext()) {
			$result .= "<ol>\n";
			foreach ($cursor as $document) {
				$result .= '<li><span class="text">' . $document['text'] . 
				'</span>, <span class="created_at">' . 
				date("r", $document['created_at']->sec) . 
				"</span></li>\n";
			}
			$result .= "</ol>\n";
		}
		else {
			$result .= "<p>No news.</p>\n";
		}
	}
?>
<form method="get" id="searchform">
<p>Enter a Bloomberg Terminal TWTR Handle (without @) <input type="text" name="searchbox" id="searchbox" /> <input type="submit" name="submitbutton" value="Submit" /></p>
</form>
<div id="results">
<?php echo $result; ?>
</div>
</body>
</html>
