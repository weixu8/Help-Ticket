<link rel="stylesheet" type="text/css" href="flat-ui.css">
<link rel="stylesheet" type="text/css" href="custom.css">
<?php
       require "conf.php";

       $con = mysqli_connect(SQLSERVER, SQLUSER, SQLPASS, SQLDB) or die(mysqli_connect_error());
       mysqli_query($con, "TRUNCATE TABLE questions");
?>

