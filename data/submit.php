<link rel="stylesheet" type="text/css" href="custom.css">
<?php

        require "conf.php";
        require "func.php";

	$name = $_POST['name'];
	$q = $_POST['question'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$date = date("r");

	$time = time();

	$period = get_period();

	$timestamp = "<a href=reply.php?id=$time&name=$name>Reply to this question</a>";
	$deletelink = "<a href=submitdelete.php?id=$time>Delete this question</a>";
	$banlink = "<a href=addban.php?id=$time>Ban the person who posted this question</a>";
	//echo $timestamp;

	$newq = htmlentities($q);
	$newname = htmlentities($name);

	if(empty($newq) && $newname !== "beckerson")
		die("<div id=center>Please enter a question.</div>");

	if(empty($newname))
		die("<div id=center>Please enter a name.</div>");

        if(strlen($newq) > 140)
                die("<div id=center>Your question was too long.</div>");

	$con = mysqli_connect(SQLSERVER, SQLUSER, SQLPASS, SQLDB) or die(mysqli_connect_error());

	$result = mysqli_query($con, "SELECT IP FROM bans WHERE Period=" . $period . ";");

	$bans = mysqli_fetch_row($result);

	foreach($bans as $bannedip){
		if("$bannedip" == "$ip")
			die("<div id=center>You are banned from Help Tickets!</div>");
	}

	mysqli_query($con, "INSERT INTO questions VALUES(\"$newname\", \"$newq\", \"$ip\", \"$date\", \"$timestamp\", \"$deletelink\", \"$time\", \"$banlink\");") or die(mysqli_connect_error());

	echo "<div id=center><a class=text-danger href=\"list.php\">Question Submitted. Click here to see.</a></div>";
?>
