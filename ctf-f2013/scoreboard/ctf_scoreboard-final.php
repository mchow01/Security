<!DOCTYPE html>

<html>
<head>
<title>2013 CTF Scoreboard</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<style>
@import url(http://fonts.googleapis.com/css?family=Happy+Monkey);body{font-family:"Happy Monkey","Helvetica Neue",Helvetica,Arial,sans-serif;font-size:16px;background-color:#fff}h1,h2,h3,h4,p{text-align:center}.points{color:#f0f}.error{color:red}.success{color:green}table{margin-left:auto;margin-right:auto}tr,td,th{border-style:groove}th{font-style:italic}
</style>
</head>

<body>
<h1>2013 CTF Scoreboard</h1>

<h2>Updates</h2>
<div class="error">
<p><code>10.3.14.228</code> has been taken offline. Please use <code>sixtyseven.twentythree.seventynine.onehundredandthirteen</code></p>
<p>HINTS: Take a look at the <code>id</code> parameter in the URL. The value is a number, but what else can it be? A follow-up: perhaps look into some PHP functions. Examples: <code>phpinfo();, glob();</code></p>
<p>If you are having trouble connecting to the game server, another option just opened: connect to SSID <code>EECS</code> and go to <a href="http://10.3.14.228">http://10.3.14.228</a></p>
<p>When you submit a flag, it has to be the entire key (e.g., <code>key{...}</code>)</p>
<p>Please make sure to write your name on the CTF worksheet else you will not receive attendance credit for this assignment!</p>
<p>The SSID of the wireless network to play is <code>MINGCHOW-CTF</code></p>
</div>

<?php
    $deduction = -100;
    $actualtampertoken = "skymanatees";
    $submitkeys = array('pinkdogwood', 'teaolive', 'floweringpeach', 'flowingcrabapple', 'magnolia', 'juniper', 'pampas', 'yellowjasmine', 'carolinacherry', 'camellia', 'whitedogwood', 'goldenbell', 'azalea', 'chinesefir', 'firethorn', 'redbud', 'general');
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
            $myUserName = "mchow";
            $myPassword = "mchow123";
            $myDatabase = "mchow";
            $myHost = "mysql-user";
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
<p>Challenge 1: You are staring right at it. <span class="points">100 points</span></p>
<p>Challenge 2: Remember to complete the course midsemester evaluation! <span class="points">100 points</span></p>
<p>Challenge 3: Crack me if you can. <span class="points">300 points</span></p>
<p>Challenge 4: Look again, pay careful attention. <span class="points">200 points</span></p>
<p>Challenge 5: All your base64 are belong to us in the roots. <span class="points">200 points</span></p>
<p>Challenge 6: Buried in the dump. <span class="points">300 points</span></p>
<p>Challenge 7: That's the name of the game. <span class="points">200 points</span></p>
<p>Challenge 8: Remember, you need to sign off too! <span class="points">100 points</span></p>

<h2>Scores</h2>
<table>
<tr>
<th>Team Number</th>
<th>Score</th>
</tr>
<?php
    $myUserName = "mchow";
    $myPassword = "mchow123";
    $myDatabase = "mchow";
    $myHost = "mysql-user";
    $dbh = mysql_connect($myHost, $myUserName, $myPassword) or die ('I cannot connect to the database because: ' . mysql_error());
    mysql_select_db($myDatabase) or die("Unable to select database");
    $query = "SELECT team_number, SUM(points) AS total FROM ctf_scoreboard GROUP BY team_number ORDER BY total DESC, team_number";
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
