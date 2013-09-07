<?php
   
	$host = "capstone-s13.cs.kent.edu";   // database server host domain name
	$uid = "ckerstin";                  // needs to be secured
	$pass = "capstones13";
	$dbname = "capstones13";
	$db_obj = mysql_connect("localhost", $uid, $pass, $dbname);  // connection object

	if (!$db_obj) {  // connection failed
		printf("Can't connect to $host $dbname. %s:%s\n", mysqli_connect_errno(), mysqli_connect_error());
		exit();
	}

	mysql_select_db($dbname, $db_obj);
      
?>
