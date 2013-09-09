<?php
   
	$host = "localhos";   // database server host domain name
	$uid = "admin";                  // needs to be secured
	$pass = "";
	$dbname = "capstone";
	$db_obj = mysql_connect("localhost", $uid, $pass, $dbname);  // connection object

	if (!$db_obj) {  // connection failed
		printf("Can't connect to $host $dbname. %s:%s\n", mysqli_connect_errno(), mysqli_connect_error());
		exit();
	}

	mysql_select_db($dbname, $db_obj);
      
?>
