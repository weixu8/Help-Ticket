<head><link rel="stylesheet" type="text/css" href="flat-ui.css"> <link rel="stylesheet" type="text/css" href="custom.css"></head>
<font color=#e74c3c><center><h1>Help Tickets</h1></center><font size=6>
<?php
        require "conf.php";
        require_once 'Mobile_Detect.php';
        $detect = new Mobile_Detect;

	$con = mysqli_connect(SQLSERVER, SQLUSER, SQLPASS, SQLDB);
	$ip = $_SERVER['REMOTE_ADDR'];
	
        $modipresult = mysqli_query($con, "SELECT * FROM moderators");
        $modip = mysqli_fetch_row($modipresult);

	if(in_array($ip, $modip))
		$result = mysqli_query($con, "SELECT * FROM questions ORDER BY id");
	if(!in_array($ip, $modip))
		$result = mysqli_query($con, "SELECT Name, Question, Date, ID FROM questions ORDER BY ID;");

	echo "<table border=\"1\">";

	while($row = mysqli_fetch_row($result)){
		echo "<tr>";
		foreach($row as $cell)
    		echo "<td><font color=#e74c3c size=6>$cell</font></td>";
		echo "</tr>\n";
 	}

	echo "</table>";
        
        $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

	if($deviceType !== 'tablet')
                echo "<meta http-equiv=\"refresh\" content=\"1\">";
        if($deviceType == 'tablet')
                echo "<meta http-equiv=\"refresh\" content=\"5\">";
	echo "<a href=\"index.html\">Submit another question.";
?>
