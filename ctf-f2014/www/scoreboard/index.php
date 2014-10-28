<!DOCTYPE html>

<html>
<head>
<title>2014 CTF Scoreboard</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<style>
@import url(http://fonts.googleapis.com/css?family=Happy+Monkey);body{font-family:"Happy Monkey","Helvetica Neue",Helvetica,Arial,sans-serif;font-size:16px;background-color:#fff}h1,h2,h3,h4,p{text-align:center}.points{color:#f0f}.error{color:red}.success{color:green}table{margin-left:auto;margin-right:auto}tr,td,th{border-style:groove}th{font-style:italic}
</style>
</head>

<body>
<h1>2014 CTF Scoreboard</h1>
<?php
    $deduction = -100;
    $actualtampertoken = "skymanatees";
    $submitkeys = array('pinkdogwood', 'teaolive', 'floweringpeach', 'flowingcrabapple', 'magnolia', 'juniper', 'pampas', 'yellowjasmine', 'carolinacherry', 'camellia', 'whitedogwood', 'goldenbell', 'general');
    $error = false;
    $success = false;
    $tamper = false;
    if (!empty($_POST)) {
        $submittampertoken = $_POST["tampertoken"];
        $submitkey = $_POST["submitkey"];
        $submitflag = $_POST["submitflag"];
        
        // Check if the submit key is legitimate
        if (in_array($submitkey, $submitkeys)) {
            $team_id = array_search($submitkey, $submitkeys) + 1;
            $myUserName = "root";
            $myPassword = "Wh@t3ver!Wh@t3ver!";
            $myDatabase = "scoreboard";
            $myHost = "localhost";
            $dbh = mysql_connect($myHost, $myUserName, $myPassword) or die ('I cannot connect to the database because: ' . mysql_error());		
            mysql_select_db($myDatabase) or die("Unable to select database");
            
            // Check if the flag is legitimate
            $query = "SELECT id, points FROM ctf_flags WHERE flag = '" . mysql_real_escape_string($submitflag) . "'";
            $myResult = mysql_query($query);
            $row1 = mysql_fetch_array($myResult);
            if (empty($row1)) {
                $error = true;
            }
            else {
                $flagid = $row1["id"];
                $points = $row1["points"];
                
                // Check that this is not a duplicate submission
                $query = "SELECT id FROM ctf_scoreboard WHERE team_number = $team_id AND flag_id = $flagid";
                $myResult = mysql_query($query);
                $row2 = mysql_fetch_array($myResult);
                if (!empty($row2)) {
                    $error = true;
                }
                else {
                
                    // Check for tampering
                    if ($submittampertoken == $actualtampertoken) {
                        $query = "INSERT INTO ctf_scoreboard (team_number, flag_id, points, added_on) VALUES ($team_id, $flagid, $points, NOW())";
                        $myResult = mysql_query($query);
                        $success = true;
                    }
                    else {
                        $query = "INSERT INTO ctf_scoreboard (team_number, flag_id, points, added_on) VALUES ($team_id, 0, $deduction, NOW())";
                        $myResult = mysql_query($query);
                        $tamper = true;
                    }
                }
            }
            mysql_close();
        }
        else {
            $error = true;
        }
    }
    
    if ($tamper) {
        echo '<h2 class="error">100 points have been deducted as tamper token was tampered with!</h2>';
    }
    elseif ($error) {
        echo '<h2 class="error">Sorry, your submission was incorrect.</h2>';
    }
    elseif ($success) {
        echo '<h2 class="success">Nice work!</h2>';
    }
?>
<h2>Challenges</h2>
<p>Challenge 1: Just ask for it. <span class="points">100 points</span></p>
<p>Challenge 2: Just ask for it with a catch --packed refs <span class="points">200 points</span></p>
<p>Challenge 3: Analyze the binary. <span class="points">200 points</span></p>
<p>Challenge 4: I want to see MOAR on the board! <span class="points">100 points</span></p>
<p>Challenge 5: Don't ask me if something looks wrong.  Look again, pay careful attention. <span class="points">100 points</span></p>
<p>Challenge 6: Don't ask me if something looks wrong.  Look again, pay really careful attention. <span class="points">300 points</span></p>
<p>Challenge 7: Remember, you have to log out too! <span class="points">100 points</span></p>
<p>Challenge 8: Buried in the dump. <span class="points">400 points</span></p>
<p>Challenge 9: Not Global Thermal Nuclear War.  All your base64 are belong to us. <span class="points">200 points</span></p>
<p>Challenge 10: About my friend Karl (karl)... <span class="points">200 points</span></p>
<h2>Scores</h2>
<table>
<tr>
<th>Team Number</th>
<th>Score</th>
</tr>
<?php
    $myUserName = "root";
    $myPassword = "Wh@t3ver!Wh@t3ver!";
    $myDatabase = "scoreboard";
    $myHost = "localhost";
    $dbh = mysql_connect($myHost, $myUserName, $myPassword) or die ('I cannot connect to the database because: ' . mysql_error());
    mysql_select_db($myDatabase) or die("Unable to select database");
    $query = "SELECT team_number, SUM(points) AS total FROM ctf_scoreboard GROUP BY team_number DESC";
    $myResult = mysql_query($query);
    while ($row = mysql_fetch_array($myResult)) {
        echo "<tr><td>" . $row["team_number"] . "</td><td>" . $row["total"] . "</td></tr>\n";
    }
?>
</table>

<h2>Flag Submission</h2>
<form method="post">
<input type="hidden" name="tampertoken" value="skymanatees"/>
<p>Submission Key <input type="text" name="submitkey" /> Flag <input type="text" size="30" name="submitflag" /> <input type="submit" /></p>
</form>

</body>
</html>
