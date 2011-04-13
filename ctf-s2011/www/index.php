<?php
	$page = $_GET['id'];
	if (!empty($page)) {
		if (is_numeric($page)) {
			if ((int)$page == 1) {
				include('cms.php');
			}
			elseif ((int)$page == 2) {
				include('admin.php');
			}
			elseif ((int)$page == 3) {
				phpinfo();
			}
			elseif ((int)$page == 500) {
				include('500.php');
			}
			else {
				include('404.php');
			}
		}
		else {
			include($page);
		}
	}
	else {
?>
<html>
<head>
<title>Capture the Flags</title>
<link rel="stylesheet" type="text/css" href="yui.2.css" />
<link rel="stylesheet" type="text/css" href="global.6.css" />
</head>
<body>
<h1>This is definitely not 4chan</h1>
<p><img src="drool.jpg" alt="Pedro"/></p>
<ul>
<li><a href="/?id=1">Enter CMS</a></li>
<li><a href="/?id=2">Admin</a></li>
</ul>
</body>
</html>
<?php
	}
	// FLAG: MOAR! MOAR! MOAR!
?>

