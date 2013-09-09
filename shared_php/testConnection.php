<?php
   
	$host = "localhost";   // database server host domain name
	$uid = "root";                  // needs to be secured
	$pass = "";
	$dbname = "capstone";
	$mysqli = new mysqli($host, $uid, $pass, $dbname);  // connection object

    /* check connection */
	if ($mysqli->connect_errno) 
	{
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}

?>
